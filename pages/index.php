<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/restaurant.tpl.php');



  $db = getDatabaseConnection();

  $categories = Category::getRestaurantsCategories($db, 8);
  $allcategories = Category::getRestaurantsCategories($db, 20);
  drawHeader($session);
  drawSearchBar($allcategories);
  drawRestaurants($db, $categories);
  drawFooter();
?>
