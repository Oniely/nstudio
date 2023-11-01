<?php

session_start();

include './redirect.php';
include './connection.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'minus_quantity' ) {
        if (isset($_SESSION['product_id']) && isset($_SESSION['id'])) {
            $userID = $_SESSION['id'];
            $product_id = $_SESSION['product_id'];

            $sql = "";
        } else {
            return;
        }
    }
}
