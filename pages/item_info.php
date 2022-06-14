<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();
  $id = $session->getId();

  require_once('../database/user.class.php');
  require_once('../database/restaurant.class.php');
  require_once('../database/connection.php');
  require_once('../database/menu.class.php');
  require_once('../database/category.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();
  $menuId = Menu::getMenuByItem($db, intval($_GET['id']));
  $restaurant = Restaurant::searchRestaurantByMenu($db, $menuId);
  $restaurantOwner = User::getRestaurantOwner($db, (int)$restaurant->id);
  $tags = ItemCategory::getItemCategories($db);

  if (!$session->isLoggedIn() || $id != $restaurantOwner->idUser) die(header('Location: /'));

  $item = MenuItem::getMenuItem($db, intval($_GET['id']));

  drawHeader($session);
  drawItemProfile($session, $item);
  drawTags($db, $tags, $item->id);
  drawFooter();
?>