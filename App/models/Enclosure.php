<?php

namespace App\models;

require_once "App/models/Database.php";

/**
 * Class Enclosure
 * Handles operations related to enclosures, including CRUD operations.
 */
class Enclosure extends Database
{
    /**
     * @var int|null The ID of the enclosure.
     */
    private $id;

    /**
     * @var string|null The name of the enclosure.
     */
    private $name;

    /**
     * @var string|null The description of the enclosure.
     */
    private $description;

    // Getters
    /**
     * Get the enclosure's ID.
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the enclosure's name.
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the enclosure's description.
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    /**
     * Set the enclosure's ID.
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
     * Set the enclosure's name.
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
     * Set the enclosure's description.
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
     * Retrieve all enclosures from the database.
     * @return array List of enclosures as associative arrays.
     */
    public function getAllEnclosures()
    {
        $sql = 'SELECT id, name, description FROM Enclosures';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Retrieve an enclosure by its ID.
     * @return array|null The enclosure data, or null if not found.
     */
    public function getAllEnclosuresById()
    {
        $sql = 'SELECT id, name, description FROM Enclosures WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Create a new enclosure in the database.
     * @return bool True if the creation was successful, false otherwise.
     */
    public function createEnclosure()
    {
        $sql = "INSERT INTO Enclosures (name, description) 
                VALUES (:name, :description)";
        $stmt = $this->db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $this->name, \PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->description, \PDO::PARAM_STR);

        // Execute the query
        return $stmt->execute();
    }

    /**
     * Delete an enclosure by its ID.
     * @throws \Exception If the deletion fails.
     */
    public function deleteEnclosure()
    {
        $sql = 'DELETE FROM Enclosures WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute([':id' => $this->id])) {
            throw new \Exception('Failed to delete the enclosure.');
        }
    }
}
