# 09 — Transactions UI

Transaction list layout
- Primary view: compact list with date, description, counterparty, category (optional), and amount aligned to the right.
- Each row: click expands a detail panel showing transaction ID (dummy), running balance (if shown), and narrative.

Filters and search behavior
- Filters: Date range, Type (Debit/Credit), Amount range, Category, Counterparty.
- Search: client-side string match against description and counterparty fields in the dummy dataset.
- When filters are applied, show active filters as removable chips above the list.

Pagination rules
- Default page size: 25 rows. Provide `Previous` / `Next` controls and numeric page buttons.
- Indicate total count: "Showing 1–25 of 2,340" (dummy numbers). For performance in UI-only prototype, paginated data is simulated.

Empty and error states
- Empty list: show an empty state card with guidance "No transactions found for the selected filters" and CTA `Reset filters`.
- Error state (UI-only): show a dismissible banner "Unable to load transactions. Try again." and do not attempt retries.
