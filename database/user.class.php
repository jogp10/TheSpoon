<?php
  declare(strict_types = 1);

  class NoUserFound extends Exception {}

  class User {
    public int $idUser;
    public string $email;
    public string $name;
    public string $street;
    public string $city;
    public string $state;
    public int $postalcode;
    public int $phone;
    public bool $restOwner;


    public function __construct(int $idUser, string $email, string $name, string $street, string $city, string $state, int $postalcode, int $phone, bool $restOwner = false)
    {
      $this->idUser = $idUser;
      $this->email = $email;
      $this->name = $name;
      $this->street = $street;
      $this->city = $city;
      $this->state = $state;
      $this->postalcode = $postalcode;
      $this->phone = $phone;
      $this->restOwner = $restOwner;
    }

    public function name() {
      return $this->name;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE User SET Name = ?
        WHERE Email = 
      ');

      $stmt->execute(array($this->name, $this->email));
    }
    
    static function getUserWithPassword(PDO $db, string $email, string $password) : ?User
 {
      $stmt = $db->prepare('
        SELECT idUser, Email, Name, Street, City, State, PostalCode, Phone, RestOwner
        FROM User JOIN Address USING (idAddress)
        WHERE lower(email) = ? AND Password = ?
      ');

      $stmt->execute(array(strtolower($email), sha1($password)));
  
      if ($user = $stmt->fetch()) {
        return new User
    (
          (int)$user['idUser'],
          $user['Email'],
          $user['Name'],
          $user['Street'],
          $user['City'],
          $user['State'],
          (int)$user['PostalCode'],
          (int)$user['Phone'],
          (bool)$user['RestOwner']
        );
      } else return null;
    }

    static function getUser(PDO $db, int $id): User {
      $stmt = $db->prepare('
        SELECT idUser, Email, Name, Street, City, State, PostalCode, Phone, RestOwner
        FROM User JOIN Address USING (idAddress)
        WHERE idUser = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      if ($user==false) throw new NoUserFound();
      return new User
     (
        (int)$user['idUser'],
        $user['Email'],
        $user['Name'],
        $user['Street'],
        $user['City'],
        $user['State'],
        (int)$user['PostalCode'],
        (int)$user['Phone'],
        (bool)$user['RestOwner']
      );
    }

    static function addUser(PDO $db, string $email, string $password, int $phone, string $name, bool $restOwner, string $street, string $city, string $state, int $postalCode): User {
      try {
        User::getUser($db, $email);
      } catch (NoUserFound $e) {

        $stmt = $db->prepare(
          'SELECT * 
          FROM    Address
          WHERE   idAddress = (SELECT MAX(idAddress)  FROM Address)'
        );
        $stmt->execute();
        $idAddress = $stmt->fetch()['idAddress'] + 1;
        echo '$idAddress';

        $stmt = $db->prepare(
          'SELECT * 
          FROM    User
          WHERE   idUser = (SELECT MAX(idUser)  FROM User)'
        );
        $stmt->execute();
        $idUser = $stmt->fetch()['idUser'] + 1;
        echo '$idUser';

        $stmt = $db->prepare(
          'INSERT INTO Address values (?, ?, ?, ?, ?)'
        );
        $stmt->execute(array($idAddress, $street, $city, $state, $postalCode));

        $stmt = $db->prepare(
          'INSERT INTO User values (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute(array($idUser, $email, sha1($password), $phone, $name, $restOwner, $idAddress));

        return new User (
          $idUser, 
          $email,
          $name,
          $street,
          $city,
          $state,
          $postalCode,
          $phone,
          $restOwner

        );
      }
      return null;
    }
  }
?>