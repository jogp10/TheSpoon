<?php
  declare(strict_types = 1);

  class Menu {
    public int $id;
    public int $items;
    public int $restaurant;

    public function __construct(int $id, int $items, int $restaurant)
    {
      $this->id = $id;
      $this->items = $items;
      $this->restaurant = $restaurant;
    }

    }
?>