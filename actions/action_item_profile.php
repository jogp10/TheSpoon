<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../utils/load_file.php');
  require_once('../database/connection.php');
  require_once('../database/menu.class.php');
  require_once('../utils/string_manip.php');

  $db = getDatabaseConnection();

  $item = MenuItem::getMenuItem($db, intval($_GET['id']));
  $target_file = loadItemPhoto($item);

  $name = $_POST['item_name'];
  $name = strRemoveSpeChr($name); 

  MenuItem::updateMenuItem($db, $_POST['item_name'], $_POST['item_price'], $target_file, $item->id);


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>