<?php

require_once '../session.php';
require_once '../connection.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['address_id'])) {
        $addressID = $_GET['address_id'];

        $sql = "SELECT address_tbl.*, user_address.is_default FROM user_address INNER JOIN address_tbl ON user_address.address_id = address_tbl.id WHERE user_id = $userID AND id = $addressID";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Fetch the row data
            $row = $result->fetch_assoc();

            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $street_name = $row['street_name'];
            $pcode = $row['postal_code'];
            $city = $row['city'];
            $province = $row['province'];
            $country = $row['country'];
            $contact_number = $row['contact_number'];
            $is_default = $row['is_default'];

            $addressData = array(
                'address_id' => $addressID,
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'street_name' => $street_name,
                'pcode' => $pcode,
                'city' => $city,
                'province' => $province,
                'contact_number' => $contact_number,
                "is_default" => $is_default,
                'update' => true
            );

            echo json_encode($addressData);
        } else {
            echo "ERROR";
        }
    }
}
