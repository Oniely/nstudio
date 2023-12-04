<?php

require '../../includes/session.php';
require '../../includes/connection.php';
require '../../includes/functions.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

$provinceOptions = array(
    'Abra',
    'Agusan del Norte',
    'Agusan del Sur',
    'Aklan',
    'Albay',
    'Antique',
    'Apayao',
    'Aurora',
    'Basilan',
    'Bataan',
    'Batanes',
    'Batangas',
    'Benguet',
    'Biliran',
    'Bohol',
    'Bukidnon',
    'Bulacan',
    'Cagayan',
    'Camarines Norte',
    'Camarines Sur',
    'Camiguin',
    'Capiz',
    'Catanduanes',
    'Cavite',
    'Cebu',
    'Cotabato',
    'Davao del Sur',
    'Davao Oriental',
    'Dinagat Islands',
    'Eastern Samar',
    'Guimaras',
    'Ifugao',
    'Ilocos Norte',
    'Ilocos Sur',
    'Iloilo',
    'Isabela',
    'Kalinga',
    'La Union',
    'Laguna',
    'Lanao del Norte',
    'Lanao del Sur',
    'Leyte',
    'Maguindanao',
    'Marinduque',
    'Masbate',
    'Metro Manila',
    'Misamis Occidental',
    'Misamis Oriental',
    'Mountain Province',
    'Negros Occidental',
    'Negros Oriental',
    'Northern Samar',
    'Nueva Ecija',
    'Nueva Vizcaya',
    'Occidental Mindoro',
    'Oriental Mindoro',
    'Palawan',
    'Pampanga',
    'Pangasinan',
    'Quezon',
    'Quirino',
    'Rizal',
    'Romblon',
    'Sarangani',
    'Siquijor',
    'Sorsogon',
    'South Cotabato',
    'Southern Leyte',
    'Sultan Kudarat',
    'Sulu',
    'Surigao del Norte',
    'Surigao del Sur',
    'Tarlac',
    'Tawi-Tawi',
    'Zambales',
    'Zamboanga del Norte',
    'Zamboanga del Sur',
    'Zamboanga Sibugay'
);

?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require '../partials/head.php' ?>
<script src="../../script/address.js" defer></script>

