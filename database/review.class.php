<?php
  declare(strict_types = 1);

  class No extends Exception {}

  require_once('database/user.class.php');

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

      $stmt2 = $db->prepare('SELECT idUser, idRestaurant FROM Restaurant WHERE idRestaurant = ?');
      $stmt2->execute(array($id));
      $restOwner = User::getUser($db, intval($stmt2->fetch()['idUser']));

      $reviews = array();
      while ($review = $stmt->fetch()) {
        $user = User::getUser($db, intval($review['idUser']));
        $reviews[] = new Review(
          (int) $review['idEvaluation'],
          (int) $review['Rating'],
          $review['Message'],
          $user->name,
          $review['Comments'],
          $restOwner->name()
        );
      }

      return $reviews;
    }

    static function getReviewsFromUser(PDO $db, int $id) : array {
      $stmt = $db->prepare('SELECT idEvaluation, Rating, Message, idUser, Comments, idRestaurant  FROM Evaluation WHERE idUser = ?');
      $stmt->execute(array($id));

      $user = User::getUser($db, $id);      

      $reviews = array();
      while ($review = $stmt->fetch()) {
        $stmt2 = $db->prepare('SELECT idUser, idRestaurant FROM Restaurant WHERE idRestaurant = ?');
        $stmt2->execute(array($review['idRestaurant']));
        $restOwner = User::getUser($db, intval($stmt2->fetch()['idUser']));

        $reviews[] = new Review(
          (int) $review['idEvaluation'],
          (int) $review['Rating'],
          $review['Message'],
          $user->name(),
          $review['Comments'],
          $restOwner->name()
        );
      }

      return $reviews;
    }

    static function addReview(PDO $db, int $idUser, int $rating, string $comment, int $idRestOwn, string $answer) :  Review {
      $stmt = $db->prepare(
        'SELECT * 
        FROM    Evaluation
        WHERE   idEvaluation = (SELECT MAX(idEvaluation)  FROM Evaluation)'
      );
      $stmt->execute();
      $id = $stmt->fetch()['idEvaluation'] + 1;

      $stmt2 = $db->prepare('INSERT INTO Evaluation values (?, ?, ?, ?, ?, ?)');
      $stmt2->execute(array($id, $idUser, $idRestOwn, $rating, $comment, $answer));


      return new Review(
        $id, $rating, $comment, User::getUser($db, $idUser)->name(), $answer, User::getRestaurantOwner($db, $idRestOwn)->name()
      );
    }

    static function updateReview(PDO $db, int $idReview, string $answer) {
      $stmt = $db->prepare(
        'UPDATE Evaluation
        SET Comments = ?
        WHERE   idEvaluation = ?'
      );
      $stmt->execute(array($answer, $idReview));
    }
  }

?>