<?php
  declare(strict_types = 1);

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
