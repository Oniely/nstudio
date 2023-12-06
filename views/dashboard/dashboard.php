<?php

require_once '../../includes/session.php';
require_once '../../includes/connection.php';
require_once '../../includes/functions.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $username = $row['username'];
    $contact_number = $row['contact_number'];
    $password = $row['password'];
    $profile_img = $row['image_path'];
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
    <main class="min-h-screen h-full py-6">
        <div class="container min-h-screen pt-[4rem] px-[4rem] flex flex-col gap-7 relative overflow-hidden">
            <div class="pl-[10rem] text-[#505050]">
                <p class="uppercase text-sm">Account / Dashboard</p>
                <h1 class="capitalize text-4xl font-semibold tracking-wider">Welcome Back, <span><?= $fname ?></span>!</h1>
            </div>
            <div class="flex items-start">
                <div class="flex flex-col justify-start items-start gap-1 pt-[3.1rem]">
                    <h1 class="text-xl font-semibold px-2">Account</h1>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100 font-medium underline" href="dashboard.php">Dashboard</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="profile.php">Profile</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="address.php">Address</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="/nstudio/includes/logout.php">Logout</a>
                </div>
                <div class="container h-auto pl-10">
                    <h1 class="text-2xl py-2">Purchase History</h1>

                    <div class="w-full h-auto flex flex-col justify-center items-start gap-10">
                        <div class="flex items-center gap-3 h-full p-4 pl-6 pr-[10rem] border border-[#505050]">
                            <div class="h-44 shrink-0">
                                <a href="#">
                                    <img class="max-w-full h-full object-cover" src="/nstudio/img/product/prod2.png" alt="">
                                </a>
                            </div>
                            <div class="flex flex-col gap-3 h-full">
                                <div class="flex flex-col justify-center items-start">
                                    <h1 class="text-sm tracking-[2px]">CHECK WOOL SHIRT</h1>
                                    <p class="text-sm">$175 USD</p>
                                </div>
                                <div class="flex flex-col justify-center items-start">
                                    <h1 class="text-sm font-semibold">Japheth Gonzales</h1>
                                    <p class="text-sm">Socorro Woords, Barangay One City of Kabankalan 6111 Croatia</p>
                                    <p class="text-sm">09123456789</p>
                                </div>
                                <div class="flex flex-col justify-center items-start">
                                    <h1 class="text-sm font-semibold">JNT</h1>
                                    <p class="text-sm">Tracking Number: <span class="underline">398H43SKJDFH</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php require '../partials/footer.php' ?>
</body>

</html>