# 08 — Cards UI

Card display components
- Card list: show card nickname, masked number `XXXX •••• •••• 1234`, expiry (MM/YY), and status badge.
- Visual card: optional simplified SVG-backed rectangle showing last 4 digits and network icon (Visa/Mastercard) as static illustration.

Card status indicators
- Active: neutral label with no accent.
- Blocked/Locked: red pill "Locked" with tooltip describing "Card locked — UI-only state".
- Expiring soon: amber pill "Expiring soon" with action `Request replacement` (UI-only).

Allowed card actions (UI-only)
- Lock/unlock card (UI toggle) — present an immediate visual state change and a confirmation modal for `Lock`.
- Set travel notice (UI-only): present a form and show a success banner — do not implement networking.
- Request replacement (UI-only): show a multi-step form that ends with a confirmation page.

Action behavior rules
- All destructive actions must require a confirmation modal with explicit `Confirm` button.
- When toggling lock state, show a transient in-page alert (success or error) describing the new state.
