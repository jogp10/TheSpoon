<?php
  declare(strict_types = 1);

  class Customer {
    public int $id;
    public string $name;
    public string $address;
    public string $city;
    public string $state;
    public int $postalcode;
    public int $phone;
    public string $email;

    public function __construct(string $email, string $name, string $address, string $city, string $state, int $postalcode, int $phone)
    {
      $this->name = $name;
      $this->address = $address;
      $this->city = $city;
      $this->state = $state;
      $this->postalcode = $postalcode;
      $this->phone = $phone;
      $this->email = $email;
    }

    public function name() {
      return $this->name;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE Customer SET Name = ?
        WHERE CustomerId = ?
      ');

      $stmt->execute(array($this->name, $this->id));
    }
    
    static function getCustomerWithPassword(PDO $db, string $email, string $password) : ?Customer {
      $stmt = $db->prepare('
        SELECT Email, Name, Address, City, State, PostalCode, Phone
        FROM Customer JOIN Address USING (idAddress)
        WHERE lower(email) = ? AND Password = ?
      ');

      $stmt->execute(array(strtolower($email), sha1($password)));
  
      if ($customer = $stmt->fetch()) {
        return new Customer(
          $customer['Email'],
          $customer['Name'],
          $customer['Address'],
          $customer['City'],
          $customer['State'],
          (int)$customer['PostalCode'],
          (int)$customer['Phone']
        );
      } else return null;
    }

    static function getCustomer(PDO $db, int $id) : Customer {
      $stmt = $db->prepare('
        SELECT Email, Name, Address, City, State, PostalCode, Phone
        FROM Customer JOIN Address USING (idAddress)
        WHERE CustomerId = ?
      ');

      $stmt->execute(array($id));
      $customer = $stmt->fetch();
      
      return new Customer(
        $customer['Email'],
        $customer['Name'],
        $customer['Address'],
        $customer['City'],
        $customer['State'],
        (int)$customer['PostalCode'],
        (int)$customer['Phone']
      );
    }

  }
?>