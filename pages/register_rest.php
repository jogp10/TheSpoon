<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');

  require_once('../templates/common.tpl.php');

  $db = getDatabaseConnection();

  $allCategories = Category::getRestaurantsCategories($db, 20); 

  drawHeader($session);
  drawRegisterFormRestaurant($allCategories);
  drawFooter();
?>