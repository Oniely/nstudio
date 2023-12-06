<?php

require '../includes/session.php';

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
<html lang="en">
<!-- Head -->
<?php require './partials/head.php' ?>

<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen">
        <div class="container max-w-full min-h-screen py-[4rem] px-[4rem] flex flex-row md:flex-col-reverse">
            <form action="/nstudio/includes/payment.php" method="POST" class="flex flex-col items-center w-fit p-4">
                <div class="flex flex-col w-[40rem]">
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-medium">Contact</h1>
                        <div class="relative z-0 w-full mb-5 mt-5 group">
                            <input value="<?= @$email ?>" name="email" type="email" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                        </div>

                        <div class="flex flex-col">
                            <h1 class="text-3xl font-medium">Delivery</h1>

                            <div class="relative z-0 w-full mb-5 mt-5 group">
                                <select name="country" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                    <option value="Philippines" selected>
                                        Philippines
                                    </option>
                                </select>
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Country/Region</label>
                            </div>

                            <div class="flex flex-row gap-8">
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input value="<?= @$fname ?>" name="fname" type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First Name</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input value="<?= @$lname ?>" name="lname" type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last Name</label>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group">
                                <input value="<?= @$street_name ?>" name="street_name" type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">(Address/Street Name/Building/House Number, Subdivision/Village, Barangay, City)</label>
                            </div>

                            <div class="flex flex-row gap-8">
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input value="<?= @$pcode ?>" name="pcode" type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Postal code</label>
                                </div>
                                <div class="relative z-0 w-full mb-5 mt-3 group">
                                    <input value="<?= @$city ?>" name="city" type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">City</label>
                                </div>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group">
                                <select value="<?= @$province ?>" name="province" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                                    <option value="" disabled hidden <?= @$province ? 'selected' : '' ?>>- Select your province -</option>
                                    <?php foreach ($provinceOptions as $pOption) : ?>
                                        <option value="<?php echo $pOption; ?>" <?= (isset($province) && $province == $pOption) ? 'selected' : '' ?>>
                                            <?php echo $pOption; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Province</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-3 group">
                                <input value="<?= @$contact_number ?>" name="contact_number" type="text" class="block py-3 px-1 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 left-1 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone</label>
                            </div>

                            <div class="relative z-0 w-full mb-5 mt-0 group">
                                <input type="checkbox" name="save" id="save" />
                                <label for="save">Save this information for next time</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col w-[40rem] mt-5">
                    <h1 class="text-2xl font-medium">Shipping Method</h1>
                    <div class="flex justify-between items-center border px-4 py-4 mt-3 rounded-md">
                        <span>Standard</span>
                        <span class="before:content['₱_']">120.00</span>
                    </div>
                </div>

                <div class="flex flex-col w-[40rem] mt-5">
                    <h1 class="text-2xl font-medium">Payment</h1>
                    <span>All transaction are secure and encrypted.</span>
                    <div>
                        <input name="payment_method" type="radio" value="CASH ON DELIVERY" required />
                        <label for="">Cash On Delivery</label>
                    </div>
                </div>

                <div class="flex flex-col w-[40rem] mt-5">
                    <input type="submit" name="pay" class="bg-[#101010] text-white py-4 cursor-pointer text-center" value="Pay Now">
                </div>
            </form>

            <div class="container max-w-full flex flex-col gap-3">
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

                ?>
                <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-between">
                        <span>Subtotal</span>
                        <span class="before:content-['₱_']"><?php echo $subtotal ?></span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Shipping</span>
                        <span class="before:content-['₱_']">120.00</span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <span>Total</span>
                        <span class="before:content-['₱_']"><?php echo $subtotal + 120 ?></span>
                    </div>
                </div>

            </div>
    </main>
    <!-- Footer -->
    <?php require './partials/footer.php' ?>
</body>

</html>