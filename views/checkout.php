<?php

session_start();

require "../includes/connection.php";
require "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $profile_img = $row['image_path'];
} else {
    header('location: /nstudio/login.php');
    exit;
}

if (checkAddressDefault($userID)) {
    $address_id = addressDefault($userID);

    $sql = "SELECT * FROM address_tbl WHERE id = '$address_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $street_name = $row['street_name'];
        $pcode = $row['postal_code'];
        $city = $row['city'];
        $province = $row['province'];
        $contact_number = $row['contact_number'];
    } else {
        echo "Error: $conn->connect_error";
    }
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
<html lang="en" class="scroll-smooth">
<!-- Head -->
<?php require './partials/head.php' ?>
<script src="../script/checkout.js" defer></script>

<body>
    <!-- Loading Screen -->
    <?php require_once './partials/loading.php' ?>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen animate__animated fadeIn">
        <div class="container max-w-full min-h-screen py-[4rem] md:pt-[1rem] px-[3rem] md:px-[2rem] sm:px-[1rem] flex flex-row md:flex-col-reverse relative">
            <form action="/nstudio/includes/payment.php" method="POST" class="w-full flex flex-col items-center p-3 pr-5 md:pr-1 md:p-1 md:mt-[2rem]">
                <div class="flex flex-col w-full">
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-medium">Contact</h1>
                        <div class="relative z-0 w-full mb-5 mt-5 group border rounded">
                            <input value="<?= @$email ?>" name="email" type="email" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                        </div>

                        <div class="flex flex-col overflow-x-hidden text-ellipsis">
                            <h1 class="text-3xl font-medium">Delivery</h1>

                            <div class="relative z-0 w-full mb-5 mt-5 group border rounded">
                                <select name="country" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                    <option value="Philippines" selected>
                                        Philippines
                                    </option>
                                </select>
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Country/Region</label>
                            </div>

                            <div class="flex flex-row gap-8">
                                <div class="relative z-0 w-full mb-5 mt-3 group border rounded">
                                    <input value="<?= @$fname ?>" name="fname" type="text" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First Name</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 mt-3 group border rounded">
                                    <input value="<?= @$lname ?>" name="lname" type="text" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last Name</label>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group border rounded text-ellipsis">
                                <input value="<?= @$street_name ?>" name="street_name" type="text" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 whitespace-nowrap overflowx text-ellipsis">(Address/Street Name/Building/House Number, Subdivision/Village, Barangay, City)</label>
                            </div>

                            <div class="flex flex-row gap-8">
                                <div class="relative z-0 w-full mb-5 mt-3 group border rounded">
                                    <input value="<?= @$pcode ?>" name="pcode" type="text" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Postal code</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 mt-3 group border rounded">
                                    <input value="<?= @$city ?>" name="city" type="text" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">City</label>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group border rounded">
                                <select value="<?= @$province ?>" name="province" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                                    <option value="" disabled hidden <?= @$province ? 'selected' : '' ?>>- Select your province -</option>
                                    <?php foreach ($provinceOptions as $pOption) : ?>
                                        <option value="<?php echo $pOption; ?>" <?= (isset($province) && $province == $pOption) ? 'selected' : '' ?>>
                                            <?php echo $pOption; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Province</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group border rounded">
                                <input value="<?= @$contact_number ?>" name="contact_number" type="text" class="block py-3 px-1 w-full text-sm text-[#101010] bg-transparent border-0 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 bg-white duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                            </div>
                            <div class="flex items-center ps-4 border border-gray-200 rounded text-[15px]">
                                <input type="checkbox" name="save" id="save" class="w-4 h-4 text-blue-600 border-gray-300">
                                <label for="save" class="w-full py-4 ms-2 text-[#101010]">Save this information for next time</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col w-full mt-5 text-[15px]">
                    <h1 class="text-2xl font-medium">Shipping Method</h1>
                    <div class="flex justify-between items-center border px-4 py-4 mt-3 rounded-md">
                        <span>Standard</span>
                        <span class="before:content-['₱']">120.00</span>
                    </div>
                </div>

                <div class="flex flex-col w-full mt-5 gap-2">
                    <h1 class="text-2xl font-medium">Payment</h1>
                    <span>All transaction are secure and encrypted.</span>
                    <ul class="items-center w-full text-sm font-medium text-white bg-white border border-gray-200 rounded-lg flex text-[15px]">
                        <li class="w-full border-gray-200 border-b-0 border-r ">
                            <div class="flex items-center ps-3">
                                <input id="CASH ON DELIVERY" type="radio" value="CASH ON DELIVERY" name="payment_method" class="w-4 h-4 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" required>
                                <label for="CASH ON DELIVERY" class="w-full h-full py-4 ms-2 text-[#101010] cursor-pointer">Cash on Delivery</label>
                            </div>
                        </li>
                        <li class="w-full border-gray-200 border-b-0 border-r ">
                            <div class="flex items-center ps-3">
                                <input id="GCASH" type="radio" value="GCASH" name="payment_method" class="w-4 h-4 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" required>
                                <label for="GCASH" class="w-full h-full py-4 ms-2 text-[#101010] cursor-pointer">GCash</label>
                            </div>
                        </li>
                        <li class="w-full border-gray-200 border-b-0">
                            <div class="flex items-center ps-3">
                                <input id="CREDIT" type="radio" value="CREDIT CARD" name="payment_method" class="w-4 h-4 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" required>
                                <label for="CREDIT" class="w-full h-full py-4 ms-2 text-[#101010] cursor-pointer">Credit Card</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- BUTTONS -->
                <div class="flex flex-col w-full mt-5">
                    <input type="submit" name="pay" class="bg-[#101010] text-white hover:text-[#101010] hover:bg-white active:bg-[#eee] text-[14px] uppercase h-[2.8rem] rounded border cursor-pointer text-center transition-colors delay-[20ms] ease-linear" value="Pay Now">
                </div>
            </form>

            <div id="products" class="container max-w-full h-fit flex flex-col gap-3 sticky md:relative md:mb-[2rem] top-[3rem] right-0 pb-4 transition-all delay-75 ease-linear overflow-hidden max-h-[100vh]">
                <div class="overflow-y-auto transition-all delay-75 ease-linear">
                    <!-- Product -->
                    <?php
                    if (isset($_GET['item']) && $_GET['item'] != "" && isset($_GET['colour']) && isset($_GET['size'])) {
                        $item_id = $_GET['item'];
                        $colour_id = $_GET['colour'];
                        $size_id = $_GET['size'];

                        $subtotal = showBuyNowProduct($item_id, $colour_id, $size_id);
                    } else {
                        $subtotal = showCheckOutProducts($userID);
                    }

                    $_SESSION['total'] = $subtotal + 120;
                    $shipping = 120;

                    ?>
                </div>
                <!-- COST -->
                <div class="flex flex-col gap-3 text-[15px] uppercase">
                    <div class="flex flex-row justify-between">
                        <span>Subtotal</span>
                        <span class="before:content-['₱']"><?= $subtotal ?></span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Shipping</span>
                        <span class="before:content-['₱']">120.00</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Total</span>
                        <span class="before:content-['₱']"><?= $subtotal + $shipping ?></span>
                    </div>
                </div>
            </div>
            <!-- end -->
            <div class="md:flex sticky top-[3rem] left-0 hidden justify-between items-center w-full h-14 bg-white border-b">
                <button id="showProducts" class="flex justify-center items-center h-full">
                    <span class="mr-3 text-sm">Show Order Summary</span>
                    <svg id="arrow" class="rotate-180" xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                    </svg>
                </button>
                <h1 class="before:content-['₱']"><?= $subtotal + $shipping ?></h1>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>