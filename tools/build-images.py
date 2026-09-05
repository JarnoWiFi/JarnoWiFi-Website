#!/usr/bin/env python3
"""Generate responsive WebP derivatives for site imagery.

Sources stay in docs/img/; derivatives land in docs/img/opt/ and are what the
pages actually reference. Re-run after adding or replacing a source image:

    python3 tools/build-images.py
"""
import pathlib
from PIL import Image

ROOT = pathlib.Path(__file__).resolve().parent.parent
SRC = ROOT / "docs/img"
OUT = ROOT / "docs/img/opt"

# (source, output stem, widths)
JOBS = [
    ("grootse-markt-2025/1748943099642.jpeg", "gallery-01", (400, 800, 1200)),
    ("grootse-markt-2025/1748943179728.jpeg", "gallery-02", (400, 800, 1200)),
    ("grootse-markt-2025/1748943274377.jpeg", "gallery-03", (400, 800, 1200)),
    ("grootse-markt-2025/1748943404515.jpeg", "gallery-04", (400, 800, 1200)),
    ("grootse-markt-2025/1748943441915.jpeg", "gallery-05", (400, 800, 1200)),
    ("20240508_193246-1536x2048.webp",        "gallery-06", (400, 800, 1200)),
    ("20240508_193251-1536x2048.webp",        "gallery-07", (400, 800, 1200)),
    ("20240508_194215-1536x1152.webp",        "gallery-08", (400, 800, 1200)),
    ("20240508_204101-1536x2048.webp",        "gallery-09", (400, 800, 1200)),
    ("people/jarno.jpeg",                     "jarno",      (160, 320)),
    ("people/joshua.jpeg",                    "joshua",     (160, 320)),
]


def build() -> None:
    OUT.mkdir(parents=True, exist_ok=True)
    total = 0
    for rel, stem, widths in JOBS:
        src = SRC / rel
        if not src.exists():
            print(f"  skip (missing): {rel}")
            continue
        with Image.open(src) as im:
            im = im.convert("RGB")
            for width in widths:
                height = round(im.height * width / im.width)
                dest = OUT / f"{stem}-{width}.webp"
                im.resize((width, height), Image.LANCZOS).save(
                    dest, "WEBP", quality=80, method=6
                )
                size = dest.stat().st_size
                total += size
                print(f"  {dest.relative_to(ROOT)}  {width}x{height}  {size // 1024}K")
    print(f"total derivatives: {total // 1024}K")


if __name__ == "__main__":
    build()
