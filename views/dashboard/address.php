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
<script src="../../script/address.js" defer></script>

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
                    <h1 class="text-2xl py-2">Address</h1>

                    <div class="w-full h-[13rem] flex flex-col items-start">
                        <div class="w-full h-full flex justify-start items-center">
                            <p class="text-sm">You don't have an address added yet.</p>
                        </div>

                        <button id="addressBtn" class="uppercase py-3 px-14 text-center bg-[#101010] text-white text-sm">ADD NEW ADDRESS</button>
                        <!-- Main modal -->
                        <div id="addressModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden absolute container top-[3rem] right-0 left-0 z-50 justify-center items-center inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between md:p-4 p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add New Address
                                        </h3>
                                        <button type="button" id="closeAddressBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5">
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                                <select id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected>Philippines</option>
                                                </select>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                                <input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your First Name" required="">
                                            </div>
                                            <div class="col-span-1">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                                <input type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your Last Name" required="">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="street_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                                <input type="text" name="street_name" id="street_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Address / Street Name" required="">
                                            </div>
                                            <div class="col-span-1">
                                                <label for="pcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal Code</label>
                                                <input type="text" name="pcode" id="pcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Postal Code / Zip Code" required="">
                                            </div>
                                            <div class="col-span-1">
                                                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                                <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your City" required="">
                                            </div>
                                            <div class="col-span-1">
                                                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                                <select id="province" name="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option class="text-gray-400" selected hidden disabled>Select your province</option>
                                                    <option value="" selected disabled hidden>- Select your province -</option>
                                                    <option value="ABRA">Abra</option>
                                                    <option value="AGUSAN-DEL-NORTE">
                                                        Agusan del Norte
                                                    </option>
                                                    <option value="AGUSAN-DEL-SUR">
                                                        Agusan del Sur
                                                    </option>
                                                    <option value="AKLAN">Aklan</option>
                                                    <option value="ALBAY">Albay</option>
                                                    <option value="ANTIQUE">Antique</option>
                                                    <option value="APAYAO">Apayao</option>
                                                    <option value="AURORA">Aurora</option>
                                                    <option value="BASILAN">Basilan</option>
                                                    <option value="BATAAN">Bataan</option>
                                                    <option value="BATANES">Batanes</option>
                                                    <option value="BATANGAS">
                                                        Batangas
                                                    </option>
                                                    <option value="BENGUET">Benguet</option>
                                                    <option value="BILIRAN">Biliran</option>
                                                    <option value="BOHOL">Bohol</option>
                                                    <option value="BUKIDNON">
                                                        Bukidnon
                                                    </option>
                                                    <option value="BULACAN">Bulacan</option>
                                                    <option value="CAGAYAN">Cagayan</option>
                                                    <option value="CAMARINES-NORTE">
                                                        Camarines Norte
                                                    </option>
                                                    <option value="CAMARINES-SUR">
                                                        Camarines Sur
                                                    </option>
                                                    <option value="CAMIGUIN">
                                                        Camiguin
                                                    </option>
                                                    <option value="CAPIZ">Capiz</option>
                                                    <option value="CATANDUANES">
                                                        Catanduanes
                                                    </option>
                                                    <option value="CAVITE">Cavite</option>
                                                    <option value="CEBU">Cebu</option>
                                                    <option value="COTABATO">
                                                        Cotabato
                                                    </option>
                                                    <option value="DAVAO-DE-L-SUR">
                                                        Davao del Sur
                                                    </option>
                                                    <option value="DAVAO-ORIENTAL">
                                                        Davao Oriental
                                                    </option>
                                                    <option value="DINAGAT-ISLANDS">
                                                        Dinagat Islands
                                                    </option>
                                                    <option value="EASTERN-SAMAR">
                                                        Eastern Samar
                                                    </option>
                                                    <option value="GUIMARAS">
                                                        Guimaras
                                                    </option>
                                                    <option value="IFUGAO">Ifugao</option>
                                                    <option value="ILOCOS-NORTE">
                                                        Ilocos Norte
                                                    </option>
                                                    <option value="ILOCOS-SUR">
                                                        Ilocos Sur
                                                    </option>
                                                    <option value="ILOILO">Iloilo</option>
                                                    <option value="ISABELA">Isabela</option>
                                                    <option value="KALINGA">Kalinga</option>
                                                    <option value="LA-UNION">
                                                        La Union
                                                    </option>
                                                    <option value="LAGUNA">Laguna</option>
                                                    <option value="LANAO-DEL-NORTE">
                                                        Lanao del Norte
                                                    </option>
                                                    <option value="LANAO-DEL-SUR">
                                                        Lanao del Sur
                                                    </option>
                                                    <option value="LEYTE">Leyte</option>
                                                    <option value="MAGUINDANAO">
                                                        Maguindanao
                                                    </option>
                                                    <option value="MARINDUQUE">
                                                        Marinduque
                                                    </option>
                                                    <option value="MASBATE">Masbate</option>
                                                    <option value="METRO-MANILA">
                                                        Metro Manila
                                                    </option>
                                                    <option value="MISAMIS-OCCIDENTAL">
                                                        Misamis Occidental
                                                    </option>
                                                    <option value="MISAMIS-ORIENTAL">
                                                        Misamis Oriental
                                                    </option>
                                                    <option value="MOUNTAIN-PROVINCE">
                                                        Mountain Province
                                                    </option>
                                                    <option value="NEGROS-OCCIDENTAL">
                                                        Negros Occidental
                                                    </option>
                                                    <option value="NEGROS-ORIENTAL">
                                                        Negros Oriental
                                                    </option>
                                                    <option value="NORTHERN-SAMAR">
                                                        Northern Samar
                                                    </option>
                                                    <option value="NUEVA-ECIJA">
                                                        Nueva Ecija
                                                    </option>
                                                    <option value="NUEVA-VIZCAYA">
                                                        Nueva Vizcaya
                                                    </option>
                                                    <option value="OCCIDENTAL-MINDORO">
                                                        Occidental Mindoro
                                                    </option>
                                                    <option value="ORIENTAL-MINDORO">
                                                        Oriental Mindoro
                                                    </option>
                                                    <option value="PALAWAN">Palawan</option>
                                                    <option value="PAMPANGA">
                                                        Pampanga
                                                    </option>
                                                    <option value="PANGASINAN">
                                                        Pangasinan
                                                    </option>
                                                    <option value="QUEZON">Quezon</option>
                                                    <option value="QUIRINO">Quirino</option>
                                                    <option value="RIZAL">Rizal</option>
                                                    <option value="ROMBLON">Romblon</option>
                                                    <option value="SARANGANI">
                                                        Sarangani
                                                    </option>
                                                    <option value="SIQUIJOR">
                                                        Siquijor
                                                    </option>
                                                    <option value="SORSOGON">
                                                        Sorsogon
                                                    </option>
                                                    <option value="SOUTH-COTABATO">
                                                        South Cotabato
                                                    </option>
                                                    <option value="SOUTHERN-LEYTE">
                                                        Southern Leyte
                                                    </option>
                                                    <option value="SULTAN-KUDARAT">
                                                        Sultan Kudarat
                                                    </option>
                                                    <option value="SULU">Sulu</option>
                                                    <option value="SURIGAO-DEL-NORTE">
                                                        Surigao del Norte
                                                    </option>
                                                    <option value="SURIGAO-DEL-SUR">
                                                        Surigao del Sur
                                                    </option>
                                                    <option value="TARLAC">Tarlac</option>
                                                    <option value="TAWI-TAWI">
                                                        Tawi-Tawi
                                                    </option>
                                                    <option value="ZAMBALES">
                                                        Zambales
                                                    </option>
                                                    <option value="ZAMBOANGA-DEL-NORTE">
                                                        Zamboanga del Norte
                                                    </option>
                                                    <option value="ZAMBOANGA-DEL-SUR">
                                                        Zamboanga del Sur
                                                    </option>
                                                    <option value="ZAMBOANGA-SIBUGAY">
                                                        Zamboanga Sibugay
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="contact_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                                                <input type="text" name="contact_number" id="contact_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your Last Name" required="">
                                            </div>
                                            <div class="flex items-center col-span-2">
                                                <input id="default" name="default" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="default" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Set as default address</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="text-white inline-flex items-center bg-[#1010106b] focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Add new address
                                        </button>
                                    </form>
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