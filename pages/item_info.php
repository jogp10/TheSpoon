<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/menu.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/restaurant.tpl.php');

  $db = getDatabaseConnection();

  $item = MenuItem::getMenuItem($db, intval($_GET['id']));

  drawHeader($session);
  drawItemProfile($session, $item);
  drawFooter();
?>