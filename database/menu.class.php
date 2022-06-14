<?php
  declare(strict_types = 1);

  class Menu {
    public int $id;
    public int $restaurant;

    public function __construct(int $id, int $restaurant)
    {
      $this->id = $id;
      $this->restaurant = $restaurant;
    }

    static function addMenu(PDO $db, int $idRestaurant): Menu {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    Menu
        WHERE   idMenu = (SELECT MAX(idMenu)  FROM Menu)'
      );
      $stmt->execute();
      $idMenu = $stmt->fetch()['idMenu'] + 1;
      echo '$idMenu';

      $stmt = $db->prepare(
        'INSERT INTO Menu values (?, ?)'
      );
      $stmt->execute(array($idMenu, $idRestaurant));

      return new Menu (
        $idMenu, 
        $idRestaurant
      );
    }

    public function getMenuId(PDO $db, int $id) : int {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    Menu
        WHERE   idRestaurant = ?'
      );
      $stmt->execute(array($id));
      $menu = $stmt->fetch();
      $idMenu = (int) $menu['idMenu'];
      return $idMenu;
    }

    static function getMenu(PDO $db, int $id) : array {
        $stmt = $db->prepare('SELECT idMenuItem, Name, Price, Photo 
        FROM (MenuItem JOIN Menu USING (idMenu)) LEFT OUTER JOIN ItemFavorite USING (idMenuItem)
        WHERE idRestaurant = ?
        ORDER BY idItemFavorite DESC');
        $stmt->execute(array($id));

        $menu = array();
        while ($menuItem = $stmt->fetch()) {
          $menu[] = new MenuItem(
            (int) $menuItem['idMenuItem'],
            $menuItem['Name'],
            (int) $menuItem['Price'],
            $menuItem['Photo']
          );
        }

        return $menu;
    }

    static function getMenuByItem(PDO $db, int $idItem) : int {
      $stmt = $db->prepare('SELECT * FROM MenuItem WHERE idMenuItem = ?');
      $stmt->execute(array($idItem));

      $menuItem = $stmt->fetch();
      $idMenu = (int) $menuItem['idMenu'];
      return $idMenu;
    }
  }

  class MenuItem {
    public int $id;
    public int $price;
    public string $photo;
    public string $name;

    public function __construct(int $id, string $name, int $price, string $photo)
    {
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->photo = $photo;
    }

    static function addItem(PDO $db, int $idMenu ,string $name, int $price, string $photo): MenuItem {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    MenuItem
        WHERE   idMenuItem = (SELECT MAX(idMenuItem)  FROM MenuItem)'
      );
      $stmt->execute();
      $idMenuItem = $stmt->fetch()['idMenuItem'] + 1;
      echo '$idMenuItem';

      $stmt = $db->prepare(
        'INSERT INTO MenuItem values (?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($idMenuItem, $name, $price, $photo, $idMenu));

      return new MenuItem (
        $idMenuItem, 
        $name,
        $price,
        $photo
      );
    }

    static function getMenuItem(PDO $db, int $id) : MenuItem {
      $stmt = $db->prepare('
      SELECT *
      FROM MenuItem
      WHERE idMenuItem = ?
      ');
      $stmt->execute(array($id));
      $item = $stmt->fetch();

      return new MenuItem (
        (int)$item['idMenuItem'],
        $item['Name'],
        (int)$item['Price'],
        $item['Photo']
      );
    }

    static function updateMenuItem(PDO $db, string $name, string $price, string $photo, int $id) {
      $stmt = $db->prepare(
        'UPDATE MenuItem
        SET Name = ?, Price = ?, Photo = ?
        WHERE   idMenuItem = ?'
      );
      $stmt->execute(array($name, $price, $photo, $id));
    }

    public function addFavorite(PDO $db, int $idUser) {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    ItemFavorite
        WHERE   idItemFavorite = (SELECT MAX(idItemFavorite)  FROM ItemFavorite)'
      );
      $stmt->execute();
      $idItemFavorite = $stmt->fetch()['idItemFavorite'] + 1;
      echo '$idItemFavorite';
      $stmt = $db->prepare(
        'INSERT INTO ItemFavorite values (?, ?, ?)'
      );
      $stmt->execute(array($idItemFavorite, $idUser, $this->id));
    }

    public function removeFavorite(PDO $db, int $idUser) {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    ItemFavorite
        WHERE   idUser = ? AND idMenuItem = ?'
      );
      $stmt->execute(array($idUser, $this->id));
      $idItemFavorite = $stmt->fetch()['idItemFavorite'];
      echo '$idItemFavorite';
      $stmt = $db->prepare(
        'DELETE FROM ItemFavorite WHERE idItemFavorite = ?'
      );
      $stmt->execute(array($idItemFavorite));
    }
  }
?>
