<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');
  require_once('../database/menu.class.php');
  require_once('../utils/string_manip.php');

  $db = getDatabaseConnection();

  $target_file = "../images/default.jpg";
  $rest_desc = "Good food, I hope";

  
  $name = $_POST['rest_name'];
  $name = strRemoveSpeChr($name);
  
  $street = $_POST['street'];
  $street = strRemoveSpeChr($street);

  $city = $_POST['city'];
  $city = strRemoveSpeChr($city);

  $state = $_POST['state'];
  $state = strRemoveSpeChr($state);

  $rest = Restaurant::addRestaurant($db, $session, $name, $_POST['RestCategory'], $target_file, $rest_desc, $street, $city, $state, (int)$_POST['postal-code']);        
  $menu = Menu::addMenu($db, $rest->id);

  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>