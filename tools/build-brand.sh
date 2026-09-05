#!/usr/bin/env bash
#
# Render the raster brand assets from their SVG sources: favicons, PWA icons and
# the social card. Outputs are committed, so this only needs re-running when
# docs/assets/brand/mark.svg or og.svg changes.
#
#   ./tools/build-brand.sh
#
# Runs in a container so the host needs nothing but Docker. Note the font step:
# og.svg sets text in Space Grotesk and Inter, which only exist here as woff2,
# so they are decompressed to TTF and installed before rendering — without that
# ImageMagick silently falls back to a default face.
set -euo pipefail

cd "$(dirname "$0")/.."

# Runs as root because apk needs it; outputs are chowned back at the end.
docker run --rm -i \
  -e "HOST_UID=$(id -u)" -e "HOST_GID=$(id -g)" \
  -v "$PWD/docs:/docs" -w /docs/assets/brand \
  alpine:3.20 sh -s <<'INNER'
set -eu
apk add --no-cache imagemagick imagemagick-svg imagemagick-jpeg imagemagick-webp woff2 fontconfig >/dev/null

mkdir -p /usr/share/fonts/brand && cd /usr/share/fonts/brand
for f in /docs/assets/fonts/*.woff2; do
  cp "$f" .
  woff2_decompress "$(basename "$f")" >/dev/null 2>&1 || true
done
rm -f ./*.woff2
fc-cache -f >/dev/null 2>&1
fc-list | grep -qi "space grotesk" || { echo "FATAL: brand fonts not registered" >&2; exit 1; }

cd /docs/assets/brand
magick -background none og.svg -strip -quality 86 -sampling-factor 4:2:0 og.jpg

for s in 180 192 512; do
  magick -background none mark.svg -resize ${s}x${s} -strip -depth 8 PNG32:icon-$s.png
  magick icon-$s.png -strip -colors 64 -depth 8 PNG8:icon-$s.png
done

for s in 16 32 48; do
  magick -background none mark.svg -resize ${s}x${s} -strip -depth 8 PNG32:/tmp/i$s.png
done
magick /tmp/i16.png /tmp/i32.png /tmp/i48.png -colors 64 favicon.ico

cp favicon.svg /docs/favicon.svg
cp favicon.ico /docs/favicon.ico
cp icon-180.png /docs/apple-touch-icon.png

chown "$HOST_UID:$HOST_GID" \
  /docs/assets/brand/og.jpg /docs/assets/brand/icon-*.png /docs/assets/brand/favicon.ico \
  /docs/favicon.svg /docs/favicon.ico /docs/apple-touch-icon.png
INNER

echo "brand assets rebuilt:"
ls -la docs/assets/brand
