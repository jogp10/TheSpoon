<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public string $name;

    public function __construct(int $id, string $name) { 
      $this->id = $id;
      $this->name = $name;
    }


    static function getRestaurants(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name FROM Restaurant LIMIT ?');
      $stmt->execute(array($count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name']
        );
      }

      return $restaurants;
    }

    static function getRestaurantsFromCategory(PDO $db, int $count,  int $id) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name FROM Restaurant WHERE idRestCategory = ? LIMIT ?');
      $stmt->execute(array($id, $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name']
        );
      }

      return $restaurants;
    }

    static function getRestaurant(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('SELECT idRestaurant, Name FROM Restaurant WHERE idRestaurant = ?');
      $stmt->execute(array($id));

      $restaurant = $stmt->fetch();

      return new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name']
      );
    }

    static function getRestaurantsFromUser(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name FROM Restaurant JOIN User USING (idUser) WHERE idUser = ?');
      $stmt->execute(array($id));

      $restaurants = array();

      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name']
        );
      }

      return $restaurants;
    }

    static function searchRestaurants(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT idRestaurant, Name FROM Restaurant WHERE Name LIKE ? LIMIT ?');
      $stmt->execute(array('%' . $search . '%', $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int) $restaurant['idRestaurant'],
          $restaurant['Name']
        );
      }
      return $restaurants;
    }
  }

  class Category {
    public int $id;
    public string $name;

    public function __construct(int $id, string $name) { 
      $this->id = $id;
      $this->name = $name;
    }

    static function getRestaurantsCategories(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT idRestCategory, Name FROM RestCategory LIMIT ?');
      $stmt->execute(array($count));

      $categories = array();
      while ($category = $stmt->fetch()) {
        $categories[] = new Category(
          (int) $category['idRestCategory'],
          $category['Name']
        );
      }

      return $categories;
    }

    static function getItemCategories(PDO $db) : array {
      $stmt = $db->prepare('SELECT idItemCategory, Name FROM ItemCategory');
      $stmt->execute();
    
      $categories = array();
      while ($category = $stmt->fetch()) {
        $categories[] = new Restaurant(
          (int) $category['idItemCategory'],
          $category['Name']
        );
      }

      return $categories;
    }


  }

?>