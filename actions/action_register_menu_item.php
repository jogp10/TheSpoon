<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');
  require_once('../database/menu.class.php');

  $db = getDatabaseConnection();

  $target_file = "../images/dog.jpg";
  $idMenu = Menu::getMenuId($db, intval($_GET['id']));

  $name = $_POST['item_name'];
  $name = preg_replace ("/[^a-zA-Z\s]/", '', $name);

  $item = MenuItem::addItem($db, $idMenu, $name, (int)$_POST['price'], $target_file);    


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>