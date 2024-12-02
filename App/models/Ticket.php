<?php

namespace App\models;

require_once "App/models/Database.php";

class Ticket extends Database
{
    private $id;
    private $category;
    private $price;

    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setId($id)
    {
        if (empty($id)) throw new \Exception('Veuillez entrer un id');
        if (!is_numeric($id)) throw new \Exception('L\'id doit être un nombre');
        $this->id = intval($id);
    }

    public function setCategory($category)
    {
        if (empty($category)) throw new \Exception('Veuillez entrer une catégorie');
        if (strlen($category) > 255) throw new \Exception('Trop grand');
        $this->category = htmlspecialchars($category);
    }

    public function setPrice($price)
    {
        if (empty($price)) throw new \Exception('Veuillez entrer un prix');
        $this->price = htmlspecialchars($price);
    }



    // Méthodes
    public function getAllTickets()
    {
        $sql = "SELECT * FROM Tickets";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
