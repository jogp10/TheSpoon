<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('database/connection.php');

  require_once('database/user.class.php');
  require_once('database/restaurant.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/user.tpl.php');
  require_once('templates/restaurant.tpl.php');

  $db = getDatabaseConnection();
  $user = User::getUser($db, $_SESSION['id']);
  if($user->restOwner) {
    drawHeader();
    drawProfile($user);
    $restaurants = Restaurant::getRestaurantsFromUser($db, $user->idUser);
    drawOwnerRestaurants($restaurants);
    drawFooter();
  } else {
    drawHeader();
    drawProfile($user);
    drawFooter();
  }
?>