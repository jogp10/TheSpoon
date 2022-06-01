<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../database/connection.php');

  require_once(__DIR__ . '/../database/menu.class.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');

  $db = getDatabaseConnection();

  drawHeader();
  drawFooter();
?>