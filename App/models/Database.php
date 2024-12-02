<?php

namespace App\models;

/**
 * Class Database
 * Handles the database connection using a singleton pattern to ensure a single instance of the connection.
 */
class Database
{
    /**
     * @var \PDO|null Singleton instance of the database connection
     */
    private static $instance = null;

    /**
     * @var \PDO|null Database connection object
     */
    protected $db = null;

    /**
     * Constructor
     * Initializes the database connection if it hasn't been established yet.
     */
    public function __construct()
    {
        // Check if a connection instance already exists
        if (!self::$instance) {
            // Create a new PDO connection and store it in the singleton instance
            self::$instance = new \PDO(
                'mysql:host=localhost;dbname=zoo;charset=utf8', // Connection string (DSN)
                'root',                                         // Database username
                'root',                                         // Database password
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,     // Enable exception mode for errors
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC // Set default fetch mode to associative array
                ]
            );
        }

        // Assign the singleton instance to the $db property
        $this->db = self::$instance;
    }
}