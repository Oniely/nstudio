<?php

session_start();
require_once '../includes/THE_INITIALIZER.php';

$key = "";
$type_id = 0;

if (isset($_GET['key'])) {
    $key = $_GET['key'];
} elseif (isset($_GET['type']) && isset($_GET['category'])) {
    $type_id = $_GET['type'];
    $category = $_GET['category'];

    $sqlQuery = "SELECT type_value FROM product_type WHERE id = ?";
    $data = $App->db->select($sqlQuery, [$type_id]);
    $type_value = $data[0]['type_value'];
}

?>

<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require_once './partials/head.php' ?>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php include './partials/loading.php' ?>
    <!-- Navbar -->
    <?php require_once './partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen w-full pt-[3rem] px-16 md:px-[1rem] animate__animated fadeIn">
        <?php if (!empty($type_value) || $App->db->countRowsWhere('product_tbl', 'keywords', 'LIKE', "%$key%", "str") > 0) : ?>
            <div class="container flex justify-start mt-4 mb-3">
                <h3 class="text-2xl font-[600] font-['Lato'] capitalize">
                    <?= @$key ?>
                    <?= @$type_value ?>
                </h3>
            </div>
        <?php endif; ?>
        <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3">
            <?php
            if ($key != "") :
                $products = $App->db->getSearchProducts($key);
                $App->store->showProducts($products);
            elseif ($type_id != 0 && $category != "") :
                $products = $App->db->getSearchProducts($category, $type_id);
                $App->store->showProducts($products);
            else :
            ?>
                <div class='w-full h-screen flex justify-center items-center md:col-span-full'>
                    <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg whitespace-nowrap">No Ressult Found.</h1>
                </div>
            <?php
            endif;
            ?>
        </div>
    </main>
    <!-- Footer -->
    <?php require_once './partials/footer.php' ?>
</body>

</html>