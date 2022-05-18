<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');

  require_once('database/restaurant.class.php');
  require_once('database/menu.class.php');
  require_once('database/review.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $menu = Menu::getMenu($db, intval($_GET['id']));
  $comments = Review::getReviewsFromRestaurant($db, intval($_GET['id']));

  drawHeader();
  drawCart();
  drawRestaurant($restaurant, $menu, $comments);
  drawFooter();
?>