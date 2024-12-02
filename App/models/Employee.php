<?php

namespace App\models;

require_once 'App/models/Database.php';

/**
 * Class Employee
 * Handles employee-related operations, including setting and retrieving properties,
 * as well as database interactions such as fetching employee data.
 */
class Employee extends Database
{
    /**
     * @var int|null Employee ID
     */
    private $id;

    /**
     * @var string|null Employee first name
     */
    private $firstname;

    /**
     * @var string|null Employee last name
     */
    private $lastname;

    /**
     * @var string|null Employee email address
     */
    private $email;

    /**
     * @var string|null Employee hashed password
     */
    private $password;

    // Getters
    /**
     * Get the employee's ID.
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the employee's first name.
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the employee's last name.
     * @return string|null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the employee's email.
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the employee's hashed password.
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    // Setters
    /**
     * Set the employee's ID.
     * @param int $id
     * @throws \Exception If the ID is invalid.
     */
    public function setId($id)
    {
        if (empty($id)) {
            throw new \Exception('Please provide an ID.');
        }
        if (!is_numeric($id)) {
            throw new \Exception('ID must be a number.');
        }
        $this->id = intval($id);
    }

    /**
     * Set the employee's first name.
     * @param string $firstname
     * @throws \Exception If the first name is invalid.
     */
    public function setFirstname($firstname)
    {
        if (empty($firstname)) {
            throw new \Exception('Please provide a first name.');
        }
        if (strlen($firstname) > 100) {
            throw new \Exception('First name is too long.');
        }
        $this->firstname = htmlspecialchars($firstname);
    }

    /**
     * Set the employee's last name.
     * @param string $lastname
     * @throws \Exception If the last name is invalid.
     */
    public function setLastname($lastname)
    {
        if (empty($lastname)) {
            throw new \Exception('Please provide a last name.');
        }
        if (strlen($lastname) > 100) {
            throw new \Exception('Last name is too long.');
        }
        $this->lastname = htmlspecialchars($lastname);
    }

    /**
     * Set the employee's email.
     * @param string $email
     * @throws \Exception If the email is invalid.
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new \Exception('Please provide an email.');
        }
        if (strlen($email) > 255) {
            throw new \Exception('Email is too long.');
        }
        $this->email = htmlspecialchars($email);
    }

    /**
     * Set the employee's password.
     * @param string $password
     * @throws \Exception If the password is invalid.
     */
    public function setPassword($password)
    {
        if (empty($password)) {
            throw new \Exception('Please provide a password.');
        }
        if (strlen($password) > 255) {
            throw new \Exception('Password is too long.');
        }
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Methods
    /**
     * Fetch employee data by email.
     * @return object|null The employee data as an object, or null if not found.
     */
    public function getByEmail()
    {
        $sql = "SELECT * FROM Employees WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ); // Returns the employee data as an object
    }

    /**
     * Fetch all employees from the database.
     * @return array List of employees as associative arrays.
     */
    public function getAllEmployees()
    {
        $sql = "SELECT * FROM Employees";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}