<?php

session_start();
require_once '../includes/THE_INITIALIZER.php';

if (isset($_GET['id']) && isset($_GET['colour'])) {
    $product_id = $_GET['id'];
    $colour_id = $_GET['colour'];

    // needed for add_to_cart.php
    $_SESSION['product_id'] = $product_id;
}

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<!-- Head -->
<?php require_once './partials/head.php' ?>
<script src="../script/product.js" defer></script>
<!-- Body -->

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php include './partials/loading.php' ?>
    <!-- Navbar -->
    <?php require_once './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="min-h-screen animate__animated fadeIn" id="main">
        <?php $App->store->viewProduct($product_id, $colour_id) ?>
        <!-- size guide modal -->
        <div id="sizeModal" class="fixed top-[1.5rem] m-auto backdrop-blur-sm z-10 container h-full bg-transparent hidden place-items-center">
            <!-- Using the w-full to make it responsive in all size and adding max-w-50rem to limit its size on bigger screen -->
            <div class="w-full max-w-[40rem] bg-white border p-10 text-[15px] relative">
                <button type="button" id="closeSizeBtn" class="absolute top-5 right-10 w-5 h-5 text-xl">
                    <img src="https://www.svgrepo.com/show/365893/x-thin.svg" alt="X">
                </button>
                <div class="flex flex-col">
                    <p class="py-2">
                        Please refer to the product
                        description for specific garment
                        measurements
                    </p>
                    <h1 class="font-medium py-4">
                        BODY MEASUREMENTS
                    </h1>
                    <div class="flex flex-col items-end gap-10">
                        <div class="flex gap-1 font-medium">
                            <button type="button" id="inchesBtn" class="underline">
                                INCHES
                            </button>
                            <span>-</span>
                            <button type="button" id="cmBtn">CM</button>
                        </div>
                        <div>
                            <table class="table-fixed border-collapse w-full">
                                <thead>
                                    <tr class="bg-[#eeeeee]">
                                        <th class="p-2 font-normal border-r border-black text-start">
                                            SIZE
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            XS
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            S
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            M
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            L
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            XL
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            XXL
                                        </th>
                                    </tr>
                                    <tr class="bg-[#eeeeee]">
                                        <th class="p-2 font-normal border-r border-black text-start">
                                            EU
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            32
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            34
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            36
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            38
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            40
                                        </th>
                                        <th class="p-2 font-normal border-r border-black">
                                            44
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td class="p-2 border-r border-black text-start">
                                            UK
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            6
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            8
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            10
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            14
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            18
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            20
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="p-2 border-r border-black text-start">
                                            FR
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            34
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            36
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            38
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            42
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            46
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            48
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="p-2 border-r border-black text-start">
                                            IT
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            38
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            40
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            42
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            46
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            50
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            54
                                        </td>
                                    </tr>
                                    <tr class="text-center chestInches">
                                        <td class="p-2 border-r border-black text-start">
                                            Chest
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            29.9"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            31.5"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            33.1"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            34.6"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            36.2"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            37.5"
                                        </td>
                                    </tr>
                                    <tr class="hidden text-center chestCm">
                                        <td class="p-2 border-r border-black text-start">
                                            Chest
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            76cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            80cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            84cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            88cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            92cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            96cm
                                        </td>
                                    </tr>
                                    <tr class="text-center waistInches">
                                        <td class="p-2 border-r border-black text-start">
                                            Waist
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.6"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            25.2"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            26.8"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            29.9"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            31.5"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            33.5"
                                        </td>
                                    </tr>
                                    <tr class="hidden text-center waistCm">
                                        <td class="p-2 border-r border-black text-start">
                                            Waist
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            60cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            64cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            68cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            72cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            76cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            80cm
                                        </td>
                                    </tr>
                                    <tr class="text-center armInches">
                                        <td class="p-2 border-r border-black text-start">
                                            Arm Length
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.5"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.5"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.5"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.6"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.7"
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            23.8"
                                        </td>
                                    </tr>
                                    <tr class="hidden text-center armCm">
                                        <td class="p-2 border-r border-black text-start">
                                            Arm Length
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            59.6cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            59.6cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            59.8cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            60cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            60.2cm
                                        </td>
                                        <td class="p-2 border-r border-black">
                                            60.6cm
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer Section -->
    <?php require_once './partials/footer.php' ?>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>