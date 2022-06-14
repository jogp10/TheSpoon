<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/user.class.php');
  require_once('../utils/string_manip.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  $name = $_POST['name'];
  $name = strRemoveSpeChr($name);

  $street = $_POST['street'];
  $street = strRemoveSpeChr($street);

  $city = $_POST['city'];
  $city = strRemoveSpeChr($city);

  $state = $_POST['state'];
  $state = strRemoveSpeChr($state);

  $user->updateUser($db, $name, $_POST['email'], (int)$_POST['phone'], $street, $city, $state, (int)$_POST['postal-code']);
  $session->setName($name);
  $session->setEmail($_POST['email']);
  $session->addMessage('updated', 'Profile updated!');
  
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>