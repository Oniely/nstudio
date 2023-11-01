<?php

session_start();

require "../includes/connection.php";
require "../includes/functions.php";

if (isset($_SESSION["id"]) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM product_tbl WHERE product_id=$product_id";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $_SESSION['product_id'] = $row['product_id'];
        $prod_title = $row['product_name'];
        $prod_desc = $row['product_description'];
        $prod_price = $row['product_price'];
        $prod_stocks = $row['product_quantity'];
        $prod_brand = $row['product_brand'];
        $prod_category = $row['product_category'];
        $prod_img = "../img/product/prod" . $row['product_id'] . ".png";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php require './partials/head.php' ?>

<!-- Body -->

<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="w-full h-screen pt-[4.5rem]">
        <img class="max-w-full" src="<?= $prod_img ?>" alt="product">
        <h1><?= $prod_title ?></h1>
        <h1><?= $prod_price ?></h1>
        <p><?= $prod_desc ?></p>
        <p><?= $prod_brand ?></p>
        <button type="button" class="bg-purple-400 p-2 text-[#101010] text-center cursor-pointer" name="addToCartBtn" id="addToCartBtn" />Add to Cart</button>
        <script>
            $(document).ready(() => {
                $('#addToCartBtn').on('click', () => {
                    $.ajax({
                    url: "../includes/add_to_cart.php",
                    type: "POST",
                    data: { action: "add_to_cart" },
                    success: (res) => {
                        $('#cartNumber').text(res);
                        console.log(res);
                    }})
                })
            })
        </script>
    </main>
    <!-- Footer Section -->
    <?php require './partials/footer.php' ?>
</body>

</html>