# animationCounter.js
animationCounter.js is a jQuery plugin that animates a number from a value to an other or to a value to an infinite number <br>
Demo: https://mpavade.github.io/animationCounter.js/example/

# Installation & Use
1. Download the latest version from [GitHub](https://github.com/mpavade/animationCounter.js/archive/master.zip)
<br>
or via Bower package manager:<br>
   ```
   bower install animationCounter.js
   ```

2. Add your js file 'animationCounter.js' after jQuery, before your closing body tag   <br>
   ```html
   <script src="animationCounter.js" type="text/javascript">
   ```

3. Then, in your JS file, call the animationCounter() function with default parameters<br>
   ```javascript
  $('yourdiv').animationCounter();
   ```

   Or call animationCounter() function with your parameters like this :  <br>
   Example :  <br>
   ```javascript
   $('yourdiv').animationCounter({
      start: 0,
      end: 500,
      step: 1,
      delay: 1000,
      txt: ' €'
    });
   ```

   # Options
    `start`<br>
    The value where the counter started<br>
    integer - default: 0

    `end`<br>
    The value where the counter stopped<br>
    integer - default: null

    `step`<br>
    The interval between the numbers<br>
    integer - default: 1

    `delay`<br>
    The intervals (in milliseconds) on how often to execute the code default<br>
    integer - default: 1000

    `txt`<br>
    The text displayed after your counter<br>
    string - default: ''

   #Demo
   You can see how it's works on the [demo] page (https://mpavade.github.io/animationCounter.js/example/)

   #License
   Copyright © Micheline Pavadé<br>
   This project is licensed under the MIT License
