<?php

session_start();

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
                product_item.*,
                shop_order_tbl.order_status,
                shop_order_tbl.order_date
                FROM
                order_line_tbl
                JOIN product_item ON order_line_tbl.product_item_id = product_item.id
                JOIN shop_order_tbl on shop_order_tbl.id = order_line_tbl.order_id
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

            $dateTime = new DateTime($row['order_date']);
            $date = $dateTime->format('m-d-Y');
?>
            <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
                <!-- Top -->
                <div class="hidden md:flex justify-end sm:justify-between">
                    <div class="hidden gap-2 sm:flex">
                        <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="delivered">
                        <h1 class="font-semibold uppercase text-sm <?= $row['order_status'] == "CANCELLED" ? 'text-[#ff5555]' : 'text-[#095d40]' ?>"><?= $row['order_status'] ?></h1>
                    </div>
                    <h1 class="text-sm sm:block hidden self-end">
                        <?= $date ?>
                    </h1>
                </div>
                <div class="w-full flex items-center gap-2">
                    <div class="h-48 md:h-44 sm:h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                            <img class="max-w-full h-full object-cover" src="<?= "/nstudio/img/product/prod$row[product_item_id].png" ?>" alt="image">
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-between gap-1 h-full px-2">
                        <div class="flex flex-col">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h1 class="sm:text-sm text-base tracking-[1px] font-semibold capitalize"><?= $product_name ?></h1>
                                </div>
                                <h1 class="text-sm sm:hidden">
                                    <?= $date ?>
                                </h1>
                            </div>
                            <div class="flex flex-col justify-center items-start">
                                <h1 class="text-[#505050] text-sm xs:text-xs sm:font-medium font-semibold uppercase">Variation: <span><?= $colour_value ?> | <?= $size_value ?></span></h1>
                                <p class="text-[#505050] text-sm xs:text-xs sm:font-medium font-semibold">Order Quantity: <span class="before:text-xs before:content-['X'] before:mx-[1px]"><?= $row['order_quantity'] ?></span></p>
                            </div>
                        </div>
                        <div class="flex justify-between xs:justify-end items-end">
                            <div class="flex gap-1 sm:hidden">
                                <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="delivered">
                                <h1 class="font-semibold uppercase text-sm <?= $row['order_status'] == "CANCELLED" ? 'text-[#ff5555]' : 'text-[#095d40]' ?>"><?= $row['order_status'] ?></h1>
                            </div>
                            <p class="text-lg sm:text-base">SUBTOTAL: <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['price'] * $row['order_quantity'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
<?php
        endwhile;
    }
}
