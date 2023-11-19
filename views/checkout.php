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

?>

<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php require './partials/head.php' ?>
<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>
</html>