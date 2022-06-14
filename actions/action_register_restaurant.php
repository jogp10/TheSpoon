<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');
  require_once('../database/menu.class.php');

  $db = getDatabaseConnection();

  $target_file = "../images/default.jpg";
  $rest_desc = "Good food, I hope";

  $rest = Restaurant::addRestaurant($db, $_POST['rest_name'], $_POST['RestCategory'], $target_file, $rest_desc,  $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);    
  $menu = Menu::addMenu($db, $rest->id);

  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>