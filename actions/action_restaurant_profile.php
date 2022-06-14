<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../utils/load_file.php');
  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');
  require_once('../utils/string_manip.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $target_file = loadRestaurantPhoto($restaurant);

  $name = $_POST['rest_name'];
  $name = strRemoveSpeChr($name);
  
  $street = $_POST['street'];
  $street = strRemoveSpeChr($street);

  $city = $_POST['city'];
  $city = strRemoveSpeChr($city);

  $state = $_POST['state'];
  $state = strRemoveSpeChr($state);
  
  Restaurant::updateRestaurant($db, $name, $_POST['RestCategory'], $target_file, $_POST['desc'], $street, $city, $state, (int)$_POST['postal-code'], $restaurant->rating, $restaurant->id);


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>