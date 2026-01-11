# 16 — Authorization and Protected Routes

## Middleware Strategy
Since we are using vanilla PHP with no framework router, "middleware" is implemented as a required file inclusion at the top of every protected script.

### `includes/auth_check.php`
- **Responsibility**: Verify session validity.
- **Logic**:
  1. `session_start()` (if not already started).
  2. Check if `$_SESSION['user_id']` exists.
  3. If missing:
     - `header("Location: /pages/login.php");`
     - `exit;` (Critical: always exit after header redirect).

## Protected Routes
The following pages must include `auth_check.php` immediately after opening PHP tags:
- `pages/dashboard.php`
- `pages/account-details.php`
- `pages/transfers-new.php`
- `pages/cards.php`
- `pages/transactions.php`
- `actions/process-transfer.php`
- `actions/lock-card.php`

## Public Routes
Do not include auth check on:
- `index.php`
- `pages/login.php`
- `actions/login.php`
- `pages/forgot-password.php`
