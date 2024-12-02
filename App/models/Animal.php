<?php

namespace App\models;

require_once "App/models/Database.php";

/**
 * Classe Animal
 * Gère les interactions avec la base de données pour les animaux.
 */
class Animal extends Database
{
    // Propriétés privées pour les attributs de l'animal
    private $id; // ID de l'animal
    private $name; // Nom de l'animal
    private $description; // Description de l'animal
    private $species_id; // ID de l'espèce
    private $enclos_id; // ID de l'enclos
    private $image; // URL ou chemin de l'image

    // Méthodes getter pour accéder aux propriétés
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getSpeciesId() { return $this->species_id; }
    public function getEnclosID() { return $this->enclos_id; }
    public function getImage() { return $this->image; }

    // Méthodes setter pour définir les propriétés
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setSpeciesId($species_id) { $this->species_id = $species_id; }
    public function setEnclosId($enclos_id) { $this->enclos_id = $enclos_id; }
    public function setImage($image) { $this->image = $image; }

    // Méthodes de la classe

    /**
     * Récupère les animaux associés à un enclos donné.
     * 
     * @return array Liste des animaux associés.
     */
    public function getAnimalsByEnclosure()
    {
        $sql = 'SELECT id, name, description, specie_id, image 
                FROM Animals 
                WHERE enclos_id = :enclos_id';
        $stmt = $this->db->prepare($sql);

        // Liaison de l'ID de l'enclos
        $stmt->bindParam(':enclos_id', $this->id, \PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Retourne tous les animaux de cet enclos
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour les informations d'un animal dans la base de données.
     * 
     * @return bool Retourne true si la mise à jour a réussi.
     */
    public function updateAnimal()
    {
        $sql = "UPDATE Animals 
                SET name = :newName, description = :description 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        // Exécution de la requête avec les paramètres
        $stmt->execute([
            ':newName' => $this->name,
            ':description' => $this->description,
            ':id' => $this->id,
        ]);

        // Retourne true si au moins une ligne a été modifiée
        return $stmt->rowCount() > 0;
    }

    /**
     * Supprime un animal de la base de données.
     * 
     * @return bool Retourne true si la suppression a réussi.
     */
    public function deleteAnimal()
    {
        $query = "DELETE FROM Animals WHERE id = :id";
        $stmt = $this->db->prepare($query);

        // Exécution de la requête avec l'ID
        return $stmt->execute([':id' => $this->id]);
    }

    /**
     * Crée un nouvel animal dans la base de données.
     */
    public function createAnimal()
    {
        $sql = 'INSERT INTO Animals (name, description, specie_id, enclos_id, image) 
                VALUES (:name, :description, :specie_id, :enclos_id, :image)';
        $stmt = $this->db->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':specie_id', $this->species_id);
        $stmt->bindParam(':enclos_id', $this->enclos_id);
        $stmt->bindParam(':image', $this->image);

        // Exécution de la requête
        $stmt->execute();
    }
}