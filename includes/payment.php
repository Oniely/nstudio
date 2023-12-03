<?php

require_once '../includes/session.php';

require_once "../includes/connection.php";
require_once "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    header('location: /nstudio/login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pay"])) {
    // Data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $street_name = $_POST['street_name'];
    $pcode = $_POST['pcode'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $country = $_POST['country'];
    $contact_number = $_POST['contact_number'];
    $payment_method = $_POST['payment_method'];

    // Logic
    $sql = "INSERT INTO address_tbl VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->bind_param("sssssssss", $fname, $lname, $email, $street_name, $pcode, $city, $province, $country, $contact_number);
    $query->execute();

    $addressID = $conn->insert_id;

    if (isset($_POST['save'])) {
        if ($query->affected_rows == 1) {
            $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
            $updateQuery = $conn->prepare($updateSql);
            $updateQuery->bind_param("i", $userID);
            $updateQuery->execute();

            $userAddSql = "INSERT INTO user_address (user_id, address_id, is_default) VALUES (?, ?, 1)";
            $userAddQuery = $conn->prepare($userAddSql);

            $userAddQuery->bind_param("ii", $userID, $addressID);
            $userAddQuery->execute();
        }
    }
    $pending = "PENDING";
    $shopSql = "INSERT INTO shop_order_tbl VALUES (DEFAULT, ?, DEFAULT, DEFAULT, ?, ?, ?, ?)";
    $shopQuery = $conn->prepare($shopSql);
    $shopQuery->bind_param("isids", $userID, $payment_method, $addressID, $_SESSION['total'], $pending);
    $shopQuery->execute();

    if ($shopQuery->affected_rows == 1) {
        $orderID = $conn->insert_id;

        foreach ($_SESSION["product_items"] as $id => $product) {
            $orderSql = "INSERT INTO order_line_tbl VALUES (DEFAULT, ?, ?, ?, ?)";
            $orderQuery = $conn->prepare($orderSql);
            $orderQuery->bind_param("iiid", $id, $orderID, $product['quantity'], $product['price']);
            $orderQuery->execute();

            if ($orderQuery->affected_rows == 1) {
                $productSql = "UPDATE product_item SET quantity = quantity - ? WHERE id = ?";
                $productQuery = $conn->prepare($productSql);
                $productQuery->bind_param("ii", $product['quantity'], $id);
                $productQuery->execute();
            }
        }

        if (isset($_SESSION['BUYNOW']) && $_SESSION['BUYNOW'] == true) {
            unset($_SESSION["BUYNOW"]);
            unset($_SESSION["product_items"]);
            header('location: /nstudio/views/dashboard/dashboard.php');
            exit();
        }

        $deleteCartSql = "DELETE FROM cart_tbl WHERE user_id = ?";
        $deleteCartQuery = $conn->prepare($deleteCartSql);
        $deleteCartQuery->bind_param("i", $userID);
        $deleteCartQuery->execute();

        unset($_SESSION["product_items"]);
        header('location: /nstudio/views/dashboard/dashboard.php');
    } else {
        echo "<script>alert('Failed to place the order.')</script>";
    }
}
