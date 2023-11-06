<?php

session_start();
session_regenerate_id();

include '../redirect.php';
include '../connection.php';

if (isset($_POST['action']) && isset($_POST['product_id'])) {
    if (isset($_SESSION['id'])) {
        $userID = $_SESSION['id'];
        $product_id = $_POST['product_id'];

        $sql = $conn->prepare("SELECT product_id, quantity FROM cart_tbl WHERE user_id=? AND product_id=?");
        $sql->bind_param("ii", $userID, $product_id);
        $sql->execute();
        $result = $sql->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quantity = $row['quantity'];

            if ($_POST['action'] === "minus_quantity") {
                $quantity = max(0, $quantity - 1); // Ensure quantity doesn't go below 0
            } elseif ($_POST['action'] === "add_quantity") {
                $quantity = $quantity + 1;
            }

            $sql = "SELECT product_price FROM product_tbl WHERE product_id=?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $product_id);
            $query->execute();
            $result = $query->get_result()->fetch_row();

            if ($quantity === 0) {
                echo json_encode([$quantity, $result[0]]);
                exit();
                // $sql = "DELETE FROM cart_tbl WHERE user_id=? AND product_id=?";
                // $query = $conn->prepare($sql);
                // $query->bind_param('ii', $userID, $product_id);
                // $query->execute();
            }

            $update_sql = $conn->prepare("UPDATE cart_tbl SET quantity=? WHERE user_id=? AND product_id=?");
            $update_sql->bind_param("iii", $quantity, $userID, $product_id);
            $update_sql->execute();

            if ($update_sql->affected_rows > 0) {
                echo json_encode([$quantity, $result[0]]);
            } else {
                return;
            }
        } else {
            return;
        }
    } else {
        return;
    }
} else {
    return;
}
