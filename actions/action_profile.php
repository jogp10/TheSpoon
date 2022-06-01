<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  $user->updateUser($db, $_POST['name'], $_POST['email'], (int)$_POST['phone'], $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);
  $session->setName($_POST['name']);
  $session->setEmail($_POST['email']);
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>