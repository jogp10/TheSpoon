<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['email'], $_POST['password']);

  if ($user) {
    $_SESSION['id'] = $user->idUser;
    $_SESSION['name'] = $user->name;
    $_SESSION['email'] = $user->email;
    $_SESSION['owner'] = $user->restOwner;
    header('Location: index.php');
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // Error message displaying user does not exists
  }

?>