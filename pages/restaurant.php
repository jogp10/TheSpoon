<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/menu.class.php');
  require_once(__DIR__ . '/../database/review.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $menu = Menu::getMenu($db, intval($_GET['id']));
  $comments = Review::getReviewsFromRestaurant($db, intval($_GET['id']));
  $user = User::getRestaurantOwner($db, $restaurant->id);

  drawHeader();
  drawCart();
  drawRestaurant($restaurant, $user, $menu, $comments);
  drawFooter();
?>