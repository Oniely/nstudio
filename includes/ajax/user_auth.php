<?php

session_start();

require '../redirect.php';
require '../connection.php';

if (isset($_GET['username']) && $_GET['username'] != "") {
    $username = $_GET['username'];
    $sql = "SELECT * FROM site_user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "true";
    } else {
        echo "false";
    }
}

if (isset($_GET['email']) && $_GET['email'] != "") {
    $email = $_GET['email'];
    $sql = "SELECT * FROM site_user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "true";
    } else {
        echo "false";
    }
}
