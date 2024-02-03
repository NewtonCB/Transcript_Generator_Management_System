<?php
// Define the routes
$routes = array(
    "/add student data" => "input data.php",
    "/about" => "about.php",
   "/contact" => "contact.php",
);

// Get the requested URL
$url = $_SERVER["REQUEST_URI"];

// Check if the URL matches any of the defined routes
foreach ($routes as $route => $file) {
    if ($route === $url) {
        // If a match is found, include the corresponding file
        include $file;
        break;
    }
}
?>
