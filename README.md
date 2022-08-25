This repository contains an application for viewing and editing text documents. Users of the application
can:

* Create new pages
* Edit any existing page
* View a list of existing content

## Your task

In `index.php`, `api.php` and `main.js` you will find TODO comments. Using about 90 minutes of your time, your task
is to work on these TODOs by writing PHP, JavaScript and code comments. *It is not reasonable to complete all the TODOs
in 90 minutes–we will judge your submission based on the TODOs that you worked on, and not the ones you didn't do.*

Please use your creativity and judgment to show us how you fix bugs, add features, document code, and refactor a
not-so-well-written codebase.

## How your response will be evaluated

What we'd like to see in your submission:

- [ ] You have refactored the codebase to improve its readability and documentation
- [ ] You've added working JavaScript/PHP for some bug fixes / feature requests in the TODOs
- [ ] You have used Git to make your changes, with [quality commit message(s)](https://www.mediawiki.org/wiki/Gerrit/Commit_message_guidelines/en)
- [ ] You've added some PHPUnit tests *or* comments/pseudocode explaining what PHPUnit/JavaScript tests you would add
 if you had more time
- [ ] You have added your own TODO/FIXME comments for performance/security/readability issues you have identified but
 don't have time to fix

### Note

You may use external libraries, but please don't use a fully-fledged framework (like Laravel or Symfony) for the
entire exercise–we would like your solution to evolve the existing code, rather than replace it.

## Usage

Download [composer](https://getcomposer.org/), then:

1. `composer install` – installs dependencies for the application
2. `composer serve` - Serves the application
   1. Web UI is available at http://localhost:8989.
   2. API is available at http://localhost:8989/api.php
   3. If you need to change the port, you can do that in `composer.json`
3. `composer seed` – Generate seed content for the application
4. `composer test` – Lint files and run tests

## Submission

Please create a ZIP file of the git repository and send back to the recruiter.
