# 14 — Database Design

## Design Justification
A normalized relational schema is required to ensure data consistency, particularly for financial transactions (ACID compliance required conceptually).

## Schema Overview

### 1. `users`
Represents the authenticated customer.
- `id` (INT, PK, Auto Increment)
- `username` (VARCHAR, Unique)
- `password_hash` (VARCHAR) — stored using `password_hash()`
- `full_name` (VARCHAR)
- `created_at` (DATETIME)

### 2. `accounts`
Bank accounts owned by the user.
- `id` (INT, PK, Auto Increment)
- `user_id` (INT, FK -> users.id)
- `type` (ENUM: 'Checking', 'Savings')
- `account_number` (VARCHAR, Unique) — Last 4 digits logic handled in app, store full or partial logic consistent with security.
- `balance` (DECIMAL 10,2) — Signed. Negative allowed for overdraft.
- `currency` (VARCHAR, default 'USD')

### 3. `transactions`
Immutable record of all money movements.
- `id` (INT, PK, Auto Increment)
- `account_id` (INT, FK -> accounts.id)
- `amount` (DECIMAL 10,2) — Negative for debits, Positive for credits.
- `type` (ENUM: 'payment', 'transfer', 'deposit', 'fee')
- `description` (VARCHAR)
- `reference_id` (VARCHAR) — Public unique ID (e.g., TR-XXXXXX)
- `created_at` (DATETIME)

### 4. `payees` (Optional/Nice to have)
Saved contacts for transfers.
- `id` (INT, PK)
- `user_id` (INT, FK)
- `name` (VARCHAR)
- `account_number_ref` (VARCHAR)

## Data Integrity Rules
- **Foreign Keys**: Must be enforced at the database level (`ON DELETE CASCADE` or `RESTRICT` depending on safety).
- **Concurrency**: For this academic scope, we assume low concurrency. No complex locking required beyond atomic transaction wrapping for transfers.
