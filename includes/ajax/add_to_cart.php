<?php

include '../session.php';
include '../redirect.php';
include '../connection.php';

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    if (isset($_SESSION['id']) && isset($_SESSION["{$_SESSION['product_id']}item_id"])) {
        $userID = $_SESSION['id'];
        $product_item_id = $_SESSION["{$_SESSION['product_id']}item_id"];

        $sql = "SELECT
                *
                FROM
                cart_tbl
                WHERE
                user_id = $userID
                AND product_item_id = $product_item_id";

        $cartResult = $conn->query($sql);

        if ($cartResult && $cartResult->num_rows > 0) {
            $sql = "SELECT
                cart_tbl.*,
                product_item.quantity item_quantity
                FROM
                cart_tbl
                JOIN product_item ON cart_tbl.product_item_id = product_item.id
                WHERE
                cart_tbl.user_id = $userID
                AND cart_tbl.product_item_id = $product_item_id";
            $result = $conn->query($sql);

            if ($row = $result->fetch_assoc()) {
                $cart_quantity = $row['quantity'];
                $item_quantity = $row['item_quantity'];

                if (!$cart_quantity >= $item_quantity) {
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
                    } else {
                        echo "FULL STOCK";
                    }
                } else {
                    echo "FULL STOCK";
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
        echo "NOT LOGGED IN";
    }
} else {
    echo "Action is not recognized.";
}
