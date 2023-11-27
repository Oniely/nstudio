<?php

require_once '../../includes/session.php';
require_once '../../includes/connection.php';
require_once '../../includes/functions.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require '../partials/head.php' ?>

<body class="min-h-screen">
    <!-- Navbar -->
    <?php require '../partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen h-full">
        <div class="container min-h-screen pt-[4rem] px-[4rem] flex flex-col gap-7">
            <div class="">
                <h1 class="text-4xl text-center">Welcome Back, Niel Angelo!</h1>
            </div>
            <div class="flex w-full min-h-screen">
                <div class="flex flex-col gap-8">
                    <a class="py-2 text-start px-2 w-[8rem] hover:bg-slate-100" href="dashboard.php">Dashboard</a>
                    <a class="py-2 text-start px-2 w-[8rem] hover:bg-slate-100" href="profile.php">Profile</a>
                    <a class="py-2 text-start px-2 w-[8rem] hover:bg-slate-100" href="address.php">Address</a>
                    <a class="py-2 text-start px-2 w-[8rem] hover:bg-slate-100" href="/nstudio/includes/logout.php">Logout</a>
                </div>
                <div class="container h-auto pl-10">
                    <h1 class="text-2xl py-2">Dashboard</h1>

                    <div class="w-full h-[13rem] flex items-center">
                        <p>You haven't placed any orders yet. Check back after placing an order to view details here.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php require '../partials/footer.php' ?>
</body>

</html>