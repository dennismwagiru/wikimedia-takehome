# Evaluation

TODO: Delete from the repository and its history before sending to candidates 😅

## AppTest.php

* uses @coversDefaultClass / @covers tags
* renames $x to something intelligible
* uses data providers or else more assertions to check edge cases (invalid formatting )
* uses something in addition to 'assertContains'

## index.php

### Double check HTML validity

* the rendered document should be valid HTML. Currently there are unclosed tags.

### Security review

* Are the stylesheets and JS loaded via HTTPS?
* Big security flaw: user can pass a title like "../../Foo" and write data to the filesystem.
* XSS is possible when displaying data back to useo

### cleaner way to handle GET/POST in this file?

* good response will move logic into App class

### Writing HTML by concatenating strings :(

* setting up a templating engine is probably out of scope (and not a great prioritization of time); a good response would be to create a method for building HTML.
*

### Auto complete widget to load existing articles when typing in this

* See also note in main.js

### Preview should be adjacent to the text area

* basic placement via CSS

### Articles should be in a separate row below the text editor and preview

* basic placement via CSS

### Get a dynamically generated list of articles from the articles directory

* should add logic to App class with some performance consideration (caching, or limiting results)

### Wikify" the title (E.g. lowercase "foo" is "Foo", "Foo bar" is "Foo_bar"

* does their solution for uppercasing first character account for RTL languages or languages other than English?

### Consider optimizing

* does the solution account for word counting in non English languages?
* do they cache the word count?

## seedContent.php

* how do they make the number configurable, is it a config file, CLI argument?
* do they make anything else configurable?

## main.js

### Use Vue / React / Svelte / framework of your choice if that is easier.

* do they opt to use a framework? How do they use it?

### Load the article preview and allow updating the article without requiring a browser refresh

* Are they able to do this?

### The "title" field should autocomplete on existing articles in the system.

* Does their solution work? Does it show awareness of performance concerns?
