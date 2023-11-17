<?php

include '../session.php';
include '../redirect.php';
include '../connection.php';

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    if (isset($_SESSION['id']) && isset($_SESSION["{$_SESSION['product_id']}item_id"])) {
        $userID = $_SESSION['id'];
        $product_item_id = $_SESSION["{$_SESSION['product_id']}item_id"];

        $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID AND product_item_id=$product_item_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $sql = "UPDATE cart_tbl SET quantity=quantity + 1 WHERE user_id=$userID AND product_item_id=$product_item_id";
            $result = $conn->query($sql);

            if ($result) {
                $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo $result->num_rows;
                } else {
                    return;
                }
            }
        } else {
            $sql = "INSERT INTO cart_tbl (user_id, product_item_id, quantity) VALUES ($userID, $product_item_id, 1)";
            $result = $conn->query($sql);

            if ($result) {
                $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo $result->num_rows;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        return;
    }
} else {
    echo "Action is not recognized.";
}
