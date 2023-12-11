<?php

session_start();

require_once '../connection.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == "update_address" && isset($_POST['address_id'])) {
        $addressID = $_POST['address_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $street_name = $_POST['street_name'];
        $pcode = $_POST['pcode'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $country = $_POST['country'];
        $contact_number = $_POST['contact_number'];
        $default = $_POST['default'];

        $sql = "UPDATE address_tbl SET fname = ?, lname = ?, email = ?, street_name = ?, postal_code = ?, city = ?, province = ?, contact_number = ? WHERE id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("ssssssssi", $fname, $lname, $email, $street_name, $pcode, $city, $province, $contact_number, $addressID);
        $query->execute();


        if ($default == 1) {
            $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
            $updateQuery = $conn->prepare($updateSql);
            $updateQuery->bind_param("i", $userID);
            $updateQuery->execute();
        } else {
            $default = 0;
        }

        $userAddressSql = "UPDATE user_address SET is_default = $default WHERE user_id = $userID AND address_id = $addressID";
        $result = $conn->query($userAddressSql);

        if ($result) {
            echo "SUCCESS";
            return;
        } else {
            echo "UPDATE FAILED";
            return;
        }
    } else {
        echo "ERROR";
        return;
    }
} else {
    echo "ERROR";
}
