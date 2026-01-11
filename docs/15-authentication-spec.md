# 15 — Authentication Spec

## Credentials
- **Username/Password**: Standard auth.
- **Hashing**: Use `password_hash($pass, PASSWORD_DEFAULT)` for storage and `password_verify()` for checking. MD5 or SHA1 are strictly PROHIBITED.

## Login Flow
1. User submits POST form to `actions/login.php`.
2. Script sanitizes inputs.
3. Query `users` by username.
4. If found && `password_verify()` is true:
   - Call `session_start()`.
   - Regenerate session ID (`session_regenerate_id()`).
   - Store `user_id` and `username` in `$_SESSION`.
   - Redirect to `/pages/dashboard.php`.
5. If invalid:
   - Redirect back to login with `?error=invalid_credentials`.
   - UI displays error banner.

## Session Lifecycle
- **Duration**: PHP default (usually 24 minutes or browser close).
- **Logout**:
  - GET `actions/logout.php`.
  - Destroy session (`session_destroy()`).
  - Redirect to `index.php`.

## Access Control
- All pages in `/pages/` (except public ones like `login.php`) must check for `isset($_SESSION['user_id'])`.
- If check fails, redirect immediately to `login.php`.
