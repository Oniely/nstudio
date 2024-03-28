<?php

/* 
 * Dashboard
 */

require_once "THE_FUNCTIONS.php";

function blobToImage($blob, $path)
{
    blobToImageConverter($blob, $path);
}

function getProductColourAndSize($product_item_id)
{
    require 'connection.php';

    $sql = "SELECT
            colour.colour_value,
            size.size_value
            FROM
            colour
            INNER JOIN product_item ON product_item.colour_id = colour.id
            INNER JOIN size ON product_item.size_id = size.id
            WHERE
            product_item.id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $product_item_id);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return ['colour_value' => $row['colour_value'], 'size_value' => $row['size_value']];
    } else {
        return false;
    }
}

function fetchItemAndColorIDs($product_item_id)
{
    require 'connection.php';

    $sql = "SELECT
            product_tbl.product_name,
            product_item.product_id,
            product_item.colour_id,
            product_item.size_id
            FROM
            product_item
            JOIN product_tbl 
            ON product_item.product_id = product_tbl.product_id
            WHERE
            id = ?";

    $query = $conn->prepare($sql);
    $query->bind_param('i', $product_item_id);
    $query->execute();

    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return ['product_name' => $row['product_name'], 'product_id' => $row['product_id'], 'colour_id' => $row['colour_id'], 'size_id' => $row['size_id']];
    } else {
        return false;
    }
}

function getOrderItemCount($orderID)
{
    require "connection.php";

    $sql = "SELECT COUNT(*) as count FROM order_line_tbl WHERE order_id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $orderID);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return false;
    }
}

function orderCount($userID, $orderStatus, $orderStatus2 = "")
{
    require 'connection.php';

    if ($orderStatus2 == "" || $orderStatus2 == null) {
        $sql = "SELECT COUNT(*) as count FROM shop_order_tbl WHERE user_id = ? AND order_status = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('is', $userID, $orderStatus);
        $query->execute();

        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['count'];
        } else {
            return false;
        }
    } else {
        $sql = "SELECT COUNT(*) as count FROM shop_order_tbl WHERE user_id = ? AND order_status = ? || order_status = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('iss', $userID, $orderStatus, $orderStatus2);
        $query->execute();

        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['count'];
        } else {
            return false;
        }
    }
}

function showToPayOrder($userID)
{
    require 'connection.php';

    $sql = 'SELECT
            shop_order_tbl.*,
            order_line_tbl.*,
            product_item.product_image1
            FROM
            shop_order_tbl
            JOIN order_line_tbl ON shop_order_tbl.id = order_line_tbl.order_id
            JOIN product_item ON order_line_tbl.product_item_id = product_item.id
            WHERE
            shop_order_tbl.user_id = ?
            AND shop_order_tbl.order_status = "TO PAY"
            GROUP BY
            shop_order_tbl.id';

    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();

    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $img = $row['product_image1'];
            $path = "../../img/product/prod" . $row['product_item_id'] . ".png";
            blobToImage($img, $path);
            $product_img = "/nstudio/img/product/prod" . $row['product_item_id'] . ".png";

            $orderItemCount = getOrderItemCount($row['order_id']);

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
                        <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                    </div>
                    <h1 class="text-sm sm:block hidden self-end">
                        <?= $date ?>
                    </h1>
                </div>
                <div class="w-full flex items-center gap-2">
                    <div class="h-48 sm:h-44 xs:h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                            <img class="max-w-full h-full object-cover" src="<?= $product_img ?>" alt="">
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
                                <p class="text-[#505050] text-sm sm:font-medium font-semibold">Order Items: <span class="before:text-xs before:content-['X'] before:mx-[2px]"><?= $orderItemCount ?></span></p>
                            </div>
                        </div>
                        <div class="flex justify-between sm:justify-end items-end">
                            <div class="flex gap-1 sm:hidden">
                                <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="">
                                <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                            </div>
                            <p class="text-lg sm:text-base">TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['order_total'] ?></span></p>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Bottom -->
                <div class="w-full flex justify-end sm:justify-between gap-3 xs:gap-[4px] uppercase">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="viewMoreBtn" class="viewMoreBtn text-sm w-full h-full">View More</button>
                    </div>
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                        <button data-order-id="<?= $row['order_id'] ?>" id="cancelOrderBtn" class="cancelOrderBtn text-sm w-full h-full">Cancel</button>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        ?>
        <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
            <h1 class="text-2xl font-medium text-center py-5">No - To pay items</h1>
        </div>
        <?php
    }
}

