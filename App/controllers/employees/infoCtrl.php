<?php

// Initialize variables
$errors = []; // Array to store potential errors
$email = null; // User's email (initialized as null)
$password = null; // User's password (initialized as null)

try {
    // Check if the user is logged in by verifying the session
    if (!empty($_SESSION['user'])) {
        // Retrieve email and password from the session
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
    }
} catch (Exception $e) {
    // Add an error message in case of an exception accessing the session
    $errors['infoAccount'] = $e->getMessage();
}

// Call the render function to display the employee info view
render('employees/info', [
    'email' => $email, // Pass email to the view
    'password' => $password, // Pass password to the view (consider security implications below)
    'errors' => $errors // Pass any errors to the view
]);