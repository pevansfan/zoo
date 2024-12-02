<?php

namespace App\models;

require_once 'App/models/Database.php';

/**
 * Class Visitor
 * Handles operations related to visitors, including retrieving visitor data by email and setting visitor properties.
 */
class Visitor extends Database
{
    /**
     * @var int|null The ID of the visitor.
     */
    private $id;

    /**
     * @var string|null The first name of the visitor.
     */
    private $firstname;

    /**
     * @var string|null The last name of the visitor.
     */
    private $lastname;

    /**
     * @var string|null The email of the visitor.
     */
    private $email;

    /**
     * @var string|null The password of the visitor.
     */
    private $password;

    // Getters
    /**
     * Get the visitor ID.
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the visitor first name.
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the visitor last name.
     * @return string|null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the visitor email.
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the visitor password.
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    // Setters
    /**
     * Set the visitor ID.
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
     * Set the visitor first name.
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
     * Set the visitor last name.
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
     * Set the visitor email.
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
     * Set the visitor password.
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
     * Retrieve a visitor by email from the database.
     * @return object|null The visitor object if found, null otherwise.
     */
    public function getByEmail()
    {
        $sql = "SELECT * FROM Visitors WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ); // Returns the visitor object with the visitor's data
    }
}