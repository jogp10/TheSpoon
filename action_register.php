<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getCustomer($db, $_POST['email']);

  if ($user == null) {

    $user = User::addCustomer($db, $_POST['email'], $_POST['password'], (int)$_POST['phone'], $_POST['name'], (bool)$_POST['restOwner'], $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postalCode']);
    $_SESSION['id'] = $user->idUser;
    $_SESSION['name'] = $user->name(); 
    header('Location: register.php');
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // Error message displaying user already exists
  }

?>