<?php
  declare(strict_types = 1);

  class Menu {
    public int $id;
    public MenuItem $items;
    public int $restaurant;

    public function __construct(int $id, int $items, int $restaurant)
    {
      $this->id = $id;
      $this->items = $items;
      $this->restaurant = $restaurant;
    }

    static function getMenu(PDO $db, int $id) : array {
        $stmt = $db->prepare('SELECT idMenuItem, Name, Price, Photo FROM MenuItem JOIN Menu USING (idMenu) WHERE idRestaurant = ?');
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
  }
?>
