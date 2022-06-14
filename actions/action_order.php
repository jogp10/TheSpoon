<?php
    declare(strict_types = 1);

    require_once('../utils/session.php');
    $session = new Session();

    require_once('../database/order.class.php');
    require_once('../database/connection.php');
    require_once('../database/user.class.php');

    $db = getDatabaseConnection();

    $current_date = date("c");
    $price = (int) $_POST["price"];
    $idUser = $session->getId();

    $order = Order::addOrder($db, $idUser, $current_date, $price, (int)$_POST["idRest"]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>