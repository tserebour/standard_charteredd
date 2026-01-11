# 20 — Backend Folder Structure

## Directory Map

### `config/` (New)
- `db.php`: Returns the PDO connection object.
- `constants.php`: App-wide constants (currency, bank name).

### `actions/` (New)
Handle POST requests. These files do *not* render UI. They process logic and redirect.
- `login.php`: Processes auth.
- `logout.php`: Destroys session.
- `transfer-process.php`: Handles transfer logic.
- `card-process.php`: Handles card locking/requests.

### `includes/`
- `auth_check.php`: Middleware inclusion.
- `utils.php`: Extended with backend helpers (sanitization, formatting).

## Naming Conventions
- **Files**: Kebab-case (`my-file.php`).
- **Variables**: Snake_case (`$user_id`).
- **Classes** (if any): PascalCase (`User.php`).
- **Functions**: Snake_case (`get_user_by_id()`).

## Separation of Concerns
1. **Pages (`pages/`)**: Presentation Layer. Fetch data, Render HTML.
2. **Actions (`actions/`)**: Logic Layer. Validate inputs, Write to DB, Redirect.
3. **Includes (`includes/`)**: Shared Components.
