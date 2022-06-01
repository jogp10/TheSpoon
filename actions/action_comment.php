<?php
  declare(strict_types = 1);

use JetBrains\PhpStorm\ExpectedValues;

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/review.class.php');

  $db = getDatabaseConnection();

  $comment = Review::addReview($db, (int) $_SESSION['id'], (int) $_POST['rating'], $_POST['comment'], (int) $_POST['idRestaurant'], '');

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>