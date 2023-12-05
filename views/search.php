<?php

require_once '../includes/session.php';
require_once '../includes/connection.php';

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
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen h-full pt-[3rem] px-16 md:px-[1rem]">
        <?php if (checkSearchKey($key) || !empty($type_value)) : ?>
            <div class="container flex justify-start mt-4 mb-3">
                <h3 class="text-2xl font-[600] font-['Lato'] capitalize">
                    <?= @$key ?>
                    <?= @$type_value ?>
                </h3>
            </div>
        <?php endif; ?>
        <div class="container h-full min-h-full flex flex-wrap justify-evenly items-center">
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