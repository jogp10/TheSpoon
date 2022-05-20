<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/restaurant.class.php');

  $db = getDatabaseConnection();

  $categories = Category::getRestaurantsCategories($db, 8);
  $byCategory = array();
  foreach($categories as $category) {
    $restaurants = Restaurant::searchRestaurantsbyCategory($db, $_GET['search'], $category->id, 8);
    if(count($restaurants)==0) continue;
    array_push($byCategory, [$restaurants, $category->name]);
  }

  echo json_encode($byCategory);
?>