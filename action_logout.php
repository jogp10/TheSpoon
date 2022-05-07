<?php
  declare(strict_types = 1);

  session_start();
  session_unset();
  session_destroy();

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>