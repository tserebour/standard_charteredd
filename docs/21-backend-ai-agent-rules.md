# 21 — Backend AI Agent Rules

## Directives for Future Implementation
When writing PHP/SQL for this project, you MUST:

1. **Adhere to the Stack**: Use **Vanilla PHP** and **PDO**. Do not suggest installing Composer packages, Laravel, or ORMs (Eloquent/Doctrine).
2. **Respect the Scope**: Do not implement features not defined in these docs. If a user asks for "Crypto trading", refuse based on the project scope.
3. **Follow Security Rules**:
   - NEVER write a query with variables inside the string. ALWAYS use `?` Places.
   - ALWAYS use `htmlspecialchars()` for output.
4. **Maintain Consistency**:
   - Use the directory structure defined in `20-backend-folder-structure.md`.
   - Use the variable naming conventions from `20-backend-folder-structure.md`.

## Prohibited Behaviors
- **No Logical Gaps**: Do not create a "Transfer" action that doesn't check balance first.
- **No "TODO" Leftovers**: Documentation is the spec. Implementation should be complete and functional based on that spec.
- **No Complex Architectures**: Do not introduce Repository patterns, Service containers, or Dependency Injection containers. Keep it procedural and simple (Include -> Query -> Render).

## Error Handling
- Fail gracefully. If the DB is down, show a "System Maintenance" message, not a stack trace.
- Use `try/catch` around PDO operations.
