<!-- <?php

        session_start();
        session_regenerate_id();

        require "../includes/connection.php";
        require "../includes/functions.php";

        if (!isset($_SESSION["id"]) || $_SESSION['id'] === "") {
            header('location: ../index.php');
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM product_tbl WHERE id=$id";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $prod_title = $row['prod_name'];
                $prod_desc = $row['prod_desc'];
                $prod_price = $row['prod_price'];
                $prod_stocks = $row['prod_stockquantity'];
                $prod_brand = $row['prod_brand'];
                $prod_category = $row['prod_category'];
                $prod_img = "../img/product/prod" . $row['id'] . ".png";
            }
        }

        ?> -->
<!DOCTYPE html>
<html lang="en">

<!-- Head -->
<?php require './partials/head.php' ?>

<!-- Body -->
<body>
    <!-- Navbar -->
    <?php require './partials/nav.php' ?>
    <!-- Main Section -->
    <main class="w-full h-screen">
        <img src="<?= $prod_img ?>" alt="product">
        <h1><?= $prod_title ?></h1>
        <h1><?= $prod_price ?></h1>
        <p><?= $prod_desc ?></p>
        <p><?= $prod_brand ?></p>
    </main>
    <!-- Footer Section -->
    <?php require './partials/footer.php' ?>
</body>

</html>