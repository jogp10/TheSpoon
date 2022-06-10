<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/menu.class.php');
  require_once('../database/restaurant.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/restaurant.tpl.php');
  

  $db = getDatabaseConnection();

  $menu = Menu::getMenu($db, intval($_GET['id']));
  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

  drawHeader($session);
  drawRegisterFormMenuItem((int) $_GET['id']);
  drawFooter();
?>