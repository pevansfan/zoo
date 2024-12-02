<?php

use App\models\Employee;
use App\models\Enclosure;
use App\models\Specie;

$enclos = new Enclosure();
$species = new Specie();
$employee = new Employee();


render('index', [
    'enclos' => $enclos->getAllEnclosures(),
    'species' => $species->getAllSpecies(),
    'employees' => $employee->getAllEmployees()
]);