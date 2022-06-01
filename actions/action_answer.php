<?php
  declare(strict_types = 1);

use JetBrains\PhpStorm\ExpectedValues;

  session_start();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/review.class.php');

  $db = getDatabaseConnection();

  Review::updateReview($db, (int) $_POST['idReview'], $_POST['answer']);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>