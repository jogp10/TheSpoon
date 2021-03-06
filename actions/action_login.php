<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
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
    $session->addMessage('success', 'Login successful!');
  } else {
    $session->addMessage('error', "Wrong email or password!");
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>