function showToShipOrders($userID)
{
    require 'connection.php';

    $sql = 'SELECT
            shop_order_tbl.*,
            order_line_tbl.*,
            product_item.product_image1
            FROM
            shop_order_tbl
            JOIN order_line_tbl ON shop_order_tbl.id = order_line_tbl.order_id
            JOIN product_item ON order_line_tbl.product_item_id = product_item.id
            WHERE
            shop_order_tbl.user_id = ?
            AND shop_order_tbl.order_status = "TO SHIP" || shop_order_tbl.order_status = "SHIPPED"
            GROUP BY
            shop_order_tbl.id';

    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();

    $result = $query->get_result();
    $month = [
        '',
        'January',
        'Febuary',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $img = $row['product_image1'];
            $path = "../../img/product/prod" . $row['product_item_id'] . ".png";
            blobToImage($img, $path);
            $product_img = "/nstudio/img/product/prod" . $row['product_item_id'] . ".png";

            $orderItemCount = getOrderItemCount($row['order_id']);

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

            $shipDateTime = new DateTime($row['ship_date']);
            $shipDate = $shipDateTime->format('m-d-Y');
            $monthNumber = (int)$shipDateTime->format('m');

            $shipMonth = $month[$monthNumber];
            $shipDay = $shipDateTime->format('d');
            $shipYear = $shipDateTime->format('Y');
        ?>
            <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
                <!-- Top -->
                <div class="hidden md:flex justify-end sm:justify-between">
                    <div class="hidden gap-2 sm:flex">
                        <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="delivered">
                        <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                    </div>
                    <h1 class="text-sm sm:block hidden self-end">
                        <?= $date ?>
                    </h1>
                </div>
                <div class="w-full flex items-center gap-2">
                    <div class="h-48 sm:h-44 xs:h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                            <img class="max-w-full h-full object-cover" src="<?= $product_img ?>" alt="">
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
                                <p class="text-[#505050] text-sm sm:font-medium font-semibold">Order Items: <span class="before:text-xs before:content-['X'] before:mx-[2px]"><?= $orderItemCount ?></span></p>
                            </div>
                        </div>
                        <div class="flex justify-between sm:justify-end items-end">
                            <div class="flex gap-1 sm:hidden">
                                <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="">
                                <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                            </div>
                            <p class="text-lg sm:text-base">TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['order_total'] ?></span></p>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Bottom -->
                <div class="w-full flex sm:flex-wrap justify-end sm:justify-between gap-3 uppercase">
                    <?php if ($row['order_status'] == "SHIPPED") : ?>
                        <div class="text-[#505050] text-sm uppercase leading-5 font-medium">
                            <h1 class="text-base">Packed and Ready to Ship</h1>
                            <p><?= $shipMonth . ' ' . $shipDay . ' ' . $shipYear ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="w-full flex justify-end sm:justify-between gap-3 xs:gap-[4px] uppercase">
                        <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                            <button data-order-id="<?= $row['order_id'] ?>" id="viewMoreBtn" class="viewMoreBtn text-sm w-full h-full">View More</button>
                        </div>
                        <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                            <a href="mailto:nechmastudio@gmail.com"><button id="contactUsBtn" class="contactUsBtn text-sm w-full h-full">Contact Us</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        ?>
        <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
            <h1 class="text-2xl font-medium text-center py-5">No - To Ship Order</h1>
        </div>
        <?php
    }
}

