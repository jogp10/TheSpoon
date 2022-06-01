<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/review.class.php');

  $db = getDatabaseConnection();

  $comment = Review::addReview($db, $session->getId(), (int) $_POST['rating'], $_POST['comment'], (int) $_POST['idRestaurant'], '');

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>