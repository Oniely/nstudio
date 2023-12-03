<?php

require_once '../includes/session.php';
require_once '../includes/connection.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

// ADD CHECK IF ADDRESS ALREADY EXISTS IF SO, UPDATE IT INSTEAD
// MAYBE TRANSFER THIS TO AJAX TO BE ABLE TO ACCESS THE DATA ATTRIBUTE FROM THE BUTTON TO UPDATE THE ADDRESS

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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

    if (isset($_POST['action']) && $_POST['action'] == "add_address") {
        $sql = "INSERT INTO address_tbl VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sssssssss", $fname, $lname, $email, $street_name, $pcode, $city, $province, $country, $contact_number);
        $query->execute();

        $addressID = $conn->insert_id;

        if (isset($_POST['defaultAddress'])) {
            $default = 1;

            $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
            $updateQuery = $conn->prepare($updateSql);
            $updateQuery->bind_param("i", $userID);
            $updateQuery->execute();
        } else {
            $default = 0;
        }

        $sql = "INSERT INTO user_address VALUES (?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("iii", $userID, $addressID, $default);
        $query->execute();

        if ($query->affected_rows == 1) {
            echo "SUCCESS";
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }

    if (isset($_POST['action']) && $_POST['action'] == "update_address" && isset($_POST['addressID'])) {
        $addressID = $_POST['addressID'];

        $sql = "UPDATE address_tbl SET fname = ?, lname = ?, email = ?, street_name = ?, pcode = ?, city = ?, province = ?, country = ?, contact_number = ? WHERE address_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("sssssssssi", $fname, $lname, $email, $street_name, $pcode, $city, $province, $country, $contact_number, $addressID);
        $query->execute();

        if (isset($_POST['defaultAddress'])) {
            $default = 1;

            $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
            $updateQuery = $conn->prepare($updateSql);
            $updateQuery->bind_param("i", $userID);
            $updateQuery->execute();
        } else {
            $default = 0;
        }

        $sql = "UPDATE user_address SET is_default = ? WHERE user_id = ? AND address_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("iii", $default, $userID, $addressID);
        $query->execute();

        if ($query->affected_rows == 1) {
            echo "SUCCESS";
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}