<body class="min-h-screen">
    <!-- Navbar -->
    <?php require '../partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen h-full py-6">
        <div class="container min-h-screen pt-[4rem] px-[4rem] flex flex-col gap-7">
            <div class="pl-[10rem] text-[#505050]">
                <p class="uppercase text-sm">Account / Dashboard / Address</p>
                <h1 class="uppercase text-4xl font-semibold tracking-wider">Your Address</h1>
            </div>

            <div class="flex items-start w-full">
                <div class="flex flex-col justify-start items-start gap-1 pt-[3.1rem]">
                    <h1 class="text-xl font-semibold px-2">Account</h1>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="dashboard.php">Dashboard</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="profile.php">Profile</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100 0 font-medium underline" href="address.php">Address</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="/nstudio/includes/logout.php">Logout</a>
                </div>
                <div class="container h-auto pl-10">
                    <h1 class="text-2xl py-2 invisible">Your Address</h1>

                    <div class="w-full h-auto flex flex-col justify-center items-start gap-10">
                        <div class="w-full h-auto flex flex-col items-start gap-5">
                            <!-- Address Container -->
                            <div class="w-full h-full flex flex-wrap justify-start items-center gap-10">
                                <!-- Addresses -->
                                <?php showUserAddress($userID) ?>
                            </div>

                            <button id="addressBtn" class="uppercase w-[19rem] py-3 px-14 text-center bg-[#101010] text-white hover:text-[#101010] hover:bg-white text-sm border-solid border border-b transition-colors delay-75 ease-in-out">ADD NEW ADDRESS</button>
                            <!-- Main modal -->
                            <div id="addressModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-scroll overflow-x-hidden absolute container top-[3rem] right-0 left-0 z-50 justify-center items-center inset-0 h-[calc(100%-2rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative rounded-lg shadow bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between md:p-4 p-5 rounded-t border-gray-600">
                                            <h3 class="text-lg font-semibold text-white">
                                                Add New Address
                                            </h3>
                                            <button type="button" id="closeAddressBtn" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form class="p-4 md:p-5" method="POST">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="country" class="block mb-2 text-sm font-medium text-white">Country</label>
                                                    <select id="country" name="country" class="border text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500">
                                                        <option selected>Philippines</option>
                                                    </select>
                                                </div>
                                                <div class="col-span-1">
                                                    <label for="fname" class="block mb-2 text-sm font-medium text-white">First Name</label>
                                                    <input type="text" name="fname" id="fname" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Your First Name" required="">
                                                </div>
                                                <div class="col-span-1">
                                                    <label for="lname" class="block mb-2 text-sm font-medium text-white">Last Name</label>
                                                    <input type="text" name="lname" id="lname" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Your Last Name" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                                                    <input type="email" name="email" id="email" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Email Address" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="street_name" class="block mb-2 text-sm font-medium text-white">Address</label>
                                                    <input type="text" name="street_name" id="street_name" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Address / Street Name" required="">
                                                </div>
                                                <div class="col-span-1">
                                                    <label for="pcode" class="block mb-2 text-sm font-medium text-white">Postal Code</label>
                                                    <input type="text" name="pcode" id="pcode" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Postal Code / Zip Code" required="">
                                                </div>
                                                <div class="col-span-1">
                                                    <label for="city" class="block mb-2 text-sm font-medium text-white">City</label>
                                                    <input type="text" name="city" id="city" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Your City" required="">
                                                </div>
                                                <div class="col-span-1">
                                                    <label for="province" class="block mb-2 text-sm font-medium text-white">Province</label>
                                                    <select name="province" id="province" class="g-gray-50 border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" required>
                                                        <option value="" disabled hidden selected>Select Your Province</option>
                                                        <?php foreach ($provinceOptions as $pOption) : ?>
                                                            <option class="text-white" value="<?= $pOption ?>">
                                                                <?php echo $pOption; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-span-1">
                                                    <label for="contact_number" class="block mb-2 text-sm font-medium text-white">Contact Number</label>
                                                    <input type="text" name="contact_number" id="contact_number" class="border text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white focus:ring-primary-500 focus:border-primary-500" placeholder="Your Last Name" required="">
                                                </div>
                                                <div class="flex items-center col-span-2">
                                                    <input id="defaultAddress" name="defaultAddress" type="checkbox" value="" class="w-4 h-4 text-blue-600 rounded focus:ring-2 bg-gray-700 border-gray-600 ring-offset-gray-800 focus:ring-blue-600 focus:ring-offset-gray-800">
                                                    <label for="defaultAddress" class="ms-2 text-sm font-medium text-gray-300">Set as default address</label>
                                                </div>
                                            </div>
                                            <button type="button" id="addNewAddressBtn" class="inline-flex text-white items-center bg-[#1010106b] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Add new address
                                            </button>
                                            <button type="button" id="updateAddressBtn" class="hidden text-white items-center bg-[#1010106b] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Update Address
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Confirm Delete Address Modal -->
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="popup-btn" class="hidden" type="button">
                        Toggle modal
                    </button>
                    <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 justify-center items-center w-full h-screen max-h-full">
                        <div class="relative mt-[10rem] mx-auto w-full max-w-md max-h-full">
                            <div class="relative rounded-lg shadow bg-gray-700">
                                <button id="closeBtn" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="popup-modal">
                                    <svg clas s="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg class="mx-auto mb-4 w-12 h-12 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-400">Are you sure you want to delete this address?</h3>
                                    <button id="confirmBtn" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                    <button id="cancelBtn" data-modal-hide="popup-modal" type="button" class="focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                                        cancel</button>
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