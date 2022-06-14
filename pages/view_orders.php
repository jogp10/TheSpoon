<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();
  $id = $session->getId();

  require_once('../database/user.class.php');
  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');
  require_once('../database/order.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/restaurant.tpl.php');
  

  $db = getDatabaseConnection();
  $restaurantOwner = User::getRestaurantOwner($db, intval($_GET['id']));

  if (!$session->isLoggedIn() || $id != $restaurantOwner->idUser) die(header('Location: /'));

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $orders = Order::getOrders($db, $restaurant->id);

  drawHeader($session);
  drawName($restaurant);
  drawOrders($orders);
  drawFooter();
?>