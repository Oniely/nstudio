<?php

require_once '../includes/session.php';

require_once "../includes/connection.php";
require_once "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT
    product_item.id, 
    product_tbl.product_name name,
    product_item.product_image1 item_img1,
    product_item.product_image2 item_img2,
    product_item.product_image3 item_img3,
    product_tbl.product_price price
    FROM
    product_item
    JOIN product_tbl ON product_item.product_id = product_tbl.product_id
    JOIN size ON product_item.size_id = size.id
    JOIN colour ON product_item.colour_id = colour.id
    WHERE
    product_tbl.product_id = $product_id";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['product_item_id'] = $row['id'];
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            $directory = "../img/product";
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

?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php require './partials/head.php' ?>
<script src="../script/product.js" defer></script>
<!-- Body -->

<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="w-full h-full p-5">
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="w-full h-full flex justify-start pt-[4.5rem]  gap-20">
                <div class="w-[10rem] flex flex-col">
                    <img class="w-[10rem] hoverProduct" src="<?= "../img/product/{$id}_image1.png" ?>" alt="">
                    <img class="w-[10rem] hoverProduct" src="<?= "../img/product/{$id}_image2.png" ?>" alt="">
                    <img class="w-[10rem] hoverProduct" src="<?= "../img/product/{$id}_image3.png" ?>" alt="">
                </div>
                <div class="w-full h-screen">
                    <img class="w-[20rem]" id="showProduct" src="<?= "../img/product/{$id}_image1.png" ?>" alt="">
                    <h1>
                        <?= $name ?>
                    </h1>
                    <h1>
                        <?= $price ?>
                    </h1>
                    <button type="button" class="bg-purple-400 p-2 text-[#101010] text-center cursor-pointer"
                        name="addToCartBtn" id="addToCartBtn">Add to Cart</button>
                </div>
            </div>
        <?php else: ?>
            <div class="w-full h-screen flex justify-center items-center">
                <h1 class='text-2xl bg-slate-200 p-8 rounded-lg'>Product is out of stock.</h1>
            </div>
        <?php endif; ?>
    </main>
    <!-- Footer Section -->
    <?php require './partials/footer.php' ?>
</body>

</html>