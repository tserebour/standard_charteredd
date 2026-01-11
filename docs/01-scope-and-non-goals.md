# 01 — Scope and Non-Goals

What the project includes (explicit)
- Static, server-rendered pages using Vanilla PHP templates, HTML, CSS, Bootstrap, and minimal Vanilla JavaScript for non-critical UI interactions.
- UI patterns for:
  - Public marketing-lite page (static example) and informational footers.
  - Authentication pages (login, forgot password) rendered as UI-only examples with dummy validation.
  - Customer dashboard: account summary, balances, recent transactions, and cards overview.
  - Transfers and payments flow (UI-only, multi-step confirmation screens with dummy results).
  - Transaction search, filters, and paginated lists (UI behavior described; no backend search).
  - Card management UI (lock/unlock toggle displayed as UI-only state change).
  - Design system and accessibility guidance (visual only).

What the project explicitly does NOT include
- No backend business logic, no payment rails, no data persistence beyond sample fixtures.
- No real user authentication, session security, encryption, or token handling.
- No integration with third-party services (no email/SMS, no payment gateways).
- No regulatory or compliance code (AML, KYC, PCI). These topics may be documented conceptually but not implemented.
- No production deployment scripts, CI/CD, or infrastructure templates.

Agent implications
- AI agents must not infer or create any backend behaviour, network calls, or storage mechanisms. Any required dynamic behavior must be simulated in the UI using dummy data and explained clearly in comments/README (UI-only).
