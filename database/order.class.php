<?php
  declare(strict_types = 1);

  class Order {
    public int $id;
    public string $orderTime;
    public int $totalPrice;

    public function __construct(int $id, string $orderTime, int $totalPrice)
    {
      $this->id = $id;
      $this->orderTime = $orderTime;
      $this->totalPrice = $totalPrice; 
    }


    static function addOrder(PDO $db, string $orderTime, int $totalPrice, int $idRestaurant) {
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
            $totalPrice
        );
    }

    static function getOrders(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT * FROM Orders WHERE idRestaurant = ?');
      $stmt->execute(array($id));

      $orders = array();
      while ($order = $stmt->fetch()) {
        $orders[] = new Order(
          (int) $order['idOrders'],
          $order['OrderTime'],
          (int) $order['PriceTotal']
        );
      }

      return $orders;
    }

  }
