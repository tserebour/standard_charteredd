# 19 — Security Boundaries

## Implemented Measures (Within Scope)
1. **Input Sanitization**: All POST data must be sanitized (e.g., `filter_input()`).
2. **Prepared Statements**: ALL database queries must use `PDO::prepare()` and `execute()`. String interpolation in SQL is strictly FORBIDDEN to prevent SQL Injection.
3. **Password Hashing**: `password_hash()` (Bcrypt).
4. **XSS Protection**: `htmlspecialchars()` used when outputting user-generated content (names, descriptions) to HTML.
5. **CSRF Protection**: Simple token check on state-changing forms (transfers, profile edits).
   - Generate `$_SESSION['csrf_token']`.
   - Include `<input type="hidden" name="csrf_token" value="...">`.
   - Verify on POST processing.

## Excluded Measures (Academic Scope)
1. **Encryption at Rest**: Database fields are stored in plain text (except passwords).
2. **Encryption in Transit**: We assume localhost/http for development (TLS not enforced).
3. **2FA / MFA**: Not implemented.
4. **Rate Limiting**: Not implemented (assumed low traffic).
5. **Compliance**: No GDPR/PCI-DSS logging or erasure logic.

## Rationale
This is a demonstration of *application logic*, not infrastructure hardening. The focus is on clean PHP code and logical correctness.
