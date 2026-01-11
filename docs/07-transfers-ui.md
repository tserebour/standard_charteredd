# 07 — Transfers UI

Transfer flow (step-by-step)
1. Initiation
   - User clicks `New transfer` from account summary or transfers page.
   - Present a single-screen form: `From account` (pre-selected masked account), `To` (select or enter payee), `Amount`, `Date` (default: Today).
2. Review
   - Show a review screen with masked `From` and `To` identifiers, transfer amount, and a summary of fees (if any — always dummy). Show `Edit` and `Confirm` actions.
3. Confirmation
   - Show a modal or full-screen confirmation with strong primary `Confirm` button and secondary `Cancel`.
4. Result
   - Success: show a success page with a unique dummy reference (formatted per dummy-data rules) and a `Return to account` action.
   - Failure (UI-only): show inline error with reason (e.g., "Insufficient funds") as a simulated scenario.

Validation behavior (visual only)
- Amount field: validate numeric, min value `0.01`, max equal to (available balance) in UI only. Show inline validation messages beneath the field.
- Payee validation: if entering a new payee, require `Name` and `Account number` fields; display masked account number in review.
- Date: prevent selecting past dates beyond 90 days as a validation guideline (UI-only).

Confirmation screens
- Must display:
  - All masked identifiers (no full account numbers)
  - Transfer amount with currency symbol and two decimal places
  - Transfer reference (dummy)
  - `Back` or `Edit` and a clear `Confirm` call-to-action
- Use a two-step confirmation for any transfer >= $1,000 (UI-only rule) — show an additional `Confirm` step with prominent copy: "Large transfer — confirm details".
