# recruiting-test

In this recruiting test, you must perform a very basic web page that allows people to say useless stuff generated from a web service.

There is a main trunk list of tasks to perform in a given order.

## Test requirements

We strongly suggest that you set up your project. You will need:
 - PHP (Use a framework that you feel comfortable with)
 - Bootstrap
 - A third part storage service (Database, file, etc.)
 - A web-server

#### If I don't know how to?

Don't worry, that's absolutely normal. Don't fear to use Stack-Overflow/OpenClassrooms or Google. That's part of the developer job. 

#### If I don't have the time to finish?

That's ALSO absolutely normal. The objective is to verify some capabilities and how you work.

#### Can I start working on it before the interview ? 

The test is meant to be known before the interview occurs. For the good reason to allow people who feel the need to prepare it to do so.

We really don't care if you start working on this beforehand. All that really matter is the building process, not the fact that everything runs perfectly.

**We don't want you to work too much on this**, after all, it's just a job interview.

## Application requirements

We intend to provide a web page that allow user to put comment on a beer. The web page displays all posted comments as cards paginated across many pages.

1. Clone this git public repository, start a new branch. From now use git as a tool for this project.
1. Display a page with a title "Hello World!".
1. Display some dynamic content based on the page:
   - Server UTC time, formatted using [ISO-8601](https://en.wikipedia.org/wiki/ISO_8601) standard format 
   - The HTTP client IP address
1. Now, create a form with some fields:
   - Username
   - Beer name
   - Comment
1. Add some validation in PHP on the field comment, it must be emptyish (null, empty, only spaces).
1. Add some validation in JavaScript on the field username, it can accept only alphanumeric characters.
1. Upon form POST submission, store the fields permanently in your third part storage service. 
1. Main page must now display list of comments in cards respecting this HTML structure:
    ```html
    <div class="comments">
      <div data-username="{username}" data-beer="{beername}">
        {comment}
      </div>
      <div data-username="{username}" data-beer="{beername}">
        {comment}
      </div>
      <!-- And so on -->  
    </div>
    ```
1. Upon form submission, you must generate store extra information as resolved through [Punk API](https://punkapi.com/documentation/v2). We want to store punk API's `id` and `image_url`.
1. Needless to say, that you read this thoroughly before coding and prefixed all your main page variables with `beer` from the beginning.
1. Display this image in the list of comments.
1. Use CSS in the page in order to:
   * Display user comment within a box rounded green corner, in a square of 300px.
   * Comment must be vertically and horizontally centered.
   * Beer name must appear at the top left of the box as a bold text.
   * Username must appear at the bottom right of the box as italic text.
   
         -------------------------------------------
         | Beer name                               |
         |                  Comment.               |
         |                               Username  |
         -------------------------------------------

   * Comments must be displayed horizontally, if there are too many items they must flow to the left:
   
     Like this, if it matches 5 columns:
     
         Q Q Q Q Q
         Q Q Q Q Q
         Q
     
     Like this, if it matches 4 columns:
     
         Q Q Q Q
         Q Q Q Q
         Q Q Q Q
         Q Q

1. The username should now be anonymized upon display, and match this vague pattern:
    ```
    Raymond             Rayxxxx
    Camille             Camxxxx
    Jean                Jeaxxxx
    Charline            Chaxxxxx
    Sébastien           Sébxxxxxx
    Guillaumette        Guixxxxxx
    Anne-Henriette      Annxxxxxx
    Alain Dupaire       Alain D.
    David Henry Jones   David J.
    ```

1. Write a minimal documentation describing:
   * Standard documentation for method/Class
   * The purpose of the code
   * Anything that may help succeed developers how to operate and deploy your code

## Expectation

This test intends to verify some capabilities:

* English language comprehension
* Bootstrapping ability
* Basic HTTP comprehension (Headers, Verb)
* HTML and CSS basic usage, as well as more advanced features.
* Documented REST service usage
* Client side validation (JavaScript)
* Server side operations and validation
* General knowledge of internet features
* Autonomy, and proactiveness.
