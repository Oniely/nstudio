<?php

session_start();

require "../connection.php";
require "../functions.php";

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

echo showToShipOrders($userID);
