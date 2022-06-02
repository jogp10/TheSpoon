<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();
  $session->logout();

  header('Location: /');
?>