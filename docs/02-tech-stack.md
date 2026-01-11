# 02 — Tech Stack

Allowed technologies (exact)
- PHP 7/8 (Vanilla PHP for server-side rendering only; no frameworks).
- HTML5 (semantic markup).
- CSS3 (Sass not allowed unless explicitly added later; keep vanilla CSS + Bootstrap overrides).
- Bootstrap 5 (CSS utilities and grid only; no JS plugins unless lightweight and explicitly documented).
- Vanilla JavaScript (ES6+, minimal; no frameworks or bundlers).

Forbidden technologies (explicit)
- Node.js build tools for runtime features (allowed only if adding tooling later and documented).
- Frontend frameworks: React, Vue, Angular, Svelte, or similar.
- Server-side frameworks or libraries that add backend logic (Laravel, Symfony, Express, Django).
- Any external APIs, OAuth, or third-party live services.
- Encryption, security libraries, or real authentication flows.
- Experimental CSS features that lack broad browser support; prefer Bootstrap and widely-supported properties.

Notes for AI agents
- When producing templates, ensure output is compatible with direct inclusion in PHP templates and uses Bootstrap classes for layout and spacing. All interactive behaviors should degrade gracefully and be achievable with small, explicit JavaScript snippets.
