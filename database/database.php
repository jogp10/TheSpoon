<?php

namespace App;

/**
 * PHP 
 */
class databaseManagement {

    private $db;

    /**
     * Initialize database
     */
    public function __construct() {
        $db = new PDO('../theSpoon.db');
        if ($db == null)
          throw new Exception('Database not initialized');
    }

    /**
     * Insert a new costumer
     * @param string $projectName
     * 
     * 
     * 
     * 
     * 
     * 
     * @return the id of the new costumer
     */
    public function insertCostumer($username, $password, $phone, $name, $emailAddress, $district, $) {
        
        $sql = 'INSERT INTO projects(project_name) VALUES(:project_name)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':project_name', $projectName);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

}

?>