function showToReceiveOrders($userID)
{
    require 'connection.php';

    $sql = 'SELECT
            shop_order_tbl.*,
            order_line_tbl.*,
            product_item.product_image1
            FROM
            shop_order_tbl
            JOIN order_line_tbl ON shop_order_tbl.id = order_line_tbl.order_id
            JOIN product_item ON order_line_tbl.product_item_id = product_item.id
            WHERE
            shop_order_tbl.user_id = ?
            AND shop_order_tbl.order_status = "TO RECEIVE"
            OR shop_order_tbl.order_status = "DELIVERED"
            GROUP BY
            shop_order_tbl.id';

    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();

    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $img = $row['product_image1'];
            $path = "../../img/product/prod" . $row['product_item_id'] . ".png";
            blobToImage($img, $path);
            $product_img = "/nstudio/img/product/prod" . $row['product_item_id'] . ".png";

            $orderItemCount = getOrderItemCount($row['order_id']);

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
                        <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                    </div>
                    <h1 class="text-sm sm:block hidden self-end">
                        <?= $date ?>
                    </h1>
                </div>
                <div class="w-full flex items-center gap-2">
                    <div class="h-48 sm:h-44 xs:h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                            <img class="max-w-full h-full object-cover" src="<?= $product_img ?>" alt="">
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
                                <p class="text-[#505050] text-sm sm:font-medium font-semibold">Order Items: <span class="before:text-xs before:content-['X'] before:mx-[2px]"><?= $orderItemCount ?></span></p>
                            </div>
                        </div>
                        <div class="flex justify-between sm:justify-end items-end">
                            <div class="flex gap-1 sm:hidden">
                                <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="">
                                <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                            </div>
                            <p class="text-lg sm:text-base">TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['order_total'] ?></span></p>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Bottom -->
                <div class="w-full flex justify-end sm:justify-between gap-3 xs:gap-[4px] uppercase">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="viewMoreBtn" class="viewMoreBtn text-sm w-full h-full">View More</button>
                    </div>
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                        <button data-order-id="<?= $row['order_id'] ?>" id="orderReceivedBtn" class="orderReceivedBtn text-sm w-full h-full disabled:bg-slate-300 disabled:hover:cursor-not-allowed" <?= $row['order_status'] == "DELIVERED" ? '' : 'disabled' ?>>Order Received</button>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        ?>
        <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
            <h1 class="text-2xl font-medium text-center py-5">No - To Receive Order</h1>
        </div>
        <?php
    }
}

function showCompletedProducts($userID)
{
    require "connection.php";

    $sql = 'SELECT
            shop_order_tbl.*,
            order_line_tbl.*,
            order_line_tbl.quantity order_quantity
            FROM
            shop_order_tbl
            JOIN order_line_tbl ON shop_order_tbl.id = order_line_tbl.order_id
            WHERE
            shop_order_tbl.user_id = ?
            AND shop_order_tbl.order_status = "COMPLETED"';

    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();

    $result = $query->get_result();
    $month = [
        '',
        'January',
        'Febuary',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            // ERROR 
            $product = getProductColourAndSize($row['product_item_id']);
            $colour_value = $product['colour_value'];
            $size_value = $product['size_value'];

            $item = fetchItemAndColorIDs($row['product_item_id']);
            $product_name = $item['product_name'];
            $product_id = $item['product_id'];
            $colour_id = $item['colour_id'];
            $size_id = $item['size_id'];

            $dateTime = new DateTime($row['receive_date']);
            $monthNumber = (int)$dateTime->format('m');

            $receivedMonth = $month[$monthNumber];
            $receivedDay = $dateTime->format('d');
            $receivedYear = $dateTime->format('Y');

            $orderDatetime = new DateTime($row['order_date']);
            $date = $orderDatetime->format('m-d-Y');
        ?>
            <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
                <!-- Top -->
                <div class="hidden md:flex justify-end sm:justify-between">
                    <div class="hidden gap-2 sm:flex">
                        <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="delivered">
                        <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
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
                        <div class="flex justify-between sm:justify-end items-end">
                            <div class="flex gap-2 sm:hidden">
                                <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="delivered">
                                <h1 class="font-semibold uppercase text-sm text-[#095d40]"><?= $row['order_status'] ?></h1>
                            </div>
                            <p class="text-lg sm:text-base">TOTAL: <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['order_total'] ?></span></p>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Bottom -->
                <div class="w-full flex sm:flex-wrap items-center justify-between gap-3 uppercase">
                    <div class="text-[#505050] text-sm uppercase leading-5 font-medium">
                        <h1 class="text-base">Delivered and Received</h1>
                        <p><?= $receivedMonth . ' ' . $receivedDay . ' ' . $receivedYear ?></p>
                    </div>
                    <div class="w-full flex justify-end sm:justify-between gap-3 xs:gap-[4px] uppercase">
                        <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                            <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                                <button id="buyAgainBtn" class="text-sm w-full h-full">Buy Again</button>
                            </a>
                        </div>
                        <div class="w-[10rem] h-[2.5rem] border border-[#101010]">
                            <a href="mailto:nechmastudio@gmail.com"><button id="contactUsBtn" class="contactUsBtn text-sm w-full h-full">Contact Us</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        ?>
        <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
            <h1 class="text-2xl font-medium text-center py-5">No completed items.</h1>
        </div>
        <?php
    }
}

