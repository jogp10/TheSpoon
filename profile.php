<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('database/connection.php');

  require_once('database/user.class.php');

  require_once('templates/common.tpl.php');
  require_once('templates/user.tpl.php');

  $db = getDatabaseConnection();
  $user = User::getUser($db, $_SESSION['email']);

  drawHeader();
  drawProfile($user);
  drawFooter();
?>