<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public string $name;
    public string $description;
    public string $photo;

    public function __construct(int $id, string $name, string $description, string $photo) { 
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->photo = $photo;
    }

    static function addRestaurant(PDO $db, string $name, Category $RestCategory, string $photo, string $description, string $street, string $city, string $state, int $postalCode): Restaurant {
      $idUser = SESSION::getId();
    
      $idRestCategory = $RestCategory.getId();
      $stmt = $db->prepare(
        'SELECT * 
        FROM    Restaurant
        WHERE   idRestaurant = (SELECT MAX(idRestaurant)  FROM Restaurant)'
      );
      $stmt->execute();
      $idRestaurant = $stmt->fetch()['idRestaurant'] + 1;
      echo '$idRestaurant';

      $stmt = $db->prepare(
        'SELECT * 
        FROM    Address
        WHERE   idAddress = (SELECT MAX(idAddress)  FROM Address)'
      );
      $stmt->execute();
      $idAddress = $stmt->fetch()['idAddress'] + 1;
      echo '$idAddress';

      $stmt = $db->prepare(
        'INSERT INTO Address values (?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($idAddress, $street, $city, $state, $postalCode));

      $stmt = $db->prepare(
        'INSERT INTO Restaurant values (?, ?, ?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($idRestaurant, $name, $idUser, $idRestCategory, $photo, $description, $idAddress));

      return new Restaurant (
        $idRestaurant, 
        $name,
        $description,
        $photo
      );
    }

    static function getRestaurants(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name, Description, Photo FROM Restaurant LIMIT ?');
      $stmt->execute(array($count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name'],
          $restaurant['Description'],
          $restaurant['Photo']
        );
      }

      return $restaurants;
    }

    static function getRestaurantsFromCategory(PDO $db, int $count,  int $id) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name, Description, Photo FROM Restaurant WHERE idRestCategory = ? LIMIT ?');
      $stmt->execute(array($id, $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name'],
          $restaurant['Description'],
          $restaurant['Photo']
        );
      }

      return $restaurants;
    }

    static function getRestaurant(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('SELECT idRestaurant, Name, Description, Photo FROM Restaurant WHERE idRestaurant = ?');
      $stmt->execute(array($id));

      $restaurant = $stmt->fetch();

      return new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo']
      );
    }

    static function getRestaurantsFromUser(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name, Description, Photo FROM Restaurant WHERE idUser = ?');
      $stmt->execute(array($id));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name'],
          $restaurant['Description'],
          $restaurant['Photo']
        );
      }

      return $restaurants;
    }

    static function searchRestaurants(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name, Description, Photo FROM Restaurant WHERE Name LIKE ? LIMIT ?');
      $stmt->execute(array('%' . $search . '%', $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name'],
          $restaurant['Description'],
          $restaurant['Photo']
        );
      }
      return $restaurants;
    }

    static function searchRestaurantsbyCategory(PDO $db, string $search, int $id, int $count) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name, Description, Photo FROM Restaurant WHERE idRestCategory = ? AND Name LIKE ? LIMIT ?');
      $stmt->execute(array($id, '%' . $search . '%', $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name'],
          $restaurant['Description'],
          $restaurant['Photo']
        );
      }
      return $restaurants;
    }
  }

  class Category {
    public int $id;
    public string $name;
    public string $description;

    public function __construct() { 
      $argc = func_num_args();
      $argv = func_get_args();
      $this->id = $argv[0];
      $this->name = $argv[1];
      if($argc==3) $this->description = $argv[2];
    }

    static function getRestaurantsCategories(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT idRestCategory, Name, Description FROM RestCategory LIMIT ?');
      $stmt->execute(array($count));

      $categories = array();
      while ($category = $stmt->fetch()) {
        $categories[] = new Category(
          (int) $category['idRestCategory'],
          $category['Name'],
          $category['Description']
        );
      }

      return $categories;
    }

    static function getId() {return $id;}

    static function getItemCategories(PDO $db) : array {
      $stmt = $db->prepare('SELECT idItemCategory, Name FROM ItemCategory');
      $stmt->execute();
    
      $categories = array();
      while ($category = $stmt->fetch()) {
        $categories[] = new Category(
          (int) $category['idItemCategory'],
          $category['Name']
        );
      }

      return $categories;
    }
  }

?>
