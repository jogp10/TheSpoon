<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');

  require_once('../database/menu.class.php');
  require_once('../templates/common.tpl.php');

  $db = getDatabaseConnection();

  drawHeader($session);
  drawFooter();
?>