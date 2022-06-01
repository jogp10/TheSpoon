<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $_SESSION['id']);

  $user->updateUser($db, $_POST['name'], $_POST['email'], (int)$_POST['phone'], $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);
  $_SESSION['name'] = $_POST['name'];
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>