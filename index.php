<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/restaurant.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/restaurant.tpl.php');



  $db = getDatabaseConnection();

  $categories = Category::getRestaurantsCategories($db, 8);
  $allcategories = Category::getRestaurantsCategories($db, 20);
  drawHeader();
  drawSearchBar($allcategories);
  drawRestaurants($db, $categories);
  drawFooter();
?>
