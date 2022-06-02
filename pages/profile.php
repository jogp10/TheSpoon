<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once('../database/connection.php');

  require_once('../database/user.class.php');
  require_once('../database/restaurant.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/user.tpl.php');
  require_once('../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();
  $user = User::getUser($db, $session->getId());
  drawHeader($session);
  drawProfile($user);
  if($user->restOwner) {
    $restaurants = Restaurant::getRestaurantsFromUser($db, $user->idUser);
    drawOwnerRestaurants($restaurants);
  }
  drawFooter();
?>