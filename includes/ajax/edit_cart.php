<?php

session_start();

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['product_id']) && isset($_GET['item_id'])) {
        $product_id = $_GET['product_id'];
        $product_item_id = $_GET['item_id'];

        // left off here to try and find a solution on how to make the edit bea select button
    }
}

?>