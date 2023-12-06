<?php

require '../includes/session.php';
require "../includes/connection.php";
require "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    header('location: /nstudio/login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pay"])) {
    // GET DATA FROM FORM
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $street_name = $_POST['street_name'];
    $pcode = $_POST['pcode'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $country = $_POST['country'];
    $contact_number = $_POST['contact_number'];
    // GET PAYMENT METHOD
    $payment_method = $_POST['payment_method'];

    // CHECK IF ADDRESS ALREADY EXISTS
    $sql = "SELECT * FROM address_tbl
            WHERE fname = ?
            AND lname = ?
            AND email = ?
            AND street_name = ?
            AND postal_code = ?
            AND city = ?
            AND province = ?
            AND country = ?
            AND contact_number = ?";

    $query = $conn->prepare($sql);
    $query->bind_param("sssssssss", $fname, $lname, $email, $street_name, $pcode, $city, $province, $country, $contact_number);
    $query->execute();

    $result = $query->get_result();
    $row = $result->fetch_assoc();

    // IF RESULT IS NULL (non existent), INSERT NEW ADDRESS TO ADDRESS TBL
    if ($result && $result->num_rows < 1) {
        $sql = "INSERT INTO address_tbl VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sssssssss", $fname, $lname, $email, $street_name, $pcode, $city, $province, $country, $contact_number);
        $query->execute();

        $addressID = $conn->insert_id;
    } else {
        // IF ADDRESS EXISTS JUST GET THAT ADDRESS ID
        $addressID = $row['id'];
    }

    // IF SAVE ADDRESS IS CHECKED, SET AS DEFAULT AND LINK IT TO THE USER
    if (isset($_POST['save'])) {
        if ($query->affected_rows == 1) {
            if (clearUserAddressDefaults($userID)) {
                $userAddSql = "INSERT INTO user_address (user_id, address_id, is_default) VALUES (?, ?, 1)";
                $userAddQuery = $conn->prepare($userAddSql);
                $userAddQuery->bind_param("ii", $userID, $addressID);
                $userAddQuery->execute();
            } else {
                echo "<script>alert('Failed to save address.')</script>";
            }
        }
    }

    // Assign variables
    $pending = "PENDING";
    $total = $_SESSION['total'];
    $ordered_products = $_SESSION["product_items"];

    // Just Checking if quantity is greater is valid
    foreach ($ordered_products as $id => $product) {
        if (!$product['quantity'] > 0) {
            echo "<script>alert('Quantity is invalid must be 1 or more.')</script>";
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    // INSERT ORDER TO SHOP ORDER TBL
    $shopSql = "INSERT INTO shop_order_tbl VALUES (DEFAULT, ?, DEFAULT, DEFAULT, ?, ?, ?, ?)";
    $shopQuery = $conn->prepare($shopSql);
    $shopQuery->bind_param("isids", $userID, $payment_method, $addressID, $total, $pending);
    $shopQuery->execute();

    // IF SUCCESSFUL, INSERT ORDER LINE TO ORDER LINE TBL
    if ($shopQuery->affected_rows == 1) {
        $orderID = $conn->insert_id;
        // LOOP THROUGH EACH PRODUCT AND INSERT TO ORDER LINE TBL
        foreach ($ordered_products as $id => $product) {
            $orderSql = "INSERT INTO order_line_tbl VALUES (DEFAULT, ?, ?, ?, ?)";
            $orderQuery = $conn->prepare($orderSql);
            $orderQuery->bind_param("iiid", $id, $orderID, $product['quantity'], $product['price']);
            $orderQuery->execute();

            // IF SUCCESSFUL, UPDATE PRODUCT QUANTITY
            if ($orderQuery->affected_rows == 1) {
                $productSql = "UPDATE product_item SET quantity = quantity - ? WHERE id = ?";
                $productQuery = $conn->prepare($productSql);
                $productQuery->bind_param("ii", $product['quantity'], $id);
                $productQuery->execute();
            }
        }
        // IF BUYNOW IS SET, UNSET IT AND REDIRECT TO DASHBOARD
        // AND EXIT
        if (isset($_SESSION['BUYNOW']) && $_SESSION['BUYNOW'] == true) {
            unset($_SESSION["BUYNOW"]);
            unset($_SESSION["product_items"]);
            header('location: /nstudio/views/dashboard/dashboard.php');
            exit();
        } else {
            // ELSE MEANING THE USER CAME FROM CART PAGE SO REMOVE ALL CART ITEMS THAT GOT CHECKOUT
            $deleteCartSql = "DELETE FROM cart_tbl WHERE user_id = ?";
            $deleteCartQuery = $conn->prepare($deleteCartSql);
            $deleteCartQuery->bind_param("i", $userID);
            $deleteCartQuery->execute();

            unset($_SESSION["product_items"]);
            header('location: /nstudio/views/dashboard/dashboard.php');
            exit();
        }
    } else {
        echo "<script>alert('Failed to place the order to order line.')</script>";
    }
} else {
    header('location' . $_SERVER['HTTP_REFERER']);
    exit();
}
