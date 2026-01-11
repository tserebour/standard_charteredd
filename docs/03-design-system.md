# 03 — Design System

Color usage (blue-dominant palette)
- Primary: Bank blue — used for primary actions, links, and brand accents.
  - Example semantic names: `--brand-blue: #0b63b7` (primary), `--brand-blue-dark: #084f93` (hover/active).
- Neutrals: greys for surfaces and text. High-contrast text on white/neutral backgrounds.
- Error: reserved red (`#c53030`) for destructive or validation states only.
- Success: reserved green (`#2f855a`) for success messages only.

Typography hierarchy
- Font stack: system UI stack (e.g., -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial).
- Scale:
  - H1: 28px / 36px line-height — Page title (used sparingly).
  - H2: 22px / 30px — Section titles in dashboards.
  - H3: 18px / 24px — Cards and panel titles.
  - Body: 14px / 20px — Primary reading text.
  - Small: 12px / 16px — Labels, secondary meta text.

Button styles
- Primary button (brand blue): full-bleed or contained primary actions (e.g., `Proceed`, `Confirm`). Use uppercase label with 12–14px text, 8–10px vertical padding.
- Secondary button (outline or neutral): for non-primary actions (e.g., `Cancel`, `Back`).
- Tertiary link-style buttons: for inline actions and de-emphasized choices.
- Disabled state: reduce opacity to 50%, maintain visible contrast for accessibility.

Spacing and layout rules
- Page width: max 1200px container for desktop; use Bootstrap container breakpoints.
- Gutter: 24px default horizontal spacing; use Bootstrap grid columns for layout.
- Vertical rhythm: 16px base spacing; multiples for section separation (16, 24, 32, 48).

Accessibility considerations (visual only)
- Color contrast: Ensure text contrast >= 4.5:1 for body text and >= 3:1 for large text. Use brand blue only when contrast passes accessibility checks for its use case.
- Focus states: Visible focus ring for keyboard navigation (avoid relying on outline: none).
- Motion: no non-essential motion. All transitions must be short (<= 150ms) and optional.
- Clear affordances: buttons and controls must be visually distinct from plain text links.

Tokens and naming
- Use semantic tokens: `--brand-blue`, `--neutral-100` etc. Do not hardcode hexes repeatedly in templates.
