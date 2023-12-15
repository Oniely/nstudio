<?php

session_start();

require_once "../includes/connection.php";
require_once "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $profile_img = $row['image_path'];
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    if (isset($_GET['colour'])) {
        $colour_id = $_GET['colour'];

        $sql = "SELECT
                product_item.id,
                product_item.product_id,
                product_item.size_id,
                product_item.colour_id,
                product_tbl.product_name name,
                product_tbl.product_description,
                product_item.quantity,
                product_item.product_image1 item_img1,
                product_item.product_image2 item_img2,
                product_item.product_image3 item_img3,
                product_tbl.product_price price,
                product_tbl.product_category
                FROM
                product_item
                JOIN product_tbl
                ON product_item.product_id = product_tbl.product_id
                JOIN size ON product_item.size_id = size.id
                JOIN colour ON product_item.colour_id = colour.id
                WHERE
                product_item.product_id = ? AND product_item.colour_id = ?";

        $query = $conn->prepare($sql);
        $query->bind_param("ii", $product_id, $colour_id);
        $query->execute();
        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['product_id'] = $row['product_id'];
                $_SESSION['product_item_id'] = $row['id'];
                $_SESSION['size_id'] = $row['size_id'];

                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $directory = "../img/product";
                $quantity = $row['quantity'];
                $description = $row['product_description'];
                $product_category = $row['product_category'];

                $outputPathsArray = array(
                    $directory . '/' . $id . '_image1.png',
                    $directory . '/' . $id . '_image2.png',
                    $directory . '/' . $id . '_image3.png'
                );

                $blobDataArray = array($row['item_img1'], $row['item_img2'], $row['item_img3']);
                for ($i = 0; $i < count($blobDataArray); $i++) {
                    blobToImage($blobDataArray[$i], $outputPathsArray[$i]);
                }
            }
        } else {
            $error = "Product is out of Stock.";
        }
    }
} else {
    header('/nstudio/index.php');
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
    <?php require_once './partials/loading.php' ?>
    <!-- Navbar -->
    <?php require_once './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="min-h-screen animate__animated fadeIn" id="main">
        <?php if ($quantity > 0) : ?>
            <!-- DESKTOP -->
            <div class="parent-container container min-h-screen pt-[5rem] pb-[1rem] relative md:hidden">
                <div class="flex items-center font-semibold px-[4rem] lgt:px-[2rem]">
                    <a class="after:content-['_/'] after:mx-2" href="../index.php">HOME</a>
                    <a class="after:content-['_/'] after:mx-2" href="<?= "../$product_category.php" ?>"><?= $product_category ?></a>
                    <a href="#">VIEW PRODUCT</a>
                </div>

                <div class="flex items-start pt-[1rem] px-[4rem] lgt:px-[2rem] relative">
                    <div id="leftContainer" class="overflowYelement w-[9rem] lgt:hidden flex flex-col sticky top-12 h-[37rem] overflow-y-auto gap-2">
                        <a href="#rimg1">
                            <img class="max-w-full h-[13rem] object-cover cursor-pointer hover:opacity-90 hoverProduct" id="limg1" src="<?= "../img/product/{$id}_image1.png" ?>" alt=" img1" draggable="false" />
                        </a>
                        <a href="#rimg2">
                            <img class="max-w-full h-[13rem] object-cover cursor-pointer hover:opacity-90 hoverProduct" id="limg2" src="<?= "../img/product/{$id}_image2.png" ?>" alt=" img2" draggable="false" />
                        </a>
                        <a href="#rimg3">
                            <img class="max-w-full h-[13rem] object-cover cursor-pointer hover:opacity-90 hoverProduct" id="limg3" src="<?= "../img/product/{$id}_image3.png" ?>" alt=" img3" draggable="false" />
                        </a>
                    </div>
                    <div id="rightContainer" class="flex flex-col ml-[4rem] lgt:ml-0 gap-2">
                        <img class="max-w-full h-[40rem] lgt:h-[45rem] object-cover cursor-auto" id="rimg1" src="<?= "../img/product/{$id}_image1.png" ?>" alt="img1" draggable="false" />
                        <img class="max-w-full h-[40rem] lgt:h-[45rem] object-cover cursor-auto" id="rimg2" src="<?= "../img/product/{$id}_image2.png" ?>" draggable="false" />
                        <img class="max-w-full h-[40rem] lgt:h-[45rem] object-cover cursor-auto" id="rimg3" src="<?= "../img/product/{$id}_image3.png" ?>" alt="img3" draggable="false" />
                    </div>
                    <form id="productForm" class="productForm flex flex-col justify-start gap-6 sticky top-12 ml-[4rem] lgt:ml-[2rem] w-[26rem]">
                        <div class="flex flex-col text-xl">
                            <h1 class="uppercase font-medium"><?= $name ?></h1>
                            <p class="font-semibold before:content-['₱'] before:font-medium before:mr-[2px]"><?= $price ?></p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-xs tracking-wider">COLOR</p>
                            <div class="flex gap-[7px] pl-[2px]" id="colourContainer" data-colour-id="<?= $colour_id ?>" draggable="false">
                                <?php showProductColours($product_id, $colour_id) ?>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-xs tracking-wider">SIZES</p>
                            <div class="flex flex-wrap justify-between pl-[2px] w-[20rem]">
                                <?php showProductSizes($_SESSION['product_id'], $colour_id) ?>
                            </div>
                        </div>
                        <div class="flex">
                            <button type="button" id="showSizeModalBtn" class="showSizeModalBtn text-xs font-medium underline cursor-pointer">
                                FIND YOUR SIZE
                            </button>
                        </div>
                        <div class="flex flex-col gap-5">
                            <div class="w-full h-[2.7rem] border border-[#101010]">
                                <button type="submit" value="add" class="addToCartBtn w-full h-full border border-[#101010] text-center text-[16px] uppercase" name="addToCartBtn" id="addToCartBtn">
                                    Add to bag
                                </button>
                            </div>
                            <div class="w-full h-[2.7rem]">
                                <button type="submit" value="buy" data-item-id="<?= $_SESSION['product_id'] ?>" class="w-full h-full border border-[#101010] bg-[#101010] text-white text-center text-[16px] uppercase">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col w-full gap-3">
                            <div class="flex gap-3 text-xs font-medium pl-[1px]">
                                <button type="button" id="dBtn2" class="dBtn2 underline uppercase">
                                    Description
                                </button>
                                <span>-</span>
                                <button type="button" id="dBtn1" class="dBtn1 uppercase">
                                    Delivery
                                </button>
                                <span>-</span>
                                <button type="button" id="dBtn3" class="dBtn3 uppercase">
                                    Details
                                </button>
                            </div>
                            <!-- Static -->
                            <!-- prettier-ignore -->
                            <div id="desc1" class="desc1 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">Shipping to: International

                                Standard home delivery ₱120 PHP / Free on orders over ₱10,000 PHP

                                Payment methods: Credit / Debit card | Klarna | Paypal

                                Please note, that the total amount of your order does not include local sales taxes and VAT, which means extra fees may be applied after placing your order. Read more about the delivery fees here.

                                Your return will cost ₱199. If something isn’t quite right, you have 28 days to send it back to us.

                                Minimum order value is ₱249 PHP

                                Free shipping on orders over threshold
                            </div>
                            <!-- Dynamic -->
                            <!-- prettier-ignore -->
                            <div id="desc2" class="desc2 text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium"><?= $description ?>,

                                Discover the perfect fusion of comfort and style with our latest fashion essential.

                                Unwind in the luxurious comfort of this meticulously designed piece, crafted to elevate your style effortlessly.

                                Embrace a lifestyle where comfort meets chic, making every day a stylish occasion.

                                • Supreme Comfort
                                • Effortless Elegance
                                • Tailored Fit
                                • Versatile Style
                                • Fashion Forward

                                100% RWS Wool / Machine wash

                                Elevate your wardrobe with the perfect harmony of comfort and style.
                                Experience a new level of confidence and sophistication in every step.
                            </div>
                            <!-- Static -->
                            <!-- prettier-ignore -->
                            <div id="desc3" class="desc3 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">100% Cotton / Medium iron / Line dry / Only non-chlorine bleach when needed / Dry clean / Machine wash 40°C

                                Make sure that your favourite items remain long-loved pieces for years to come; read our product care guide.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- MOBILE -->
            <div class="parent-container container min-h-screen pt-[4rem] pb-[1rem] relative md:block hidden">
                <div class="flex items-center text-sm font-medium px-[4rem] md:px-[2rem] sm:px-[1rem]">
                    <a class="after:content-['_/'] after:mx-2" href="#">HOME</a>
                    <a class="after:content-['_/'] after:mx-2" href="<?= "../$product_category.php" ?>"><?= $product_category ?></a>
                    <a href="#">VIEW PRODUCT</a>
                </div>

                <form id="productForm" class="productForm flex flex-col w-full justify-start gap-6 sticky top-4 py-[2rem]">
                    <div class="flex items-start px-[4rem] md:px-[0]">
                        <div id="imageSlider" class="flex w-full overflow-auto snap-x snap-mandatory">
                            <span id="counter" class="absolute top-[3rem] md:top-[2.5rem] left-[1rem] md:left-[0.5rem] px-2 bg-gray-600 rounded-xl text-white md:text-sm xs:text-xs">1/3</span>
                            <div class="w-full shrink-0 snap-start snap-always">
                                <img id="image1" class="img1 max-w-full w-full h-full object-cover object-top" src="<?= "../img/product/{$id}_image1.png" ?>" alt="image1" />
                            </div>
                            <div class="w-full shrink-0 snap-start snap-always">
                                <img id="image2" class="img2 max-w-full w-full h-full object-cover object-top" src="<?= "../img/product/{$id}_image2.png" ?>" alt="image2" />
                            </div>
                            <div class="w-full shrink-0 snap-start snap-always">
                                <img id="image3" class="img3 max-w-full w-full h-full object-cover object-top" src="<?= "../img/product/{$id}_image3.png" ?>" alt="image3" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col text-3xl sm:text-xl px-[1rem]">
                        <h1 class="uppercase font-medium"><?= $name ?></h1>
                        <p class="font-semibold before:content-['₱'] before:font-medium before:mr-[2px]"><?= $price ?></p>
                    </div>
                    <div class="flex flex-col gap-2 px-[1rem]">
                        <p class="text-xs tracking-wider">COLOR</p>
                        <div class="flex gap-[12px] xs:gap-[8px] pl-[2px]" id="colourContainer" data-colour-id="<?= $colour_id ?>" draggable="false">
                            <?php showProductColoursMobile($product_id, $colour_id) ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 px-[1rem]">
                        <p class="text-xs tracking-wider">SIZES</p>
                        <div class="flex flex-wrap justify-start gap-6 sm:gap-4 pl-[1px] w-full">
                            <?php showProductSizesMobile($product_id, $colour_id) ?>
                        </div>
                    </div>
                    <div class="flex px-[1rem]">
                        <button type="button" id=" showSizeModalBtn" class="showSizeModalBtn text-xs font-medium underline cursor-pointer">
                            FIND YOUR SIZE
                        </button>
                    </div>
                    <div class="flex flex-col w-full gap-3 px-[1rem]">
                        <div class="flex gap-3 justify-center text-xs font-medium pl-[1px]">
                            <button type="button" id="dBtn2" class="dBtn2 underline uppercase">
                                Description
                            </button>
                            <span>-</span>
                            <button type="button" id="dBtn1" class="dBtn1 uppercase">
                                Delivery
                            </button>
                            <span>-</span>
                            <button type="button" id="dBtn3" class="dBtn3 uppercase">
                                Details
                            </button>
                        </div>
                        <!-- prettier-ignore -->
                        <div id="desc1" class="desc1 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">Shipping to: International

                            Standard home delivery $20 USD / Free on orders over $200 USD
                            Payment methods: Credit / Debit card | Klarna | Paypal

                            Please note, that the total amount of your order does not include local sales taxes and VAT, which means extra fees may be applied after placing your order. Read more about the delivery fees here.

                            Your return will cost $25. If something isn’t quite right, you have 28 days to send it back to us.

                            Minimum order value is $5 USD

                            Free shipping on orders over threshold
                        </div>
                        <!-- prettier-ignore -->
                        <div id="desc2" class="desc2 text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium"><?= $description ?>,

                            Discover the perfect fusion of comfort and style with our latest fashion essential.

                            Unwind in the luxurious comfort of this meticulously designed piece, crafted to elevate your style effortlessly.

                            Embrace a lifestyle where comfort meets chic, making every day a stylish occasion.

                            • Supreme Comfort
                            • Effortless Elegance
                            • Tailored Fit
                            • Versatile Style
                            • Fashion Forward

                            100% RWS Wool / Machine wash

                            Elevate your wardrobe with the perfect harmony of comfort and style.
                            Experience a new level of confidence and sophistication in every step.
                        </div>
                        <!-- prettier-ignore -->
                        <div id="desc3" class="desc3 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">100% Cotton / Medium iron / Line dry / Only non-chlorine bleach when needed / Dry clean / Machine wash 40°C

                            Make sure that your favourite items remain long-loved pieces for years to come; read our product care guide.
                        </div>
                    </div>
                    <div class="flex flex-col gap-5 bg-white sticky bottom-0 pt-2 pb-4 px-[1rem] border-t">
                        <div class="flex justify-between text-sm">
                            <p class="font-medium uppercase"><?= $name ?></p>
                            <p class="font-semibold before:content-['₱'] before:font-medium before:mr-[2px]"><?= $price ?></p>
                        </div>
                        <div class="w-full h-[2.5rem] border border-[#101010]">
                            <button type="submit" value="add" class="addToCartBtn w-full h-full border border-[#101010] text-center text-[16px] uppercase" name="addToCartBtn" id="addToCartBtn">
                                Add to bag
                            </button>
                        </div>
                        <div class="w-full h-[2.5rem]">
                            <button type="submit" value="buy" data-item-id="<?= $_SESSION['product_id'] ?>" class="w-full h-full border border-[#101010] bg-[#101010] text-white text-center text-[16px] uppercase">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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
        <?php else : ?>
            <div class='w-full h-screen flex justify-center items-center'>
                <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg">No Stock Available.</h1>
            </div>
        <?php endif; ?>
        <?php if (checkSuggestionProduct($product_id, $_SESSION['product_item_id'])) : ?>
            <div class="min-h-screen border pt-[1.8rem] px-[4rem] md:px-[3rem] sm:px-[1rem]">
                <h1 class="text-sm mb-5">You may also like...</h1>
                <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3">
                    <?php showSuggestionProduct($product_id, $_SESSION['product_item_id']) ?>
                </div>
            </div>
        <?php endif; ?>
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