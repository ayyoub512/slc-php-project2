<?php
/**
 * Note: I have built my own mini MVC in this project, by relying on output buffering..
 * It's used in the render method found in functions.inc.php
 * This was the structor of folders I followed on skills ontario,
 * https://github.com/ayyoub512/ontario_soccer_club5
 * and if I remember correctly, for the restaurent menu project (BitBite) of last year
 * https://github.com/ayyoub512/BitBite
 * 
 * I have also used Tailwindcss for this project to make things slightly fun :)
 * 
 **/

require __DIR__ . '/inc/all.inc.php';


render('index.view', [
    'title' => 'Index ',
    'current' => 'index',
]);