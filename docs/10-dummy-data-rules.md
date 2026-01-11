# 10 — Dummy Data Rules

Balance formats
- Currency symbol: local currency $ (or configurable token but default $ for examples).
- Format: use two decimals and thousand separators, e.g., `$12,345.67`.
- Negative balances: show minus sign and red color `- $123.45`.

Transaction naming conventions
- Description formats:
  - Standard payment: `PAYMENT - <Payee Name>`
  - Card purchase: `CARD - <Merchant Name>`
  - Direct debit: `DD - <Biller>`
  - Transfer (internal): `TRANSFER - <From> → <To>`
- Keep descriptions concise (max 60 characters recommended for UI rows).

Date and time formats
- Dates: `YYYY-MM-DD` for data layer, UI display: `DD MMM YYYY` (e.g., `11 Jan 2026`).
- Times: `HH:MM` 24-hour format where shown.

Masking rules
- Account numbers: show last 4 digits only: `Account ••••1234` or `****1234`.
- Card numbers: `XXXX •••• •••• 1234`.
- Emails: mask local part to first character and domain: `j****@example.com`.
- Phone numbers: mask middle digits: `+1 (555) ***-1234`.

Identifiers and references
- Transfer reference: `TR-` + 8 uppercase alphanumeric characters (dummy). Example: `TR-4A7G9P1B`.
- Transaction ID: `TX-` + 10 digits dummy. Example: `TX-0001234567`.

Data source notes
- All sample datasets must be stored under a clearly labeled `fixtures/` or `data/` folder with filenames like `fixtures/accounts.json` and documented in `/docs/11-folder-structure.md`.
