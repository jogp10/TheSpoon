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
        $stmt = $this->db->prepare('SELECT * FROM sqlite_master');
        if(!$stmt) {
            echo "Prepare failed: (". $this->db->errorCode().") ".$this->db->errorInfo()."<br>";
            foreach($this->db->errorInfo() as $error){
                echo ".$error ";
            }
            return -1;
        }
        $stmt->execute();
        $idAddress = $stmt->fetchAll();
        $stmt = $this->db->prepare("INSERT INTO Address(idAddress, Street, City, State, PostalCode) values ('$idAddress', '$street', '$city', '$state', '$postalCode')");
        $stmt->execute();
        return $idAddress;
    }

    public function fetchCategories(){
        $stmt = $this->db->prepare('SELECT * FROM RestCategory');
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }

    public function fetchRestaurants(){
        $stmt = $this->db->prepare('SELECT * FROM Restaurant');
        $stmt->execute();
        $restaurants = $stmt->fetchAll();
        return $restaurants;
    }
}

?>