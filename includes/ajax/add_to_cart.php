<?php

session_start();
session_regenerate_id();

include '../redirect.php';
include '../connection.php';

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    if (isset($_SESSION['product_id']) && isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $product_id = $_SESSION['product_id'];

        $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID AND product_id=$product_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $sql = "UPDATE cart_tbl SET quantity=quantity + 1 WHERE user_id=$userID AND product_id=$product_id";
            $result = $conn->query($sql);

            if ($result) {
                $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0){
                    echo $result->num_rows;
                } else {
                    return;
                }
            }
        } else {
            $sql = "INSERT INTO cart_tbl (user_id, product_id, quantity) VALUES ($userID, $product_id, 1)";
            $result = $conn->query($sql);

            if ($result) {
                $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo $result->num_rows;
                } else {
                    return;
                }
            } else {
                return;
            }
        }
    } else {
        return;
    }
} else {
    return;
}
