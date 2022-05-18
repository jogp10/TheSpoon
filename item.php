<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');

  require_once('database/menu.class.php');

  require_once('templates/common.tpl.php');

  $db = getDatabaseConnection();

  drawHeader();
  drawFooter();
?>