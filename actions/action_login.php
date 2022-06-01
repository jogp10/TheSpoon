<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);
  
  if ($user) {
    $session->setId($user->idUser);
    $session->setName($user->name);
    $session->setEmail($user->email);
    $session->setOwner($user->restOwner);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // Error message displaying user does not exists
  }

?>