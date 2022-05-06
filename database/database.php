<?php

/**
 * PHP 
 */
class databaseManagement {

    private $db;

    /**
     * Initialize database
     */
    public function __construct() {
        $this->db = new PDO('sqlite:database/theSpoon.db');
        if ($this->db == null)
          throw new Exception('Database not initialized');
    }

    /**
     * Insert a new costumer
     * @param string username
     * @param string password
     * @param int    phone
     * @param string name
     * @param string emailAddress
     * @param string state
     * @param string city
     * @param string street
     * @param int    postalcode
     * @return the id of the new costumer
     */
    /*
    public function insertCostumer($username, $password, $phone, $name, $emailAddress, $state, $city, $street, $postalCode) {
        
        $sql = 'INSERT INTO  VALUES(:project_name)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':project_name', $projectName);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
    

    /**
     * Insert a new addreess
     * @param string state
     * @param string city
     * @param string street
     * @param string postalcode
     * @return int the id of the new address
     */
    public function insertAddress($state, $city, $street, $postalCode) {
        if ($state == NULL || $city == NULL || $street == NULL || $postalCode == NULL) return -1;

        $stmt = $this->db->prepare('SELECT MAX(idAddress) FROM Address');
        $stmt->execute();
        $idAddress = (int) $stmt->fetch();

        $stmt = $this->db->prepare("INSERT INTO Address values (':idAddress', ':street', ':city', ':state', ':postalCode')");
        $stmt->bindParam(':idAddress', $idAddress);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':postalCode', $postalCode);
        
        if ($stmt->execute()) {
            echo "success";
        }
        return $idAddress;
    }


    /**
     * Fetch through $query
     * @param string query
     * @return array data fetched
     */
    public function fetch($query) {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get Default Query (SELECT * FROM table)
     * @param string table
     * @return string query
     */
    public function getDefQuery($table) {
        $query = "SELECT * FROM $table";
        return $query;
    }
}

?>