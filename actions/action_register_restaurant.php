<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');
  require_once('../database/restaurant.class.php');

  $db = getDatabaseConnection();

  $rest = Restaurant::addRestaurant($db, $_POST['rest_name'], $_POST['photo_path'], $_POST['rest_desc'],  $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);    

  if ($user != null) {
    $session->setId($user->idUser);
    $session->setName($user->name);
    $session->setEmail($user->email);
    $session->setOwner($user->restOwner);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // Error message displaying user already exists
  }

?>