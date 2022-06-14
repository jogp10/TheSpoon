<?php
  declare(strict_types = 1);

  class Order {
    public int $id;
    public string $orderTime;
    public int $totalPrice;
    public int $idRestaurant;

    public function __construct(int $id, string $orderTime, int $totalPrice, int $idRestaurant)
    {
      $this->id = $id;
      $this->orderTime = $orderTime;
      $this->totalPrice = $totalPrice;
      $this->idRestaurant = $idRestaurant; 
    }


    static function addOrder(PDO $db, string $orderTime, int $totalPrice, int $idRestaurant) : Order {
      $idUser = SESSION::getId();
      $stmt = $db->prepare(
          'SELECT * 
          FROM    Orders
          WHERE   idOrders = (SELECT MAX(idOrders)  FROM Orders)'
      );
      $stmt->execute();
      $idOrder = $stmt->fetch()['idOrders'] + 1;

      $stmt = $db->prepare(
        'INSERT INTO Orders values (?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($idOrder, $orderTime, $totalPrice, $idUser, $idRestaurant));

      return new Order (
        $idOrder,
        $orderTime,
        $totalPrice,
        $idRestaurant
      );
    }

    static function getOrderHistory(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT idOrders, OrderTime, PriceTotal, idRestaurant
      FROM Orders
      WHERE idUser = ?
      ');

      $stmt->execute(array($id));

      $orders = array();
      while ($order = $stmt->fetch()) {
        $orders[] = new Order(
        (int)$order['idOrders'],
        $order['OrderTime'],
        (int)$order['PriceTotal'],
        (int)$order['idRestaurant'],
        );
      }

      return $orders;
    }

    static function getOrders(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT * FROM Orders WHERE idRestaurant = ?');
      $stmt->execute(array($id));

      $orders = array();
      while ($order = $stmt->fetch()) {
        $orders[] = new Order(
          (int) $order['idOrders'],
          $order['OrderTime'],
          (int) $order['PriceTotal'],
          (int) $order['idRestaurant']
        );
      }

      return $orders;
    }

  }
