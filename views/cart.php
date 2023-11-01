<?php

session_start();

require "../includes/connection.php";
require "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    $userID = "";
}

if (isset($_GET['id'])) {
    $userID = $_GET['id'];
} else {
    $userID = "";
}

?>

<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php require './partials/head.php' ?>
<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="w-full h-screen pt-[4.5rem]">

    <div class="flex justify-center items-center gap-2">
    <?php showCartProducts($userID) ?>
    </div>

    </main>
    <!-- Footer Section -->
    <?php require './partials/footer.php' ?>
</body>
</html>