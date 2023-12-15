<?php

session_start();

require '../redirect.php';
require '../connection.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if (isset($_POST['action']) && $_POST['action'] === "delete_address") {
    if (isset($_POST['address_id'])) {
        $addressID = $_POST['address_id'];

        $sql = "DELETE FROM user_address WHERE user_id=? AND address_id=?";
        $query = $conn->prepare($sql);
        $query->bind_param('ii', $userID, $addressID);
        $query->execute();

        if ($query->affected_rows > 0) {
            echo "SUCCESS";
        } else {
            echo "FAILURE";
        }
    }
}