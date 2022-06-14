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

  $name = $_POST['rest_name'];
  $name = preg_replace ("/[^a-zA-Z\s]/", '', $name);
  $street = $_POST['street'];
  $street = preg_replace ("/[^a-zA-Z\s]/", '', $street);
  $city = $_POST['city'];
  $city = preg_replace ("/[^a-zA-Z\s]/", '', $city);
  $state = $_POST['state'];
  $state = preg_replace ("/[^a-zA-Z\s]/", '', $state);

  Restaurant::updateRestaurant($db, $name, $_POST['RestCategory'], $target_file, $_POST['desc'], $street, $city, $state, (int)$_POST['postal-code'], $restaurant->rating, $restaurant->id);


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>