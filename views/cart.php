<?php

require_once '../includes/session.php';

require_once "../includes/connection.php";
require_once "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "" && isset($_GET['id'])) {
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
    <script src="../script/cart.js" defer></script>
<body class="min-h-screen">
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="w-full h-screen">

    <div class="w-full h-full flex justify-center items-center gap-3">
        <?php showCartProducts($userID) ?>
    </div>

    </main>
    <!-- Footer Section -->
    <?php require './partials/footer.php' ?>
</body>
</html>