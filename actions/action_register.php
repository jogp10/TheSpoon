<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');
  require_once('../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::addUser($db, $_POST['email-reg'], $_POST['password-reg'], (int)$_POST['phone'], $_POST['name'], (bool)$_POST['restaurant-owner'], $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);
      
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
