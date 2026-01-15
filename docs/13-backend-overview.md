# 13 — Backend Overview

## Purpose and Philosophy
The backend layer exists to provide persistence, basic authentication, and logical validation to the retail Place interface. It replaces the frontend-only dummy data with a functional relational database.

The implementation philosophy is **"Academic Demo"**:
- **Simplicity over Scalability**: Use vanilla PHP and synchronous processing.
- **Clarity over Abstraction**: No complex frameworks (like Laravel or Symfony); use raw text includes and PDO.
- **Strict Scoping**: Implement *only* what is visible in the UI. Background jobs, queues, and third-party APIs are explicitly out of scope.

## Architecture
- **Language**: PHP 8.x
- **Database**: MySQL / MariaDB
- **State Management**: Native PHP Sessions (`$_SESSION`)
- **Routing**: File-based routing (1 file = 1 URL). e.g., `/pages/login.php`.

## Relationship to UI
The UI (HTML/CSS/JS) is the "master" of visuals. The backend code sits primarily in the PHP logic block at the top of each page file or in `actions/` scripts that handle form POSTs.

- **GET requests**: Render the existing HTML templates, injecting data from the database instead of JSON fixtures.
- **POST requests**: Handle form submissions (Login, Transfer), validate data, update the database, and redirect.
