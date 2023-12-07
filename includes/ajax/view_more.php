<?php

require "../session.php";
require "../connection.php";
require "../functions.php";

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['orderID'])) {
        $order_id = $_GET['orderID'];

        $sql = 'SELECT
                order_line_tbl.*,
                order_line_tbl.quantity order_quantity,
                product_item.*
                FROM
                order_line_tbl
                JOIN product_item ON order_line_tbl.product_item_id = product_item.id
                WHERE
                order_id = ?';
    }

    $query = $conn->prepare($sql);
    $query->bind_param('i', $order_id);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $product = getProductColourAndSize($row['product_item_id']);
            $colour_value = $product['colour_value'];
            $size_value = $product['size_value'];

            $item = fetchItemAndColorIDs($row['product_item_id']);
            $product_name = $item['product_name'];
            $product_id = $item['product_id'];
            $colour_id = $item['colour_id'];
            $size_id = $item['size_id'];
?>
            <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border rounded">
                <!-- Top -->
                <div class="w-full flex items-center gap-2">
                    <div class="h-44 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                            <img class="max-w-full h-full object-cover" src="<?= "/nstudio/img/product/prod$row[product_item_id].png" ?>" alt="">
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-between gap-1 h-full">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-base tracking-[2px] font-semibold capitalize"><?= $product_name ?></h1>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center items-start mb-10">
                            <h1 class="text-sm font-semibold uppercase">Variation: <span><?= $colour_value ?> | <?= $size_value ?></span></h1>
                            <p class="before:content-['X'] before:mr-[2px] font-['Lato'] text-sm"><span class="text-[1rem]"><?= $row['order_quantity'] ?></span></p>
                        </div>
                        <div class="flex justify-between items-start">
                            <div class="flex gap-2">
                                <img class="w-5 h-5 object-contain" src="/nstudio/img/topay.svg" alt="delivered">
                                <h1 class="font-semibold uppercase text-sm text-[#095d40]">To Pay</h1>
                            </div>
                            <p class="text-base">TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['price'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
<?php
        endwhile;
    }
}
