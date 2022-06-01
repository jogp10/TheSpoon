<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/review.class.php');

  $db = getDatabaseConnection();

  Review::updateReview($db, (int) $_POST['idReview'], $_POST['answer']);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>