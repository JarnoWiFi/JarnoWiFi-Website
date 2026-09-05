/**
 * Google Analytics bootstrap. Loaded only after the visitor has consented —
 * the server withholds this script entirely until the consent cookie is set.
 * Kept external so the CSP does not need 'unsafe-inline'.
 */
window.dataLayer = window.dataLayer || [];
function gtag() { window.dataLayer.push(arguments); }
gtag('js', new Date());
gtag('config', 'G-D6BR389F7B', { anonymize_ip: true });
