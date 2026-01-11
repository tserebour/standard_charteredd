# 17 — Transfers Backend Logic

## Transactionality
All money movements must be ACID compliant.
- Use `PDO::beginTransaction()`, `PDO::commit()`, and `PDO::rollBack()`.
- Wrap the debit (From Account) and credit (To Payee/Account) in a single transaction block.

## Transfer Validation Rules (Server-Side)
1. **Ownership**: Verify `From Account` belongs to the logged-in user (`WHERE id = ? AND user_id = ?`).
2. **Funds**: `From Account` balance >= `Amount`.
3. **Amount**: Must be positive (`> 0`).
4. **Dates**: Backward-dated transfers are allowed (recorded as `created_at` now, but `effective_date` stored if schema supports it—for this demo, just allow standard processing).

## Sequence of Operations
1. Start DB Transaction.
2. Select `From Account` with `FOR UPDATE` (if locking supported/desired, or just standard select check).
3. If insufficient funds -> Rollback and Error.
4. Update `From Account`: `balance = balance - amount`.
5. Insert `transaction` record for `From Account` (Debit).
6. IF `To Account` is internal (another user or same user):
   - Update `To Account`: `balance = balance + amount`.
   - Insert `transaction` record for `To Account` (Credit).
7. Commit DB Transaction.

## Error Handling
- On exception (PDOException): Call `rollBack()`.
- Return user to form with "System Error" message.
