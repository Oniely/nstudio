<?php

session_start();

include './redirect.php';
include './connection.php';

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    if (isset($_SESSION['product_id']) && isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $product_id = $_SESSION['product_id'];

        $sql = "INSERT INTO cart_tbl (user_id, product_id) VALUES ($userID, $product_id)";
        if ($conn->query($sql)) {
            $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo $result->num_rows;
            }
        } else {
            echo "Error" . $conn->error;
        }
    } else {
        return;
    }
}
