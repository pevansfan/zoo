<?php

namespace App\models;

require_once "App/models/Database.php";

/**
 * Class Animal
 * Handles interactions with the database for animals.
 */
class Animal extends Database
{
    // Private properties for animal attributes
    private $id;           // Animal ID
    private $name;         // Animal's name
    private $description;  // Animal's description
    private $species_id;   // Species ID
    private $enclos_id;    // Enclosure ID
    private $image;        // Image URL or path

    // Getter methods to access the properties
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getSpeciesId()
    {
        return $this->species_id;
    }
    public function getEnclosID()
    {
        return $this->enclos_id;
    }
    public function getImage()
    {
        return $this->image;
    }

    // Setter methods to set the properties
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setSpeciesId($species_id)
    {
        $this->species_id = $species_id;
    }
    public function setEnclosId($enclos_id)
    {
        $this->enclos_id = $enclos_id;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Retrieves animals associated with a given enclosure.
     * 
     * @return array List of animals associated with the enclosure.
     */
    public function getAnimalsByEnclosure()
    {
        // SQL query to fetch animals from a specific enclosure
        $sql = 'SELECT id, name, description, specie_id, image 
                FROM Animals 
                WHERE enclos_id = :enclos_id';
        $stmt = $this->db->prepare($sql);

        // Binding the enclosure ID parameter
        $stmt->bindParam(':enclos_id', $this->id, \PDO::PARAM_INT);

        // Executing the query
        $stmt->execute();

        // Returns all animals for the given enclosure
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Updates an animal's information in the database.
     * 
     * @return bool Returns true if the update was successful.
     */
    public function updateAnimal()
    {
        $sql = "UPDATE Animals 
                SET name = :newName, description = :description 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        // Execute the query with the parameters
        $stmt->execute([
            ':newName' => $this->name,
            ':description' => $this->description,
            ':id' => $this->id,
        ]);

        // Returns true if at least one row was affected
        return $stmt->rowCount() > 0;
    }

    /**
     * Deletes an animal from the database.
     * 
     * @return bool Returns true if the deletion was successful.
     */
    public function deleteAnimal()
    {
        $query = "DELETE FROM Animals WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Executes the query with the animal's ID
        return $stmt->execute([':id' => $this->id]);
    }

    /**
     * Supprime tous les animaux associés à un enclos donné.
     * 
     * @param int $enclos_id L'ID de l'enclos.
     * @return bool Retourne true si la suppression a réussi.
     */
    public function deleteAnimalsByEnclosure()
    {
        $sql = "DELETE FROM Animals WHERE enclos_id = :enclos_id";
        $stmt = $this->db->prepare($sql);

        // Exécution de la requête avec l'ID de l'enclos
        return $stmt->execute([':enclos_id' => $this->enclos_id]);
    }


    /**
     * Creates a new animal in the database.
     */
    public function createAnimal()
    {
        $sql = 'INSERT INTO Animals (name, description, specie_id, enclos_id, image) 
                VALUES (:name, :description, :specie_id, :enclos_id, :image)';
        $stmt = $this->db->prepare($sql);

        // Binding the parameters for the new animal
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':specie_id', $this->species_id);
        $stmt->bindParam(':enclos_id', $this->enclos_id);
        $stmt->bindParam(':image', $this->image);

        // Executes the query to insert the new animal
        $stmt->execute();
    }
}
