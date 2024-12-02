<?php

use App\models\Employee;
use App\models\Visitor;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $employee = new Employee();
    $visitor = new Visitor();

    // Email validation
    if (!empty($_POST['email'])) {
        try {
            $email = $_POST['email'];
            $employee->setEmail($email);
            $visitor->setEmail($email);
        } catch (Exception $e) {
            $errors['email'] = $e->getMessage();
        }
    } else {
        $errors['requiredEmail'] = 'Please enter an email address.';
    }

    // Password validation
    if (empty($_POST['password'])) {
        $errors['requiredPassword'] = 'Please enter a password.';
    }

    // If there are no errors, check the data in the database
    if (empty($errors)) {
        // Retrieve employee and visitor data by email
        $employeeData = $employee->getByEmail();
        $visitorData = $visitor->getByEmail();

        // Check if the email corresponds to an employee
        if ($employeeData && $_POST['password'] == $employeeData->password) {
            // If the employee is found and the password is correct
            $_SESSION['employee_email'] = $employeeData->email;
            $_SESSION['employee_firstname'] = $employeeData->firstname;
            $_SESSION['employee_id'] = $employeeData->id; // Ensure you have an employee ID
            $_SESSION['role'] = 'employee'; // Add a role to identify the user
            header('Location: /'); // Redirect to the home page or another protected page
            exit;
        }
        // Check if the email corresponds to a visitor
        elseif ($visitorData && $_POST['password'] == $visitorData->password) {
            // If the visitor is found and the password is correct
            $_SESSION['visitor_email'] = $visitorData->email;
            $_SESSION['visitor_firstname'] = $visitorData->firstname;
            $_SESSION['visitor_id'] = $visitorData->id; // Ensure you have a visitor ID
            $_SESSION['role'] = 'visitor'; // Add a role to identify the user
            header('Location: /'); // Redirect to the home page or another protected page
            exit;
        } else {
            // If no user is found or the password is incorrect
            $errors['global'] = "Incorrect email or password.";
        }
    }
    var_dump($errors);
} else {
    $errors['global'] = "Please fill out the form to log in.";
    var_dump($errors);
}

// Render the login page with errors
render('users/login', [
    'errors' => $errors,
]);