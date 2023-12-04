<?php

require_once '../session.php';
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

        $sql = "UPDATE address_tbl SET fname = ?, lname = ?, email = ?, street_name = ?, pcode = ?, city = ?, province = ?, contact_number = ? WHERE address_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("ssssssssi", $fname, $lname, $email, $street_name, $pcode, $city, $province, $contact_number, $addressID);
        $query->execute();

        if ($query->affected_rows == 1) {
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
                return;
            } else {
                echo "ERROR";
                return;
            }
        } else {
            echo "ERROR";
            return;
        }
    } else {
        echo "ERROR";
        return;
    }
} else {
    echo "ERROR";
}
