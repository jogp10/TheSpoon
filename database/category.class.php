<?php
  declare(strict_types = 1);

  class MenuItemCategories{
    public int $id;
    public int $menuItemId;
    public int $itemCategoryId;

    public function __construct(int $id, int $menuItemId, int $itemCategoryId) {
      $this->id = $id;
      $this->menuItemId = $menuItemId;
      $this->itemCategoryId = $itemCategoryId; 
    }

    public function addMenuItemCategory(PDO $db, int $idItem, int $idCategory) {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    MenuItemCategories
        WHERE   idMenuItemCategories = (SELECT MAX(idMenuItemCategories)  FROM MenuItemCategories)'
      );
      $stmt->execute();
      $idMenuItemCategories = $stmt->fetch()['idMenuItemCategories'] + 1;
      echo '$idMenuItemCategories';

      $stmt = $db->prepare(
        'INSERT INTO MenuItemCategories values (?, ?, ?)'
      );
      $stmt->execute(array($idMenuItemCategories, $idItem, $idCategory));

      return new MenuItemCategories (
        $idMenuItemCategories, 
        $idItem,
        $idCategory
      );
    }

    public function hasCategory(PDO $db, int $idItem, int $idCategory) {
      $stmt = $db->prepare(
        'SELECT * FROM MenuItemCategories WHERE idMenuItem = ? AND idItemCategory = ?'
      );
      $stmt->execute(array($idItem, $idCategory));
      if ($stmt->fetch()) return true;
      else return false;
    }
  }

  class ItemCategory {
    public int $id;
    public string $name;

    public function __construct(int $id, string $name) { 
      $this->id = $id;
      $this->name = $name;
    }

    public function getItemCategories(PDO $db) : array {
      $stmt = $db->prepare('SELECT * FROM ItemCategory');
      $stmt->execute();
      $categories = array();
      while ($category = $stmt->fetch()) {
        $categories[] = new ItemCategory(
          (int) $category['idItemCategory'],
          $category['Name']
        );
      }
      return $categories;
    }

    static function getItemCategoriesById(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT * FROM MenuItemCategories WHERE idMenuItem = ?');
      $stmt->execute(array($id));
      $categoryLink = array();
      while ($category = $stmt->fetch()) {
        $categoryLink[] = $category['idItemCategory'];
      }
      $categories = array();
      foreach($categoryLink as $cat){
        $stmt = $db->prepare('SELECT * from ItemCategory WHERE idItemCategory = ?');
        $stmt->execute(array($cat));
        $categories[] = new ItemCategory(
          (int) $category['idItemCategory'],
          $category['Name']
        );
      }
      return $categories;
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
