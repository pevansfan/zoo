<?php

use App\models\Employee;
use App\models\Visitor;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $employee = new Employee();
    $visitor = new Visitor();

    // Vérification de l'email
    if (!empty($_POST['email'])) {
        try {
            $email = $_POST['email'];
            $employee->setEmail($email);
            $visitor->setEmail($email);
        } catch (Exception $e) {
            $errors['email'] = $e->getMessage();
        }
    } else {
        $errors['requiredEmail'] = 'Veuillez entrer un email';
    }

    // Vérification du mot de passe
    if (empty($_POST['password'])) {
        $errors['requiredPassword'] = 'Veuillez entrer un mot de passe';
    }

    // Si aucun champ d'erreur, vérifier les données dans la base
    if (empty($errors)) {
        // Récupérer les données de l'employé et du visiteur
        $employeeData = $employee->getByEmail();
        $visitorData = $visitor->getByEmail();

        // Vérifier si l'email correspond à un employé
        if ($employeeData && $_POST['password'] == $employeeData->password) {
            // Si l'employé est trouvé et que le mot de passe est correct
            $_SESSION['employee_email'] = $employeeData->email;
            $_SESSION['employee_firstname'] = $employeeData->firstname;
            $_SESSION['employee_id'] = $employeeData->id; // Assurez-vous que vous avez un id employé
            $_SESSION['role'] = 'employee'; // Ajouter un rôle pour identifier l'utilisateur
            header('Location: /'); // Rediriger vers la page d'accueil ou autre page protégée
            exit;
        }
        // Vérifier si l'email correspond à un visiteur
        elseif ($visitorData && $_POST['password'] == $visitorData->password) {
            // Si le visiteur est trouvé et que le mot de passe est correct
            $_SESSION['visitor_email'] = $visitorData->email;
            $_SESSION['visitor_firstname'] = $visitorData->firstname;
            $_SESSION['visitor_id'] = $visitorData->id; // Assurez-vous que vous avez un id visiteur
            $_SESSION['role'] = 'visitor'; // Ajouter un rôle pour identifier l'utilisateur
            header('Location: /'); // Rediriger vers la page d'accueil ou autre page protégée
            exit;
        } else {
            // Si aucun utilisateur trouvé ou mot de passe incorrect
            $errors['global'] = "Email ou mot de passe incorrect";
        }
    }
    var_dump($errors);
} else {
    $errors['global'] = "Veuillez remplir le formulaire pour vous connecter";
    var_dump($errors);
}

// Render the login page with errors
render('users/login', [
    'errors' => $errors,
]);
