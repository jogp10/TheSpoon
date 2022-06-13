<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public string $name;
    public string $description;
    public string $photo;
    public string $street;
    public string $city;
    public string $state;
    public int $postalcode;

    public function __construct(int $id, string $name, string $description, string $photo, string $street, string $city, string $state, int $postalCode) { 
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->photo = $photo;
      $this->street = $street;
      $this->city = $city;
      $this->state = $state;
      $this->postalcode = $postalCode;
    }

    static function addRestaurant(PDO $db, string $name, string $RestName, string $photo, string $description, string $street, string $city, string $state, int $postalCode): Restaurant {
      $idUser = SESSION::getId();
    
      $stmt = $db->prepare(
        'SELECT idRestCategory 
        FROM    RestCategory
        WHERE   name = ?'
      );
      $stmt->execute(array($RestName));
      $RestCategory = $stmt->fetch();
      $idRestCategory = $RestCategory['idRestCategory'];
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
        $photo,
        $street,
        $city,
        $state,
        $postalCode
      );
    }

    static function updateRestaurant(PDO $db, string $name, string $restCat, string $photo, string $description, string $street, string $city, string $state, int $postalCode, int $id) {
      $stmt = $db->prepare('SELECT idRestCategory FROM RestCategory where Name = ?');
      $stmt->execute(array($restCat));
      $idRestCategory = (int) $stmt->fetch()['idRestCategory'];
      
      $stmt = $db->prepare(
        'UPDATE Restaurant
        SET Name = ?, idRestCategory = ?, Photo = ?, Description = ?
        WHERE   idRestaurant = ?'
      );
      $stmt->execute(array($name, $idRestCategory, $photo, $description, $id));

      $stmt = $db->prepare('SELECT idAddress FROM Restaurant where idRestaurant = ?');
      $stmt->execute(array($id));
      $idAddress = (int) $stmt->fetch()['idAddress'];
      $stmt = $db->prepare(
        'UPDATE Address
        SET Street = ?, City = ?, State = ?, PostalCode = ?
        WHERE idAddress = ?');
      $stmt->execute(array($street, $city, $state, $postalCode, $idAddress));
    }

    static function getRestaurants(PDO $db, int $count) : array {
      $stmt = $db->prepare('
      SELECT idRestaurant, Name, Description, Photo, Street, City, State, PostalCode
      FROM Restaurant JOIN Address USING (idAddress)
      LIMIT ?
    ');
      $stmt->execute(array($count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo'],
        $restaurant['Street'],
        $restaurant['City'],
        $restaurant['State'],
        (int)$restaurant['PostalCode']
        );
      }

      return $restaurants;
    }

    static function getRestaurantsFromCategory(PDO $db, int $count,  int $id) : array {
      $stmt = $db->prepare('
      SELECT idRestaurant, Name, Description, Photo, Street, City, State, PostalCode
      FROM Restaurant JOIN Address USING (idAddress)
      WHERE idRestCategory = ?
      LIMIT ?
    ');

      $stmt->execute(array($id, $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo'],
        $restaurant['Street'],
        $restaurant['City'],
        $restaurant['State'],
        (int)$restaurant['PostalCode']
        );
      }

      return $restaurants;
    }

    static function getRestaurant(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('
      SELECT idRestaurant, Name, Description, Photo, Street, City, State, PostalCode
      FROM Restaurant JOIN Address USING (idAddress)
      WHERE idRestaurant = ?
    ');

      $stmt->execute(array($id));

      $restaurant = $stmt->fetch();

      return new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo'],
        $restaurant['Street'],
        $restaurant['City'],
        $restaurant['State'],
        (int)$restaurant['PostalCode']
      );
    }

    static function getRestaurantsFromUser(PDO $db, int $id) : array {   
      $stmt = $db->prepare('
      SELECT idRestaurant, Name, Description, Photo, Street, City, State, PostalCode
      FROM Restaurant JOIN Address USING (idAddress)
      WHERE idUser = ?
      ');
      
      $stmt->execute(array($id));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo'],
        $restaurant['Street'],
        $restaurant['City'],
        $restaurant['State'],
        (int)$restaurant['PostalCode']
        );
      }

      return $restaurants;
    }

    static function searchRestaurants(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('
      SELECT idRestaurant, Name, Description, Photo, Street, City, State, PostalCode
      FROM Restaurant JOIN Address USING (idAddress)
      WHERE Name LIKE ? 
      LIMIT ?
      ');
      $stmt->execute(array('%' . $search . '%', $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo'],
        $restaurant['Street'],
        $restaurant['City'],
        $restaurant['State'],
        (int)$restaurant['PostalCode']
        );
      }
      return $restaurants;
    }

    static function searchRestaurantsbyCategory(PDO $db, string $search, int $id, int $count) : array {
      $stmt = $db->prepare('
      SELECT idRestaurant, Name, Description, Photo, Street, City, State, PostalCode
      FROM Restaurant JOIN Address USING (idAddress)
      WHERE idRestCategory = ? AND Name LIKE ?
      LIMIT ?
      ');
      $stmt->execute(array($id, '%' . $search . '%', $count));

      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
        (int)$restaurant['idRestaurant'],
        $restaurant['Name'],
        $restaurant['Description'],
        $restaurant['Photo'],
        $restaurant['Street'],
        $restaurant['City'],
        $restaurant['State'],
        (int)$restaurant['PostalCode']
        );
      }
      return $restaurants;
    }

    static function searchRestaurantByMenu($db, $menuId) : Restaurant {
      $stmt = $db->prepare('SELECT * FROM Menu WHERE idMenu = ?');
      $stmt->execute(array($menuId));

      $menu = $stmt->fetch();
      $idRestaurant = (int) $menu['idRestaurant'];
      return Restaurant::getRestaurant($db, $idRestaurant);
    }

    public function addFavorite(PDO $db, int $idUser) {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    RestFavorite
        WHERE   idRestFavorite = (SELECT MAX(idRestFavorite)  FROM RestFavorite)'
      );
      $stmt->execute();
      $idRestFavorite = $stmt->fetch()['idRestFavorite'] + 1;
      echo '$idRestFavorite';
      $stmt = $db->prepare(
        'INSERT INTO RestFavorite values (?, ?, ?)'
      );
      $stmt->execute(array($idRestFavorite, $idUser, $this->id));
    }

    public function removeFavorite(PDO $db, int $idUser) {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    RestFavorite
        WHERE   idUser = ? AND idRestaurant = ?'
      );
      $stmt->execute(array($idUser, $this->id));
      $idRestFavorite = $stmt->fetch()['idRestFavorite'];
      echo '$idRestFavorite';
      $stmt = $db->prepare(
        'DELETE FROM RestFavorite WHERE idRestFavorite = ?'
      );
      $stmt->execute(array($idRestFavorite));
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

    static function getRestaurantCategory(PDO $db, int $id) : Category {
      $stmt = $db->prepare('
      SELECT RestCategory.idRestCategory AS idRestCategory, RestCategory.Name AS Name, RestCategory.Description AS Description
      FROM Restaurant JOIN RestCategory USING (idRestCategory)
      WHERE idRestaurant = ?
      ');
      $stmt->execute(array($id));

      $category = $stmt->fetch();
      if ($category !== false ) {
        return new Category (
          (int)$category['idRestCategory'],
          $category['Name'],
          $category['Description']
        );
      } else return null;
    }

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
