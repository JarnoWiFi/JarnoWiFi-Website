#!/usr/bin/env python3
"""End-to-end smoke test against a running stack (default http://localhost:1212).

Covers the failures this site actually shipped: a contact form that 404'd under
every language prefix, an endpoint that leaked SMTP details, prices that changed
after load, and hardcoded <html lang> attributes.
"""
from __future__ import annotations

import os
import re
import sys
import urllib.error
import urllib.request

BASE = os.environ.get("SMOKE_BASE", "http://localhost:1212").rstrip("/")
LANGS = ("nl", "en", "de")
failures: list[str] = []


def get(path: str, *, headers: dict | None = None, data: bytes | None = None):
    req = urllib.request.Request(BASE + path, data=data, headers=headers or {})
    try:
        with urllib.request.urlopen(req) as r:
            return r.status, r.read().decode("utf-8", "replace"), dict(r.headers)
    except urllib.error.HTTPError as e:
        return e.code, e.read().decode("utf-8", "replace"), dict(e.headers)
    except Exception as e:  # noqa: BLE001
        return 0, str(e), {}


def check(name: str, ok: bool, detail: str = "") -> None:
    print(f"  {'PASS' if ok else 'FAIL'}  {name}{'' if ok else '  -> ' + detail}")
    if not ok:
        failures.append(name)


def main() -> int:
    print("routes")
    paths = ["/robots.txt", "/sitemap.xml", "/favicon.ico", "/site.webmanifest", "/js/site.js", "/site.css"]
    for lang in LANGS:
        paths += [f"/{lang}/", f"/{lang}/jobs", f"/{lang}/reliability",
                  f"/{lang}/imprint", f"/{lang}/privacy", f"/{lang}/blog",
                  f"/{lang}/blog/starlink-review"]
    for p in paths:
        status, _, _ = get(p)
        check(f"200 {p}", status == 200, f"got {status}")

    print("blocked paths")
    for p in ["/partials/meta-common.php", "/partials/footer.php", "/locales/translations.json"]:
        status, _, _ = get(p)
        check(f"blocked {p}", status in (403, 404), f"got {status}")

    print("language correctness")
    for lang in LANGS:
        _, body, _ = get(f"/{lang}/jobs")
        m = re.search(r'<html lang="([a-z]{2})"', body)
        check(f"<html lang> == {lang} on /{lang}/jobs", bool(m) and m.group(1) == lang,
              f"got {m.group(1) if m else 'none'}")

    print("copy is server-rendered (no client-side rewrite)")
    _, body, _ = get("/nl/")
    check("no data-i18n attributes in served HTML", "data-i18n" not in body)
    prices = sorted(set(re.findall(r"Vanaf € ?[\d.]+ ?/ ?dag", body)))
    check("all three day prices present exactly once each", len(prices) == 3, str(prices))
    check("retired SLA claim absent", "99,98" not in body and "99.98" not in body)

    print("security headers")
    _, _, headers = get("/nl/")
    for h in ["Content-Security-Policy", "X-Content-Type-Options", "X-Frame-Options",
              "Referrer-Policy", "Strict-Transport-Security"]:
        check(f"header {h}", h in headers)
    check("CSP has no stray backslashes", "\\" not in headers.get("Content-Security-Policy", ""))

    print("analytics is consent-gated")
    _, body, _ = get("/nl/")
    check("no analytics without consent", "googletagmanager" not in body)
    _, body, _ = get("/nl/", headers={"Cookie": "analyticsConsent=granted"})
    check("analytics present with consent", "googletagmanager" in body)

    print("contact endpoint")
    status, body, _ = get("/contact.php")
    check("GET /contact.php is 405", status == 405, f"got {status}")
    check("no SMTP details leaked", not re.search(r"smtp|pass", body, re.I), body[:120])

    form = b"email=not-an-email&notes=hi"
    status, body, _ = get("/contact.php", data=form,
                          headers={"X-Requested-With": "fetch",
                                   "Content-Type": "application/x-www-form-urlencoded"})
    check("invalid email rejected", status == 400, f"got {status}")

    # The bug that silently dropped every lead: relative action under /<lang>/.
    status, _, _ = get("/nl/contact.php", data=b"email=a@b.com&notes=hi",
                       headers={"X-Requested-With": "fetch",
                                "Content-Type": "application/x-www-form-urlencoded"})
    check("/<lang>/contact.php routes to PHP (not 404)", status != 404, f"got {status}")

    print()
    if failures:
        print(f"SMOKE TEST FAILED: {len(failures)} check(s)")
        return 1
    print("SMOKE TEST PASSED")
    return 0


if __name__ == "__main__":
    sys.exit(main())
