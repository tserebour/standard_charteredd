# 12 — AI Agent Rules

Purpose
- Enforce strict, unambiguous rules for any AI agent that will read, modify, or generate UI templates in this project.

General principles (required)
- Always treat this repository as UI-only. Do not create or assume backend endpoints, authentication flows, storage, or network calls.
- When in doubt, ask for human confirmation (logically: create an explicit `TODO` comment in the code and a message in the agent's output). Agents must not implement behavior that requires backend integration.
- Produce deterministic, idempotent edits. Each change must be reversible and accompanied by a short rationale comment in the commit message or patch.

Prohibited assumptions
- Do not assume the presence of databases, external services, or secret keys.
- Do not infer or invent encryption, compliance, or transaction processing logic.
- Do not seed or use real PII, personal data, or production credentials.

Content and consistency rules
- Terminology: use these exact terms consistently across files: `Available balance`, `Current balance`, `Pending`, `Masked account`.
- Design tokens: reference tokens defined in `03-design-system.md` rather than hard-coded colors.
- Dummy data: must adhere to `10-dummy-data-rules.md` for formats and masking.

UI edit rules
- Never add new interactive behavior that cannot be achieved with vanilla JS and static templates. If a feature requires backend logic, create a UI-only mock and document its expected real-world behavior in comments.
- All confirmation flows must be explicit multi-step UIs with clear `Confirm` and `Cancel` actions.

Testing and verification
- Agents must run automated checks on generated HTML for: semantic tags, visible focus outlines, presence of `role="alert"` for banners, and use of tokenized colors.
- Agents must not run any network operations as part of verification.

When creating sample fixtures
- Put all fixtures under `data/` or `fixtures/` and include an explicit `README` inside the folder explaining that data is fictional and the source is `generated`.

Change management
- For any change that alters global tokens, design system, or navigation, create a short migration note in `docs/` describing the reason and effect.

If unsure
- Create an incremental UI-only patch + `TODO` comment and notify a human reviewer. Do not guess security or backend details.
