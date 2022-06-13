<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../utils/load_file.php');
  require_once('../database/connection.php');
  require_once('../database/menu.class.php');

  $db = getDatabaseConnection();

  $item = MenuItem::getMenuItem($db, intval($_GET['id']));
  $target_file = loadItemPhoto($item);

  MenuItem::updateMenuItem($db, $_POST['item_name'], $_POST['item_price'], $target_file, $item->id);


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>