<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();
  $id = $session->getId();

  require_once('../database/connection.php');
  require_once('../database/category.class.php');
  require_once('../database/restaurant.class.php');
  require_once('../database/menu.class.php');
  require_once('../database/review.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();
  $restaurantOwner = User::getRestaurantOwner($db, intval($_GET['id']));

  if (!$session->isLoggedIn() || $id != $restaurantOwner->idUser) die(header('Location: /'));

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $allcategories = Category::getRestaurantsCategories($db, 20);
  $category = Category::getRestaurantCategory($db, $restaurant->id);
  $menu = Menu::getMenu($db, intval($_GET['id']));
  $comments = Review::getReviewsFromRestaurant($db, intval($_GET['id']));
  $user = User::getRestaurantOwner($db, $restaurant->id);

  drawHeader($session);
  drawRestaurantProfile($restaurant, $allcategories, $category);
  drawItemsInfo($session, $restaurant, $menu);
  drawComments($session, $restaurant, $user, $comments);
  drawFooter();
?>