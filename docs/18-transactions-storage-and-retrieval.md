# 18 — Transactions Storage and Retrieval

## Storage Strategy
- All transactions are stored in a single `transactions` table.
- A "Transfer" between two internal accounts results in **two** rows:
  1. A debit row linked to the sender's `account_id` (Negative amount).
  2. A credit row linked to the receiver's `account_id` (Positive amount).
- This simplifies querying: "Select all rows where account_id = X" gets the full history.

## Retrieval Query
- **Basic History**:
  ```sql
  SELECT * FROM transactions 
  WHERE account_id = ? 
  ORDER BY created_at DESC 
  LIMIT 25 OFFSET ?
  ```

## Filtering Logic (Backend)
- Filters passed via GET params to `pages/transactions.php` (or an API endpoint).
- Build the `WHERE` clause dynamically using prepared statements (no string concatenation of user input!).
  - If `?search=grocery`: `AND description LIKE %grocery%`
  - If `?date_from=2023-01-01`: `AND created_at >= '2023-01-01'`

## Pagination
- use `LIMIT` and `OFFSET`.
- Calculate offset: `($page - 1) * $limit`.
- Use a secondary query `SELECT COUNT(*) ...` with same filters to determine total pages.
