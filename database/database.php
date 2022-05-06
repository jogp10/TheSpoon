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
        $this->db = new PDO('theSpoon.db');
        if ($db == null)
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
    */

    /**
     * Insert a new addreess
     * @param string state
     * @param string city
     * @param string street
     * @param string postalcode
     * @return the id of the new address
     */
    public function insertAddress($state, $city, $street, $postalCode) {
        if ($state == NULL || $city == NULL || $street == NULL || $postalCode == NULL) return -1;
        $stmt1 = $db->prepare('SELECT MAX(idAddress) FROM Address');
        $stmt1->execute();
        $idAddress = $stmt1->fetch() + 1;
        $stmt = $db->prepare("INSERT INTO Address(idAddress, Street, City, State, PostalCode) values ('$idAddress', '$street', '$city', '$state', '$postalCode')");
        $stmt->execute();
        echo $idAddress;
        return $idAddress;
    }
}

?>