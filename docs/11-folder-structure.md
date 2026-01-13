# 11 — Folder Structure

PHP page organization
- `pages/` — top-level PHP templates mapped to routes (UI-only). Example files:
  - `pages/login.php`
  - `auth/security-question.php`
  - `pages/dashboard.php`
  - `pages/account-details.php`
  - `pages/transfers-new.php`

Assets folder structure
- `assets/` root for static assets.
  - `assets/css/` — compiled CSS and Bootstrap overrides.
  - `assets/js/` — small vanilla JS modules (UI-only behavior).
  - `assets/img/` — icons and illustrations (SVG preferred).
  - `fixtures/` or `data/` — JSON or PHP arrays containing dummy data for templates.

Includes and partials
- `includes/` for header, footer, sidebar, and component partials.
  - `includes/header.php`
  - `includes/footer.php`
  - `includes/sidebar.php`
  - `includes/components/account-summary.php`

Template rules
- Keep PHP usage minimal: primarily `include`/`require` for partials and simple loops to iterate fixtures. Do not implement backend logic in templates.
- Keep static fixture reading centralized: `data/fixtures.php` or JSON files parsed in a single `bootstrap` include.

Example tree (minimal)
```
project-root/
├─ pages/
│  ├─ dashboard.php
│  └─ account-details.php
├─ includes/
│  ├─ header.php
│  └─ components/
├─ assets/
│  ├─ css/
│  ├─ js/
│  └─ img/
└─ data/
   └─ fixtures.json
```
