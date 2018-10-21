<?php
/**
Connection to DataBase
 */
namespace TaskManager;

use PDO;
use PDOException;

/**
 * Class Database
 * @package application
 */
abstract class DataBase
{
    /**
     * @var null|PDO
     */
    private $connection = null;

    /**
     * @return PDO
     */
    public function getDb()
    {
        if (is_null($this->connection)) {
            $this->setConnection();
        }

        return $this->connection;
    }

    /**
     * Set database connection
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=MyDB', 'root', '');
        } catch (PDOException $e) {
            die('Connection error: ' . $e->getMessage());
        }
    }
}
