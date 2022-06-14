<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  $user->updateUser($db, $_POST['name'], $_POST['email'], (int)$_POST['phone'], $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);
  $session->setName($_POST['name']);
  $session->setEmail($_POST['email']);
  $session->addMessage('success', 'Profile updated!');
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>