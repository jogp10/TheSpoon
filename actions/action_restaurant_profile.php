<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));





  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>