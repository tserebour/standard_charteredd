# 00 — Overview

Project purpose
- Provide a conservative, bank-grade user interface (UI) prototype for a retail banking website. The content is UI/UX-only and uses dummy data. This repository contains canonical documentation that governs all design and UI behavior decisions so future AI agents can implement, review, or update UI pages without ambiguity.

Target user type
- Primary: Retail banking customers (individuals with deposit and payment accounts).
- Secondary: Internal testers, UX reviewers, and automated AI agents that produce or modify frontend templates.

High-level system description
- Frontend-only, server-rendered pages (Vanilla PHP used solely to assemble templates). No backend logic, APIs, authentication, encryption, or live data.
- Responsibilities of the UI layer (this project):
  - Present account information using dummy data and masked identifiers.
  - Drive user flows for account overview, transfers, cards, and transaction browsing with realistic UX patterns (multi-step confirmations, success and error states as UI concepts).
  - Maintain an accessible, predictable navigation and information architecture suitable for banking customers.

Constraints (explicit)
- No real transactions, no real authentication, no APIs, no encryption, no KYC, no compliance logic. Everything is static/dummy and presented as UI-only examples.

Deliverables
- Canonical Markdown documentation in `/docs` describing design system, page map, flows, dummy-data rules, and strict agent rules for future automation.
