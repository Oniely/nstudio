<?php

require_once '../includes/session.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    $userID = "";
}

if (isset($_GET['key'])) {
    $key = $_GET['key'];
} 
else {
    echo "ERROR";
}

require_once "../includes/functions.php";

?>

<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <?php require './partials/head.php' ?>
<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="w-full h-full pt-[4.5rem]">
        <div class="w-full h-full max-h-full">
            <div class='w-full h-full min-h-full flex flex-wrap justify-evenly items-center'>
                <?php 
                    if ($key != ""):
                        showSearchProduct($key);
                    else:
                ?>
                    <div class='w-full h-screen flex justify-center items-center'>
                        <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg">No Result Found.</h1>
                    </div>
                <?php
                    endif;
                ?>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>
</html>