<?php

require_once '../includes/session.php';

require_once "../includes/connection.php";
require_once "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    header('location: /nstudio/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require './partials/head.php' ?>

<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen">
        <div class="container max-w-full min-h-screen py-[4rem] px-[4rem] flex flex-row md:flex-col-reverse">
            <div class="flex flex-col items-center w-fit p-4">
                <form action="" class="flex flex-col w-[40rem]">
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-medium">Contact</h1>
                        <div class="relative z-0 w-full mb-5 mt-5 group">
                            <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                        </div>

                        <div class="flex flex-col">
                            <h1 class="text-3xl font-medium">Delivery</h1>

                            <div class="relative z-0 w-full mb-5 mt-5 group">
                                <select type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                                    <option value="Philippines" selected>
                                        Philippines
                                    </option>
                                </select>
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Country/Region</label>
                            </div>

                            <div class="flex flex-row gap-8">
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First Name</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last Name</label>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group">
                                <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Address / Street Name</label>
                            </div>

                            <div class="flex flex-row gap-8">
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Postal code</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">City</label>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group">
                                <select type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
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
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Province</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group">
                                <input type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-0 group">
                                <input type="checkbox" name="save" id="save" />
                                <label for="save">Save this information for next
                                    time</label>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="flex flex-col w-[40rem] mt-5">
                    <h1 class="text-2xl font-medium">Shipping Method</h1>
                    <div class="flex justify-between items-center border px-4 py-4 mt-3 rounded-md">
                        <span>Standard</span>
                        <span class="before:content['₱_']">140.00</span>
                    </div>
                </div>

                <div class="flex flex-col w-[40rem] mt-5">
                    <h1 class="text-2xl font-medium">Payment</h1>
                    <span>All transaction are secure and encrypted.</span>
                    <div>
                        <input type="radio" />
                        <label for="">Cash On Delivery</label>
                    </div>
                </div>

                <div class="flex flex-col w-[40rem] mt-5">
                    <button class="bg-[#101010] text-white py-4 cursor-pointer">
                        Pay Now
                    </button>
                </div>
            </div>

            <div class="container max-w-full flex flex-col gap-3">
                <?php $subtotal = showCheckOutProducts($userID) ?>
                <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-between">
                        <span>Subtotal</span>
                        <span class="before:content-['₱_']"><?php echo $subtotal ?></span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Shipping</span>
                        <span class="before:content-['₱_']">140.00</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Total</span>
                        <span class="before:content-['₱_']"><?php echo $subtotal + 140 ?></span>
                    </div>
                </div>

            </div>
    </main>
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>

</html>