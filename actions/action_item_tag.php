<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/category.class.php');

  $db = getDatabaseConnection();

  $idItem = intval($_GET['id']);


  foreach($_POST as $post){
    if (!MenuItemCategories::hasCategory($db, $idItem, (int) $post)) MenuItemCategories::addMenuItemCategory($db, $idItem, (int) $post); 
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>