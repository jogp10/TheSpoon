<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/review.class.php');

  $db = getDatabaseConnection();
?>