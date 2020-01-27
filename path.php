<?php 

// Here, we will define our constant, it takes first argument root path,and second argument is value


define ("ROOT_PATH", realpath(dirname(__FILE__)));

// This is another constant, that accepts strings, it works for links and JS and CSS files, etc.
// It will point us to the our domain name, we will connecting files using links.

define ("BASE_URL", "http://localhost:8080");


?>

