# 06 — Dashboard UX

Layout structure
- 2-column layout on desktop: collapsible left sidebar (navigation) and main content area. On mobile, sidebar collapses into a top drawer/menu.
- Top bar contains masked user info, notifications icon, and help link.

Sidebar behavior
- Persistent on desktop, collapsible on smaller viewports. Active route highlighted with brand-blue left border or background.
- Collapse state: show icons only; expand to show labels. Default: expanded on desktop.

Account summary components
- Summary card (per account):
  - Account name (e.g., Savings), masked account number, current balance (formatted) and available balance if applicable.
  - Quick actions: `Transfer`, `View transactions`, `Statements`.
  - If an overdraft or negative balance: show an inline warning pill in neutral red with next steps copy.

Notifications and top bar
- Notification patterns: non-modal banners for global messages, small unread count indicator on bell icon for contextual alerts.
- Multi-step confirmation overlays should dim background and require explicit `Confirm` or `Cancel`.

Component rules
- All monetary values must use the dummy-data format and masking conventions from `10-dummy-data-rules.md`.
- Microcopy must be precise; avoid marketing language. For example: "Available balance" vs. "Current balance" must be used consistently per the definitions in the dummy data rules.
