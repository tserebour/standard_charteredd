# 05 — Authentication Flow (UI-only)

Login UI behavior
- Show `username` and `password` fields with `Show`/`Hide` toggle on password input (client-side only). Do not implement actual authentication.
- Provide `Remember this device` checkbox but document it as visual-only (no cookie or persistence implementation).
- Provide clear primary action `Sign in` and secondary link `Forgot password`.

Error states (invalid credentials — dummy)
- Invalid credentials:
  - Visual treatment: inline error banner above the form with `role="alert"` and red background (per design tokens).
  - Message copy: "Invalid credentials. Please check your username and password and try again." — do NOT display password or username values.
  - Fail count simulation: show message "Account locked after 3 failed attempts" only as a UI scenario; do not implement lock logic.
- System error (dummy): generic banner "We’re unable to process your request right now. Try again later." — no retries built into backend.

Forgot password flow
- Step 1: Collect identifier (email or masked phone). Immediately present a confirmation screen: "We sent instructions to ****@example.com" (masking rules defined in dummy data doc).
- Step 2: Offer `Return to login` action.

Session assumptions (UI-only)
- Assume an authenticated session for any dashboard pages. The UI should show a masked user name (e.g., `J. Smith`) and a sign-out control that navigates to a static sign-out confirmation page.
- Sessions are simulated; do not implement expiry, cookies, or token handling.
