<?php

require_once 'includes/session.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    $userID = "";
}

require_once "./includes/functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require './views/partials/head.php' ?>

<body>
    <!-- Navbar -->
    <?php require './views/partials/nav.php' ?>
    <!-- Main -->
    <main class="w-full h-full pt-[3rem] px-14">
        <div class="container flex justify-start mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">
                WOMEN
            </h3>
        </div>
        <div class="container h-full min-h-full flex flex-wrap justify-evenly items-center">
            <?php showAllWomenProduct(); ?>
        </div>
    </main>
    <!-- Footer -->
    <?php require './views/partials/footer.php' ?>
</body>

</html>