function showCancelledOrders($userID)
{
    require 'connection.php';

    $sql = 'SELECT
            shop_order_tbl.*,
            order_line_tbl.*,
            product_item.product_image1
            FROM
            shop_order_tbl
            JOIN order_line_tbl ON shop_order_tbl.id = order_line_tbl.order_id
            JOIN product_item ON order_line_tbl.product_item_id = product_item.id
            WHERE
            shop_order_tbl.user_id = ?
            AND shop_order_tbl.order_status = "CANCELLED"
            GROUP BY
            shop_order_tbl.id';

    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();

    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $img = $row['product_image1'];
            $path = "../../img/product/prod" . $row['product_item_id'] . ".png";
            blobToImage($img, $path);
            $product_img = "/nstudio/img/product/prod" . $row['product_item_id'] . ".png";

            $orderItemCount = getOrderItemCount($row['order_id']);

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
                        <h1 class="font-semibold uppercase text-sm text-[#ff5555]"><?= $row['order_status'] ?></h1>
                    </div>
                    <h1 class="text-sm sm:block hidden self-end">
                        <?= $date ?>
                    </h1>
                </div>
                <div class="w-full flex items-center gap-2">
                    <div class="h-48 sm:h-44 xs:h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id={$product_id}&colour={$colour_id}" ?>">
                            <img class="max-w-full h-full object-cover" src="<?= $product_img ?>" alt="">
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
                                <p class="text-[#505050] text-sm sm:font-medium font-semibold">Order Items: <span class="before:text-xs before:content-['X'] before:mx-[2px]"><?= $orderItemCount ?></span></p>
                            </div>
                        </div>
                        <div class="flex justify-between sm:justify-end items-end">
                            <div class="flex gap-1 sm:hidden">
                                <img class="w-5 h-5 object-contain" src="<?= "/nstudio/img/$row[order_status].svg" ?>" alt="">
                                <h1 class="font-semibold uppercase text-sm text-[#ff5555]"><?= $row['order_status'] ?></h1>
                            </div>
                            <p class="text-lg sm:text-base">TOTAL : <span class="font-semibold before:content-['₱'] before:mr-[1px]"><?= $row['order_total'] ?></span></p>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Bottom -->
                <div class="w-full flex justify-end gap-3 xs:gap-[4px] uppercase">
                    <div class="w-[10rem] h-[2.5rem] border border-[#101010] bg-[#101010] text-white">
                        <button data-order-id="<?= $row['order_id'] ?>" id="viewMoreBtn" class="viewMoreBtn text-sm w-full h-full">View More</button>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        ?>
        <div class="w-full flex flex-col gap-2 h-full py-3 px-4 border">
            <h1 class="text-2xl font-medium text-center py-5">No - Cancelled Order</h1>
        </div>
<?php
    }
}
