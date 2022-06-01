<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/user.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();
  $user = User::getUser($db, $_SESSION['id']);
  drawHeader();
  drawProfile($user);
  if($user->restOwner) {
    $restaurants = Restaurant::getRestaurantsFromUser($db, $user->idUser);
    drawOwnerRestaurants($restaurants);
  }
  drawFooter();
?>