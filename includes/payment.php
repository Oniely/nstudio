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
    $street_name = $_POST['street_name'];
    $pcode = $_POST['pcode'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $country = $_POST['country'];
    $contact_number = $_POST['contact_number'];
    $payment_method = $_POST['payment_method'];

    // Logic
    $sql = "INSERT INTO address VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->bind_param("ssssssss", $fname, $lname, $street_name, $pcode, $city, $province, $country, $contact_number);
    $query->execute();

    $addressID = $conn->insert_id;

    if (isset($_POST['save'])) {
        if ($query->affected_rows == 1) {
            $userAddSql = "INSERT INTO user_address (user_id, address_id, is_default) VALUES (?, ?, DEFAULT)";
            $userAddQuery = $conn->prepare($userAddSql);

            $userAddQuery->bind_param("ii", $userID, $addressID);
            $userAddQuery->execute();
        }
    }
    $pending = "PENDING";
    $shopSql = "INSERT INTO shop_order VALUES (DEFAULT, ?, DEFAULT, ?, ?, ?, ?)";
    $shopQuery = $conn->prepare($shopSql);
    $shopQuery->bind_param("isids", $userID, $payment_method, $addressID, $_SESSION['total'], $pending);
    $shopQuery->execute();

    if ($shopQuery->affected_rows == 1) {
        $orderID = $conn->insert_id;

        foreach ($_SESSION["product_items"] as $id => $product) {
            $orderSql = "INSERT INTO order_line VALUES (DEFAULT, ?, ?, ?, ?)";
            $orderQuery = $conn->prepare($orderSql);
            $orderQuery->bind_param("iiid", $id, $orderID, $product['quantity'], $product['price']);
            $orderQuery->execute();
        }

        unset($_SESSION["product_items"]);
        echo "<script>alert('Order has been placed!')</script>";
    } else {
        echo "<script>alert('Failed to place the order.')</script>";
    }
}
