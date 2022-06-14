<?php
  declare(strict_types = 1);

  class Order {
    public int $id;
    public string $orderTime;
    public int $totalPrice;
    public int $idRestaurant;
    public string $state;

    public function __construct(int $id, string $orderTime, int $totalPrice, int $idRestaurant, string $state)
    {
      $this->id = $id;
      $this->orderTime = $orderTime;
      $this->totalPrice = $totalPrice;
      $this->idRestaurant = $idRestaurant; 
      $this->state = $state;
    }


    static function addOrder(PDO $db, int $idUser, string $orderTime, int $totalPrice, int $idRestaurant) : Order {
      $stmt = $db->prepare(
          'SELECT * 
          FROM    Orders
          WHERE   idOrders = (SELECT MAX(idOrders)  FROM Orders)'
      );
      $stmt->execute();
      $idOrder = $stmt->fetch()['idOrders'] + 1;
      $state = "Received"; //Received -> Preparing -> Ready -> Delivered
      $stmt = $db->prepare(
        'INSERT INTO Orders values (?, ?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($idOrder, $orderTime, $totalPrice, $idUser, $idRestaurant, $state));

      return new Order (
        $idOrder,
        $orderTime,
        $totalPrice,
        $idRestaurant,
        $state
      );
    }

    static function getOrderById(PDO $db, int $id) : Order {
      $stmt = $db->prepare('
      SELECT *
      FROM Orders
      WHERE idOrders = ?
      ');
      $stmt->execute(array($id));
      $order = $stmt->fetch();

      return new Order (
        (int)$order['idOrders'],
        $order['OrderTime'],
        (int)$order['PriceTotal'],
        (int)$order['idRestaurant'],
        $order['State']
      );
    }

    static function getOrderHistory(PDO $db, int $id) : array {
      $stmt = $db->prepare('
      SELECT idOrders, OrderTime, PriceTotal, idRestaurant, State
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
        $order['State']
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
          (int) $order['idRestaurant'],
          $order['State']
        );
      }

      return $orders;
    }

    public function updateState(PDO $db, string $newState) {
      $stmt = $db->prepare(
        'SELECT * FROM Orders WHERE idOrders = ?'
      );
      $stmt->execute(array($this->id));
      $order = $stmt->fetch();
      $orderID = (int)$order['idOrders'];
      $time = $order['OrderTime'];
      $price = (int)$order['PriceTotal'];
      $userId = (int)$order['idUser'];
      $restaurantId = (int)$order['idRestaurant'];

      $stmt = $db->prepare(
        'DELETE FROM Orders WHERE idOrders = ?'
      );
      $stmt->execute(array($this->id));

      $stmt = $db->prepare(
        'INSERT INTO Orders values (?, ?, ?, ?, ?, ?)'
      );
      $stmt->execute(array($orderID, $time, $price, $userId, $restaurantId, $newState));
    }

    static function hasOrder(int $user, int $restaurant): bool {
      $db = getDatabaseConnection();

      $stmt = $db->prepare('
        SELECT *
        FROM Orders
        WHERE idUser = ? AND idRestaurant = ?
      ');

      $stmt->execute(array($user, $restaurant));
      if ($stmt->fetch()) {
        return true;
      }
      return false;
    }
  }
