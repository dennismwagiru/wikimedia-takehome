## Implementation Notes

### Overview
This file summarizes the decisions I made while working through the take-home task, including trade-offs and implementation notes.

---

### Refactoring `index.php` for readability
To improve clarity and maintainability, I started by refactoring `index.php`:
* Extracted HTML chunks into two named functions: `wfRenderHeader()` and `wfRenderForm()`.
* Used `heredoc` syntax (`<<<HTML`) for cleaner, more readable multi-line HTML output.
* Added basic PHPDoc-style comments to improve documentation and structure.

---

### Introducing a Layout Template and Partials
After refactoring, i realized the page layout was fragmented and hard to follow. For maintainability and clarity:
* I introduced a `layout.php` template to contain the global HTML structure.
* I moved the header and form rendering logic into `partials/header.php` and `partials/form.php`.
* This separation reduced noise in `index.php`, making it easier to reason about and scale the codebase

Security Improvements
* Escaped all user-supplied output (`$_GET`, `$_POST`) using `htmlspecialchars()` with appropriate flags (`ENT_QUOTES | ENT_SUBSTITUTE`) to prevent XSS and encoding issues.

---

### Styling and Responsiveness
To improve the layout and mobile responsiveness:
* I added new styles to `styles.css` targeting the layout containers.
* Used consistent spacing, max-widths, and flexbox to ensure the layout scales well on different screen sizes.

**Optional enhancements planned but not implemented:**
* A media query to further optimise mobile layout below 600px width
* `:focus` state styling for form fields to improve keyboard accessibility

---

### API (api.php) Refactor and Hardening
To improve maintainability and security in `api.php`, I:
* Refactored all routing into clearly structured if-blocks.
* Added a reusable `wfRespond()` function to handle JSON responses with HTTP codes.
* Sanitized `$_GET['title']` using `basename()` to prevent path traversal attacks.
* Returned 404 for missing content and 200 with valid data.
* Documented all supported API routes in PHPDoc.

**Potential Vulnerabilities:**
* Input injection: `$_GET['prefixsearch']` isn't sanitized or validated
* DoS potential: No rate limiting or throtling on prefix/autocomplete API requests.

**Performance Concerns:**
* *Repeated use of`getListOfArticles()`*: On large datasets, this could become costly. Caching into a variable would reduce filesystem reads.
* *Lack of pagination*: Returning hundreds of matches may degrade performance.

**Planed enhancements (if more time was available):**
 - Add `?limit=10` and use something like:
```php
$limit = min((int) $_GET['limit'] ?? 10, 50);
```
