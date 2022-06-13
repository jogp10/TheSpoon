<?php
  declare(strict_types = 1);

  require_once('../utils/session.php');
  $session = new Session();

  require_once('../database/connection.php');
  require_once('../database/menu.class.php');

  $db = getDatabaseConnection();

  $item = MenuItem::getMenuItem($db, intval($_GET['id']));
  $target_file = $item->photo;

  if ($_FILES['uploadPhoto']['size'] != 0) {
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["uploadPhoto"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_file = $target_dir . "item_" . (string)$item->id . '.' . $imageFileType;
    $uploadOk = 1;
    

    if (file_exists($target_file)) {
      echo "Sorry, image already exists.";
      $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
      echo "Sorry, your image was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["uploadPhoto"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["uploadPhoto"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
      unlink($item->photo);
    }
  }

  MenuItem::updateMenuItem($db, $_POST['item_name'], $_POST['item_price'], $target_file, $item->id);


  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>