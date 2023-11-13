<?php

require_once '../includes/session.php';
require_once '../includes/connection.php';
require_once '../includes/functions.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require './partials/head.php' ?>
<body class="min-h-screen">
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="w-full h-full">

    </main>
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>
</html>