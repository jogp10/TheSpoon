<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');

  $db = getDatabaseConnection();

  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>