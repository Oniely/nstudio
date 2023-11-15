<?php

include '../session.php';

include '../redirect.php';
include '../connection.php';

if (isset($_POST['action']) && isset($_POST['item_id'])) {
    if (isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $product_item_id = $_POST['item_id'];

        $sql = $conn->prepare("SELECT product_item_id, quantity FROM cart_tbl WHERE user_id=? AND product_item_id=?");
        $sql->bind_param("ii", $userID, $product_item_id);
        $sql->execute();
        $result = $sql->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quantity = $row['quantity'];

            if ($_POST['action'] === "minus_quantity") {
                $quantity = max(0, $quantity - 1);
            } elseif ($_POST['action'] === "add_quantity") {
                $sql = "SELECT quantity FROM product_item WHERE id=?";
                $query = $conn->prepare($sql);
                $query->bind_param('i', $product_item_id);
                $query->execute();
                $result = $query->get_result()->fetch_row();
                if ($result) {
                    $quantity = min($result[0], $quantity + 1);
                }
            } else {
                return;
            }

            $sql = "SELECT
                    product_tbl.product_price
                    FROM
                    product_item
                    JOIN product_tbl ON product_item.product_id = product_tbl.product_id
                    WHERE
                    product_item.id = ?";

            $query = $conn->prepare($sql);
            $query->bind_param('i', $product_item_id);
            $query->execute();
            $result = $query->get_result()->fetch_row();

            if ($quantity === 0) {
                echo json_encode([$quantity, $result[0], calculateSubtotal($userID)]);
                exit();
            }

            $update_sql = $conn->prepare("UPDATE cart_tbl SET quantity=? WHERE user_id=? AND product_item_id=?");
            $update_sql->bind_param("iii", $quantity, $userID, $product_item_id);
            $update_sql->execute();

            if ($update_sql->affected_rows > 0) {
                echo json_encode([$quantity, $result[0], calculateSubtotal($userID)]);
            } else {
                return;
            }
        } else {
            echo "No record";
        }
    } else {
        echo "No Session ID";
    }
} else {
    echo "Wrong Action";
}

function calculateSubtotal($userID)
{
    global $conn;

    $sql = $conn->prepare("SELECT product_item_id, quantity FROM cart_tbl WHERE user_id=?");
    $sql->bind_param("i", $userID);
    $sql->execute();
    $result = $sql->get_result();

    $total = 0;

    while ($row = $result->fetch_assoc()) {
        $product_item_id = $row['product_item_id'];
        $quantity = $row['quantity'];

        $price_sql = "SELECT
                    product_tbl.product_price
                    FROM
                    product_item
                    JOIN product_tbl ON product_item.product_id = product_tbl.product_id
                    WHERE
                    product_item.id = ?";

        $price_query = $conn->prepare($price_sql);
        $price_query->bind_param('i', $product_item_id);
        $price_query->execute();
        $price_result = $price_query->get_result()->fetch_row();

        $total += $quantity * $price_result[0];
    }

    return $total;
}