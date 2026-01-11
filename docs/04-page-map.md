# 04 — Page Map

Public pages
- Landing (informational): minimal sample with links to login and contact. Not a marketing site — simple, static example.
- Help / Contact: static sample content only.

Authentication pages
- `/login` — Username and password fields (UI-only). Link to `Forgot password` and `Contact support`.
- `/forgot-password` — Enter email or masked phone to display confirmation page (UI-only).

Dashboard pages (after login - UI-only)
- `Dashboard / Accounts` — Overview card listing all accounts with balances.
- `Account / Details` — Per-account page showing latest transactions and account actions.
- `Transfers / New` — Multi-step transfer flow.
- `Cards / Overview` — List of payment cards, status, and allowed actions.
- `Transactions / Search` — Transaction list with filters and pagination.

Navigation rules
- Global header: left-aligned brand, center/top: optional breadcrumb, right: masked user name and utilities (Help, Notifications).
- Primary navigation (sidebar on desktop, collapsible on mobile):
  - Dashboard
  - Accounts
  - Payments & Transfers
  - Cards
  - Statements (static examples)
  - Settings (UI-only)
- Predictable placement: primary account summary top-left, actions contextual to the selected account.

Routing and file organization (UI implication)
- Map pages to PHP templates under `pages/` by name, e.g., `pages/dashboard.php`, `pages/account-details.php`.
