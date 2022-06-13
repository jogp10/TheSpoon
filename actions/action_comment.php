<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/restaurant.class.php');
  require_once('../database/connection.php');
  require_once('../database/review.class.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, (int)$_POST['idRestaurant']);
  $reviews = Review::getReviewsFromRestaurant($db, (int)$_POST['idRestaurant']);
  $numberReviews = count($reviews) + 1;
  $commentRating = $_POST['rating'];
  $newRating = ($restaurant->rating + $commentRating) / $numberReviews;

  Restaurant::updateRestaurantRating($db, $newRating, $restaurant->id);
  $comment = Review::addReview($db, $session->getId(), (int) $_POST['rating'], $_POST['comment'], (int) $_POST['idRestaurant'], '');

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>