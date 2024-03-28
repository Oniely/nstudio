<?php

session_start();
require_once '../../includes/THE_INITIALIZER.php';

require_once '../../includes/connection.php';
require_once "../../includes/THE_DASHBOARD.php";

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

$purchases = true;

?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require '../partials/head.php' ?>
<script src="/nstudio/script/purchases.js" defer></script>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php include '../partials/loading.php' ?>
    <!-- Navbar -->
    <?php require '../partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen h-full pt-6 pb-10 lgt:pb-14 animate__animated fadeIn">
        <div class="container min-h-screen pt-[4rem] px-[4rem] lgt:px-[2rem] sm:px-[1rem] flex flex-col gap-7 relative overflow-hidden">
            <div class="pl-[10rem] lgt:pl-0 text-[#505050]">
                <p class="uppercase text-sm">Account / Dashboard / Purchases</p>
                <h1 class="capitalize text-4xl font-semibold tracking-wider">Welcome Back, <span><?= $fname ?></span>!</h1>
                <div class="lgt:flex w-full hidden"><?php require 'nav.php' ?></div>
            </div>
            <div class="flex items-start">
                <!-- Dashboard Nav -->
                <div class="lgt:hidden"><?php require 'nav.php' ?></div>
                <!-- MAIN -->
                <div class="container h-auto pl-10 lgt:pl-0">
                    <h1 class="text-2xl py-2">Purchase History</h1>
                    <!-- MAIN CONTAINER -->
                    <div class="w-full flex flex-col justify-center items-center border">
                        <!-- BUTTONS -->
                        <?php
                        $payCount = orderCount($userID, 'TO PAY');
                        $shipCount = orderCount($userID, 'TO SHIP', 'SHIPPED');
                        $receiveCount = orderCount($userID, 'TO RECEIVE', 'DELIVERED');
                        $completedCount = orderCount($userID, 'COMPLETED');
                        $cancelledCount = orderCount($userID, 'CANCELLED');
                        ?>
                        <div class="w-full flex h-[3rem] border-b text-[15px] md:text-sm xs:gap-1 xs:px-1">
                            <div class="w-full h-full hover:border-b-2 active:border-b relative border-b-2">
                                <button id="toPay" class="w-full h-full relative after:content-[<?= $payCount != 0 ? "'$payCount'" : "" ?>] after:absolute md:after:top-0 md:after:right-1 sm:after:right-0 after:top-3 after:right-4 after:flex after:justify-center after:items-center md:after:w-4 md:after:h-4 after:w-5 after:h-5 after:bg-red-400 after:rounded-full after:text-xs">To pay</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b relative">
                                <button id="toShip" class="w-full h-full relative after:content-[<?= $shipCount != 0 ? "'$shipCount'" : "" ?>] after:absolute md:after:top-0 md:after:right-1 sm:after:right-0 after:top-3 after:right-4 after:flex after:justify-center after:items-center md:after:w-4 md:after:h-4 after:w-5 after:h-5 after:bg-red-400 after:rounded-full after:text-xs">To ship</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b relative">
                                <button id="toReceive" class="w-full h-full relative after:content-[<?= $receiveCount != 0 ? "'$receiveCount'" : "" ?>] after:absolute md:after:top-0 md:after:right-1 sm:after:right-0 after:top-3 after:right-4 after:flex after:justify-center after:items-center md:after:w-4 md:after:h-4 after:w-5 after:h-5 after:bg-red-400 after:rounded-full after:text-xs">To receive</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b relative">
                                <button id="completedBtn" class="w-full h-full relative after:content-[<?= $completedCount != 0 ? "'$completedCount'" : "" ?>] after:absolute md:after:top-0 md:after:right-1 sm:after:right-0 after:top-3 after:right-4 after:flex after:justify-center after:items-center md:after:w-4 md:after:h-4 after:w-5 after:h-5 after:bg-red-400 after:rounded-full after:text-xs">Completed</button>
                            </div>
                            <div class="w-full h-full hover:border-b-2 active:border-b relative">
                                <button id="cancelledBtn" class="w-full h-full relative after:content-[<?= $cancelledCount != 0 ? "'$cancelledCount'" : "" ?>] after:absolute md:after:top-0 md:after:right-1 sm:after:right-0 after:top-3 after:right-4 after:flex after:justify-center after:items-center md:after:w-4 md:after:h-4 after:w-5 after:h-5 after:bg-red-400 after:rounded-full after:text-xs">Cancelled</button>
                            </div>
                        </div>
                        <!-- Product Container -->
                        <div id="productContainer" class="w-full h-auto flex gap-10 pt-[3rem] pb-[2rem] px-[3rem] md:px-[1rem] sm:px-2">
                            <!-- To Pay Products -->
                            <div id="toPayProducts" class="flex w-full h-auto flex-col justify-center items-start gap-10">
                                <!-- Products -->
                                <?php showToPayOrder($userID) ?>
                            </div>
                            <!-- To Ship Products -->
                            <div id="toShipProducts" class="hidden w-full h-auto flex-col justify-center items-start gap-10">
                                <!-- Products -->
                                <?php showToShipOrders($userID) ?>
                            </div>
                            <!-- To Receive Products -->
                            <div id="toReceiveProducts" class="hidden w-full h-auto flex-col justify-center items-start gap-10">
                                <!-- Products -->
                                <?php showToReceiveOrders($userID) ?>
                            </div>
                            <!-- Completed Products -->
                            <div id="completedProducts" class="hidden w-full h-auto flex-col justify-center items-start gap-10">
                                <!-- Products -->
                                <?php showCompletedProducts($userID) ?>
                            </div>
                            <!-- Cancelled Products -->
                            <div id="cancelledProducts" class="hidden w-full h-auto flex-col justify-center items-start gap-10">
                                <!-- Products -->
                                <?php showCancelledOrders($userID) ?>
                            </div>
                        </div>
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="popup-btn" class="hidden" type="button">
                            Toggle modal
                        </button>
                        <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 justify-center items-center w-full h-screen max-h-full shadow-sm backdrop-blur-sm">
                            <div class="relative mt-[10rem] mx-auto w-full max-w-md max-h-full">
                                <div class="relative-lg shadow bg-white border rounded-lg">
                                    <button id="closeBtn" type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-gray-500 active:text-gray-400 bg-transparent-lg text-sm w-7 h-7 ml-auto inline-flex justify-center items-center hover:bg-white" data-modal-hide="popup-modal">
                                        <svg clas s="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to cancel your order?</h3>
                                        <button id="confirmBtn" type="button" class="text-white rounded-lg bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, I'm sure
                                        </button>
                                        <button id="cancelBtn" data-modal-hide="popup-modal" type="button" class="focus:ring-4 rounded-lg focus:outline-none-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-800 focus:ring-gray-600">No,
                                            cancel</button>
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