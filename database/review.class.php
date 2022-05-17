<?php
  declare(strict_types = 1);

  class Review {
    public int $id;
    public int $rating;
    public string $comment;
    public string $answer;
    public string $nameUser;
    public string $nameOwner;

    public function __construct(int $id, int $rating, string $comment, string $nameUser, string $answer, string $nameOwner) { 
      $this->id = $id;
      $this->rating = $rating;
      $this->comment = $comment;
      $this->answer = $answer;
      $this->nameUser = $nameUser;
      $this->nameOwner = $nameOwner;
    }


    static function getReviewsFromRestaurant(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT idEvaluation, Rating, Message, idUser, Comments, idRestaurant  FROM Evaluation WHERE idRestaurant = ?');
      $stmt->execute(array($id));

      $reviews = array();
      while ($review = $stmt->fetch()) {
        $reviews[] = new Review(
          (int) $restaurant['idEvaluation'],
          (int) $restaurant['Rating'],
          $review['Message'],
          $review[''],
          $review['Comments'],
          $review['']
        );
      }

      return $reviews;
    }

    static function getReviewsFromUser(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('SELECT idEvaluation, Rating, Message, idUser, Comments, idRestaurant  FROM Evaluation WHERE idUser = ?');
      $stmt->execute(array($id));

      $reviews = array();
      while ($review = $stmt->fetch()) {
        $reviews[] = new Review(
          (int) $restaurant['idEvaluation'],
          (int) $restaurant['Rating'],
          $review['Message'],
          $review[''],
          $review['Comments'],
          $review['']
        );
      }

      return $reviews;
    }

?>