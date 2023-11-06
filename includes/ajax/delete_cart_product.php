<?php

session_start();
session_regenerate_id();

include '../redirect.php';
include '../connection.php';

if (isset($_POST['action']) && $_POST['action'] === "delete_product") {
    if (isset($_SESSION['id']) && isset($_POST['product_id'])) {
        $userID = $_SESSION['id'];
        $product_id = $_POST['product_id'];

        $sql = "DELETE FROM cart_tbl WHERE user_id=? AND product_id=?";
        $query = $conn->prepare($sql);
        $query->bind_param('ii', $userID, $product_id);
        $query->execute();

        if ($query->affected_rows > 0) {
            echo "SUCCESS";
        }
    }
}