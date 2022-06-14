<?php
declare(strict_types = 1);

function loadRestaurantPhoto(Restaurant $restaurant): string
{
    $target_file = $restaurant->photo;

    if ($_FILES['uploadPhoto']['size'] != 0) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["uploadPhoto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $target_file = $target_dir . "rest_" . (string)$restaurant->id . '.' . $imageFileType;
        $uploadOk = 1;


        if (file_exists($target_file)) {
            echo "Sorry, image already exists.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your image was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["uploadPhoto"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["uploadPhoto"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            if($restaurant->photo != "../images/default.jpg"){
                unlink($restaurant->photo);
            }
        }
    }

    return $target_file;
}

function loadItemPhoto(MenuItem $item): string
{

    $target_file = $item->photo;

    if ($_FILES['uploadPhoto']['size'] != 0) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["uploadPhoto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
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
                echo "The file " . htmlspecialchars(basename($_FILES["uploadPhoto"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            if($item->photo != "../images/default.jpg"){
                unlink($item->photo);
            }
        }
    }

    return $target_file;
}
