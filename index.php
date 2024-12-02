<?php

// Include necessary utilities
require 'App/utils/utils.php';

/**
 * Autoload function to automatically load the required classes.
 * This function replaces backslashes with slashes and includes the corresponding file if found.
 */
spl_autoload_register(function ($class) {
    // Replace backslashes with slashes to create the file path
    $class = str_replace('\\', '/', $class);

    // Define the file path of the class
    $file = __DIR__ . "/$class.php";

    // Check if the file exists and include it, otherwise handle the error
    if (file_exists($file)) {
        require $file;
    } else {
        // Handle autoload errors by returning a 404 page
        header("HTTP/1.0 404 Not Found");
        echo "The file $file could not be found.";
        exit;
    }
});

// Start the session to manage user data
session_start();

// Associative array containing routes and their corresponding controllers
$routes = [
    // Home
    '/' => 'App/controllers/indexCtrl.php',

    // Employees and Visitors
    '/login' => 'App/controllers/users/loginCtrl.php',      // Login page
    '/logout' => 'App/controllers/users/logoutCtrl.php',    // Logout action
    '/infoUser' => 'App/controllers/employees/infoCtrl.php', // User information page

    // Enclosures
    '/enclos' => 'App/controllers/enclosures/indexCtrl.php',    // List of enclosures
    '/addEnclosure' => 'App/controllers/enclosures/createCtrl.php', // Add new enclosure
    '/enclos/delete' => 'App/controllers/enclosures/deleteCtrl.php', // Delete an enclosure

    // Animals
    '/addAnimal' => 'App/controllers/animals/createCtrl.php',    // Add new animal
    '/animalActions' => 'App/controllers/animals/actionsCtrl.php', // Animal actions (e.g. update, delete)
];

// Retrieve the requested URL
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the requested URL matches any defined route
if (isset($routes[$url])) {
    // If the route exists, include the corresponding controller
    require $routes[$url];
} else {
    // If no route matches, display a 404 page
    require 'App/views/404.php';
}