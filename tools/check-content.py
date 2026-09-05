#!/usr/bin/env python3
"""Content integrity checks.

The site previously kept every string twice — hardcoded in the PHP and again in
translations.json — and 215 of ~361 keys had drifted apart, so prices visibly
changed when JavaScript loaded. Copy is now server-rendered from the catalog
only. These checks keep it that way.
"""
from __future__ import annotations

import json
import pathlib
import re
import sys

ROOT = pathlib.Path(__file__).resolve().parent.parent
CATALOG = ROOT / "docs/locales/translations.json"
PAGES = sorted(ROOT.glob("docs/**/*.php"))

INVISIBLE = "­​‎‏﻿"

# Claims the site no longer makes. Guarded so they cannot quietly return.
RETIRED_CLAIMS = [
    "99,98", "99.98", "24/7 NOC", "10+ Gbps", "10+ Gbit",
    "unlimited data", "onbeperkte data", "unbegrenzte Daten",
    "Guaranteed uptime", "Gegarandeerde uptime", "Garantierte Uptime",
]

failures: list[str] = []


def fail(msg: str) -> None:
    failures.append(msg)


def main() -> int:
    catalog = json.loads(CATALOG.read_text(encoding="utf-8"))
    langs = sorted(catalog)

    # 1. every locale carries exactly the same keys
    keysets = {lang: set(catalog[lang]) for lang in langs}
    base = keysets[langs[0]]
    for lang in langs[1:]:
        missing = base - keysets[lang]
        extra = keysets[lang] - base
        if missing:
            fail(f"{lang}: missing keys: {sorted(missing)}")
        if extra:
            fail(f"{lang}: unexpected keys: {sorted(extra)}")

    # 2. no empty values, no invisible characters, no double spaces
    for lang in langs:
        for key, value in catalog[lang].items():
            values = value.values() if isinstance(value, dict) else [value]
            for v in values:
                if not isinstance(v, str):
                    continue
                if not v.strip():
                    fail(f"{lang}/{key}: empty value")
                bad = [c for c in v if c in INVISIBLE]
                if bad:
                    fail(f"{lang}/{key}: invisible char U+{ord(bad[0]):04X}")
                if "  " in v:
                    fail(f"{lang}/{key}: double space")

    # 3. retired claims must not reappear, in the catalog or in markup
    for lang in langs:
        blob = json.dumps(catalog[lang], ensure_ascii=False)
        for claim in RETIRED_CLAIMS:
            if claim in blob:
                fail(f"{lang}: retired claim present in catalog: {claim!r}")
    for page in PAGES:
        text = page.read_text(encoding="utf-8")
        for claim in RETIRED_CLAIMS:
            if claim in text:
                fail(f"{page.relative_to(ROOT)}: retired claim in markup: {claim!r}")

    # 4. copy must come from the catalog: no leftover client-side i18n hooks
    for page in PAGES:
        text = page.read_text(encoding="utf-8")
        for attr in ("data-i18n", "data-i18n-alt", "data-i18n-placeholder"):
            if attr in text:
                fail(f"{page.relative_to(ROOT)}: {attr} found — copy must be server-rendered via t()")

    # 5. every t('key') referenced in PHP must exist in every locale
    referenced: set[str] = set()
    for page in list(PAGES) + sorted(ROOT.glob("docs/partials/*.php")):
        text = page.read_text(encoding="utf-8")
        referenced |= set(re.findall(r"\bte?\(\s*'([a-zA-Z0-9_.]+)'", text))
    # keys built dynamically (e.g. "faq.q{$n}") are skipped by the regex above
    for key in sorted(referenced):
        for lang in langs:
            table = catalog[lang]
            if key in table:
                continue
            node = table
            for part in key.split("."):
                if not isinstance(node, dict) or part not in node:
                    node = None
                    break
                node = node[part]
            if not isinstance(node, str):
                fail(f"{lang}: referenced key missing from catalog: {key}")

    # 6. no orphaned keys: every key must appear as a literal somewhere in the
    #    PHP sources (directly, or as an array value passed to te()), or be
    #    reachable via an interpolated key like "faq.q{$n}".
    sources = "\n".join(
        p.read_text(encoding="utf-8")
        for p in sorted(ROOT.glob("docs/**/*.php"))
    )
    dynamic_prefixes = {
        m.rsplit("{", 1)[0]
        for m in re.findall(r'\bte?\(\s*"([^"]*\{\$[^"]*)"', sources)
    }
    orphans = []
    for key in sorted(base):
        if key == "meta" or f"'{key}'" in sources or f'"{key}"' in sources:
            continue
        if any(key.startswith(prefix) for prefix in dynamic_prefixes if prefix):
            continue
        orphans.append(key)
    if orphans:
        fail(f"orphaned catalog keys (defined but never rendered): {orphans}")

    if failures:
        print(f"content check FAILED ({len(failures)} problems)")
        for f in failures:
            print(f"  - {f}")
        return 1

    print(f"content check OK: {len(base)} keys x {len(langs)} locales, "
          f"no orphans, no retired claims, no client-side i18n hooks")
    return 0


if __name__ == "__main__":
    sys.exit(main())
