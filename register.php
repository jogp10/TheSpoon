<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/user.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/user.tpl.php');


  $db = getDatabaseConnection();

  try {
    $user = User::getUser($db, $_POST['email']);
  } catch (NoUserFound $e) {
  }

  if ($user ==  null) {
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // Error message displaying user already exists
  }

  drawHeader();
  drawRegisterForm();
  drawFooter();
?>
