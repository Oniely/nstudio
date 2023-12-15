<?php

session_start();

require '../redirect.php';
require '../connection.php';

function cartCount($userID)
{
    global $conn;

    $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return;
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    if (isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        if (isset($_SESSION['product_id']) && isset($_POST['size']) && isset($_POST['colour'])) {
            $product_id = $_SESSION['product_id'];
            $colour_id = $_POST['colour'];
            $size_id = $_POST['size'];

            $sql = "SELECT
                    cart_tbl.*,
                    product_item.id,
                    product_item.product_id,
                    product_item.quantity item_quantity
                    FROM
                    cart_tbl
                    JOIN product_item ON cart_tbl.product_item_id = product_item.id
                    WHERE
                    cart_tbl.user_id = $userID
                    AND product_item.product_id = ?
                    AND product_item.size_id = ?
                    AND product_item.colour_id = ?";

            $query = $conn->prepare($sql);
            $query->bind_param("iii", $product_id, $size_id, $colour_id);
            $query->execute();

            $result = $query->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $product_item_id = $row['id'];

                $cart_quantity = $row['quantity'];
                $item_quantity = $row['item_quantity'];

                if ($cart_quantity != $item_quantity) {
                    $sql = "UPDATE cart_tbl SET quantity=quantity + 1 WHERE user_id=$userID AND product_item_id=$product_item_id";
                    $result = $conn->query($sql);

                    if ($result) {
                        echo cartCount($userID);
                    } else {
                        echo "ERROR";
                    }
                } else {
                    echo "FULL STOCK";
                }
            } else {
                $sql = "SELECT * FROM product_item WHERE product_id=$product_id AND size_id=$size_id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $product_item_id = $row['id'];

                $sql = "INSERT INTO cart_tbl (user_id, product_item_id, quantity) VALUES ($userID, $product_item_id, 1)";
                $result = $conn->query($sql);

                if ($result) {
                    echo cartCount($userID);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "ERROR";
        }
    } else {
        echo "NOT LOGGED IN";
    }
} else {
    echo "Action is not recognized.";
}
