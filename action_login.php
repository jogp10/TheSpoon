<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/customer.class.php');

  $db = getDatabaseConnection();

  $customer = Customer::getCustomerWithPassword($db, $_POST['email'], $_POST['password']);

  if ($customer) {
    $_SESSION['id'] = $customer->phone;
    $_SESSION['name'] = $customer->name(); 
    header('Location: index.php');
  } else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>