<?php

global $App;
global $userID;

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    header('location: /nstudio/login.php');
    exit;
}

require_once '../includes/THE_INITIALIZER.php';

?>

<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require_once './partials/head.php' ?>
<script src="../script/cart.js" defer></script>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php include './partials/loading.php' ?>
    <!-- Navbar -->
    <?php require_once './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="min-h-screen animate__animated fadeIn">
        <?php if ($cartCount = $App->store->cartCount($userID) > 0) : ?>
            <div class="container max-w-full h-full pt-[4rem] pb-[4rem] pl-[4rem] lg:pl-[2rem] md:pr-0 pr-4 md:pl-0 flex flex-row md:flex-col relative">
                <div class="flex flex-col md:items-center gap-10 md:gap-4 pt-4 pr-10 md:px-6 w-auto">
                    <div class="text-2xl text-[#505050] font-semibold self-start">
                        <h1 class="relative after:content-['(<?= $cartCount ?>)'] after:absolute after:top-[-3px] after:text-sm">
                            Your Bag
                        </h1>
                    </div>
                    <!-- Cart Products -->
                    <div class="container max-w-full flex flex-col gap-3">
                        <?php
                        $App->store->showCartProducts($userID);
                        $subtotal = $App->store->getCartSubtotal($userID);
                        ?>
                    </div>
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="popup-btn" class="hidden" type="button">
                        Toggle modal
                    </button>
                    <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 justify-center items-center w-full h-screen max-h-full shadow-sm backdrop-blur-sm">
                        <div class="relative mt-[10rem] mx-auto w-full max-w-md max-h-full">
                            <div class="relative rounded-lg shadow bg-white border">
                                <button id="closeBtn" type="button" class="absolute top-3 right-2.5 text-gray-400 hover:text-gray-500 active:text-gray-400 bg-transparent rounded-lg text-sm w-7 h-7 ml-auto inline-flex justify-center items-center hover:bg-white" data-modal-hide="popup-modal">
                                    <svg clas s="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this address?</h3>
                                    <button id="confirmBtn" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button id="cancelBtn" data-modal-hide="popup-modal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-800 focus:ring-gray-600">No,
                                        cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-5 w-[25rem] md:w-full md:px-[2rem] sm:px-[1rem] pt-4">
                    <div class="text-2xl text-[#505050] font-semibold">
                        <h1>Order Summary</h1>
                    </div>
                    <div class="flex flex-col gap-2 font-[Lato] text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>--</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Taxes</span>
                            <span>--</span>
                        </div>
                    </div>
                    <hr />
                    <div class="flex flex-col gap-2 font-[Lato]">
                        <div class="flex justify-between text-gray-600 font-semibold">
                            <h1>Subtotal</h1>
                            <span class="before:content-['₱'] before:mr-[2px]" id="subtotal"><?= @$subtotal ? $subtotal : "--" ?></span>
                        </div>
                        <span class="text-xs text-gray-400 leading-4 tracking-wide whitespace-nowrap sm:whitespace-normal">SHIPPING & TAXES CALCULATED AT CHECKOUT</span>
                        <div class="w-full h-10 mt-2">
                            <div class="w-full h-full bg-gray-900 text-white text-sm font-semibold flex justify-center items-center">
                                <a href="./checkout.php" class="w-full h-full flex justify-center items-center">
                                    CHECKOUT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="h-screen flex justify-center items-center">
                <h1 class="text-2xl bg-slate-200 p-6 rounded-lg">No item in cart.</h1>
            </div>
        <?php endif; ?>
    </main>
    <!-- Footer Section -->
    <?php require_once './partials/footer.php' ?>
</body>

</html>