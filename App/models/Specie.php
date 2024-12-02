<?php

namespace App\models;

require_once "App/models/Database.php";

/**
 * Class Specie
 * Handles operations related to species, including retrieving species data.
 */
class Specie extends Database
{
    /**
     * @var int|null The ID of the species.
     */
    private $id;

    /**
     * @var string|null The name of the species.
     */
    private $name;

    /**
     * @var string|null The description of the species.
     */
    private $description;

    // Getters
    /**
     * Get the species ID.
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the species name.
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the species description.
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    /**
     * Set the species ID.
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
     * Set the species name.
     * @param string $name
     * @throws \Exception If the name is invalid.
     */
    public function setName($name)
    {
        if (empty($name)) {
            throw new \Exception('Please provide a name.');
        }
        if (strlen($name) > 100) {
            throw new \Exception('Name is too long.');
        }
        $this->name = htmlspecialchars($name);
    }

    /**
     * Set the species description.
     * @param string $description
     * @throws \Exception If the description is invalid.
     */
    public function setDescription($description)
    {
        if (empty($description)) {
            throw new \Exception('Please provide a description.');
        }
        $this->description = htmlspecialchars($description);
    }

    // Methods
    /**
     * Retrieve all species from the database.
     * @return array List of all species as associative arrays.
     */
    public function getAllSpecies()
    {
        $sql = 'SELECT * FROM Species';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}