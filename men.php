<?php

session_start();
require 'includes/connection.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $profile_img = $row['image_path'];
} else {
    $userID = "";
}

require "./includes/functions.php";

$menActive = 'active';

?>

<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require './views/partials/head.php' ?>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php require './views/partials/loading.php' ?>
    <!-- Navbar -->
    <?php require './views/partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen w-full pt-[3rem] px-16 md:px-[1rem] animate__animated fadeIn">
        <div class="container flex justify-start mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato'] uppercase">
                MEN
            </h3>
        </div>
        <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3">
            <?php showAllMenProduct(); ?>
        </div>
    </main>
    <!-- Footer -->
    <?php require './views/partials/footer.php' ?>
</body>

</html>