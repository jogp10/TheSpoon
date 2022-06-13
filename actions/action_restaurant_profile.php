<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../utils/load_file.php');
  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $target_file = loadRestaurantPhoto($restaurant);

  Restaurant::updateRestaurant($db, $_POST['rest_name'], $_POST['RestCategory'], $target_file, $_POST['desc'],  $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code'], $restaurant->id);


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>