<?php
    declare(strict_types = 1);

    require_once('../utils/session.php');
    require_once('../database/connection.php');
    require_once('../database/order.class.php');
    $session = new Session();
    $db = getDatabaseConnection();


    $order = Order::getOrderById($db, intval($_GET['id']));
    $order->updateState($db, $_POST['State']);


    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>