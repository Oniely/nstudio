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
<script src="/nstudio/script/dashboard.js" defer></script>

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
                    <div class="w-full flex flex-col justify-center items-center border">
                        <div class="w-full flex h-[3rem] border-b">
                            <div class="w-full h-full hover:border-b-2 active:border-b">
                                <button id="toPay" class="w-full h-full">To pay</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b">
                                <button id="toShip" class="w-full h-full">To ship</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b">
                                <button id="toReceive" class="w-full h-full">To receive</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b">
                                <button id="completedBtn" class="w-full h-full">Completed</button>
                            </div>
                        </div>
                        <!-- Product Container -->
                        <div id="productContainer" class="w-full h-auto flex gap-10 pt-[3rem] pb-[2rem] px-[3rem]">
                            <!-- Completed Products -->
                            <div id="completedProducts" class="w-full h-auto flex flex-col justify-center items-start gap-10">
                                <!-- Products -->
                                <div class="w-full flex flex-col gap-3 h-full p-4 pl-6 border border-[#505050]">
                                    <!-- Top -->
                                    <div class="w-full flex items-center gap-2">
                                        <div class="h-44 shrink-0">
                                            <a href="#">
                                                <img class="max-w-full h-full object-cover" src="/nstudio/img/product/prod2.png" alt="">
                                            </a>
                                        </div>
                                        <div class="w-full flex flex-col gap-1 h-full">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h1 class="text-sm tracking-[2px]">CHECK WOOL SHIRT</h1>
                                                    <p class="text-sm">$175 USD</p>
                                                </div>
                                                <h1>
                                                    12/22/2022
                                                </h1>
                                            </div>
                                            <div class="flex flex-col justify-center items-start mb-10">
                                                <h1 class="text-sm font-semibold uppercase">Variation: <span>Blue</span></h1>
                                                <p class="before:content-['X'] before:mr-[2px] font-['Lato'] text-sm"><span class="text-[15px]">3</span></p>
                                            </div>
                                            <div class="flex justify-between items-start">
                                                <div class="flex gap-2">
                                                    <img class="w-5 h-5 object-contain" src="/nstudio/img/delivered.svg" alt="delivered">
                                                    <h1 class="font-semibold uppercase text-sm text-[#095d40]">Parcel had been delivered</h1>
                                                </div>
                                                <p>TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]">539</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Bottom -->
                                    <div class="w-full flex justify-end gap-3 uppercase">
                                        <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                                            <button class="text-sm w-full h-full bg-[#101010] text-white">Rate</button>
                                        </div>
                                        <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                                            <button class="text-sm w-full h-full">Contact Us</button>
                                        </div>
                                        <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                                            <button class="text-sm w-full h-full">Buy Again</button>
                                        </div>
                                    </div>
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