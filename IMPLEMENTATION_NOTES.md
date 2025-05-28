Overview
This file summarizes the decisions I made while working through the take-home task, including trade-offs and implementation notes.

### Refactoring `index.php` for readability
To improve clarity and maintainability, I started by refactoring `index.php`:
* Extracted HTML chunks into two named functions: `wfRenderHeader()` and `wfRenderForm()`.
* Used `heredoc` syntax (`<<<HTML`) for cleaner, more readable multi-line HTML output.
* Added basic PHPDoc-style comments to improve documentation and structure.

### Introducing a Layout Template and Partials
After refactoring, i realized the page layout was fragmented and hard to follow. For maintainability and clarity:
* I introduced a `layout.php` template to contain the global HTML structure.
* I moved the header and form rendering logic into `partials/header.php` and `partials/form.php`.
* This separation reduced noise in `index.php`, making it easier to reason about and scale the codebase

### Security Improvements
* Escaped all user-supplied output (`$_GET`, `$_POST`) using `htmlspecialchars()` with appropriate flags (`ENT_QUOTES | ENT_SUBSTITUTE`) to prevent XSS and encoding issues.

### Styling and Responsiveness
To improve the layout and mobile responsiveness:
* I added new styles to `styles.css` targeting the layout containers.

Optional enhancements planned but not implemented
* A media query to further optimise mobile layout below 600px width
* `:focus` state styling for form fields to improve keyboard accessibility
