<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/user.class.php');

  $db = getDatabaseConnection();

  if ($_POST['password']!=$_POST['password-repeat']) {
    header('Location: register.php');
    //Error message displaying different passwords;
  }
  else {
    $user = User::addUser($db, $_POST['email'], $_POST['password'], (int)$_POST['phone'], $_POST['name'], (bool)$_POST['restaurant-owner'], $_POST['street'], $_POST['city'], $_POST['state'], (int)$_POST['postal-code']);
        
    if ($user != null) {
      $_SESSION['id'] = $user->idUser;
      $_SESSION['name'] = $user->name;
      $_SESSION['email'] = $user->email;
      header('Location: /');
    } else {
      header('Location: register.php' . $_SERVER['HTTP_REFERER']);
      // Error message displaying user already exists
    }
  }

?>