<?php

session_start();

require '../includes/connection.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $profile_img = $row['image_path'];
} else {
    $userID = "";
}

$key = "";
$type_id = "";

if (isset($_GET['key'])) {
    $key = $_GET['key'];
} elseif (isset($_GET['type']) && isset($_GET['category'])) {
    $type_id = $_GET['type'];
    $category = $_GET['category'];

    include "../includes/connection.php";

    $sql = "SELECT type_value FROM product_type WHERE id = $type_id";
    $result = $conn->query($sql)->fetch_row();
    $type_value = $result[0];
}

require_once "../includes/functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require './partials/head.php' ?>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <div class="preloader w-full h-screen fixed top-0 left-0 bg-white grid place-items-center z-[1000]">
        <img src="/nstudio/img/Loading-bar.gif" alt="loading">
    </div>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen w-full pt-[3rem] px-16 md:px-[1rem] animate__animated fadeIn">
        <?php if (checkSearchKey($key) || !empty($type_value)) : ?>
            <div class="container flex justify-start mt-4 mb-3">
                <h3 class="text-2xl font-[600] font-['Lato'] capitalize">
                    <?= @$key ?>
                    <?= @$type_value ?>
                </h3>
            </div>
        <?php endif; ?>
        <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3">
            <?php
            if (@$key != "") :
                showSearchProduct($key);
            elseif (@$type_id != "") :
                showSearchProductByType($type_id, $category);
            else :
            ?>
                <div class='w-full h-screen flex justify-center items-center'>
                    <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg">No Result Found.</h1>
                </div>
            <?php
            endif;
            ?>
        </div>
    </main>
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>

</html>