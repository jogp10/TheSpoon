<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();


  require_once('../database/connection.php');
  require_once('../database/menu.class.php');

  $db = getDatabaseConnection();

  $item = MenuItem::getMenuItem($db, intval($_GET['id']));
  $idUser = $session->getId();

  $item->addFavorite($db, $idUser);    


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>