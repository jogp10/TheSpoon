<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/restaurant.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/restaurant.tpl.php');



  $db = getDatabaseConnection();

  $restaurants = Restaurant::getRestaurants($db, 8);

  drawHeader();
  drawRestaurants($restaurants);
  drawFooter();
?>
