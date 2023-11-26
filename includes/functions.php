<?php

function dd($value)
{
    var_dump("<pre>$value</pre>");
    die(1);
}

function blobToImage($blobData, $outputPath)
{
    $image = imagecreatefromstring($blobData);
    if ($image !== false) {
        $result = imagejpeg($image, $outputPath, 100);
        imagedestroy($image);
        if ($result) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
/* 
 * Show All Men Product
 */
function showAllMenProduct()
{
    require "connection.php";

    $sql = "SELECT
            product_tbl.*,
            product_item.*
            FROM
            product_tbl
            JOIN product_item ON product_tbl.product_id = product_item.product_id
            WHERE
            product_tbl.product_category = 'MEN'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image1'];
            $path = "img/product/prod$row[product_id]$row[id].png";
            blobToImage($img, $path);

            $product_img = "prod$row[product_id]$row[id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>

                <?php
            else:
                ?>

                <div
                    class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>

                <?php
            endif;
        }
    }
}
/* 
 * Show All Women Product
 */
function showAllWomenProduct()
{
    require "connection.php";

    $sql = "SELECT
            product_tbl.*,
            product_item.*
            FROM
            product_tbl
            JOIN product_item ON product_tbl.product_id = product_item.product_id
            WHERE
            product_tbl.product_category = 'WOMEN'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image1'];
            $path = "img/product/prod$row[product_id]$row[id].png";
            blobToImage($img, $path);

            $product_img = "prod$row[product_id]$row[id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>

                <?php
            else:
                ?>

                <div
                    class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>

                <?php
            endif;
        }
    }
}

/* 
 * Show All Men New Arrival Product
 */

function newMenProduct()
{
    require "connection.php";
    $sql = "SELECT
            product_tbl.*,
            product_item.*
            FROM
            product_tbl
            JOIN product_item ON product_tbl.product_id = product_item.product_id
            WHERE
            product_tbl.product_category = 'MEN' AND product_new=1 LIMIT 4";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image1'];
        $path = "img/product/prod" . $row['product_id'] . $row['id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['product_id'] . $row['id'] . ".png";
        ?>
        <div
            class="w-[276px] md:w-[230px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:md:px-2 before:font-semibold before:tracking-widest before:z-10">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
            </div>
            <div class="flex flex-col gap-2 px-4 py-3">
                <div class="overflow-hidden text-[13px] font-medium">
                    <div class="overflow-hidden">
                        <h3 class="tracking-widest mb-[2px]">
                            <?= $row['product_name'] ?>
                        </h3>
                    </div>
                    <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                        <?= $row['product_price'] ?>
                    </h3>
                </div>
                <?php colourButtons($row['product_id']); ?>
            </div>
        </div>
        <?php
    }
}

/* 
 * Show All Women New Arrival Product
 */

function newWomenProduct()
{
    require "connection.php";

    $sql = "SELECT
            product_tbl.*,
            product_item.*
            FROM
            product_tbl
            JOIN product_item ON product_tbl.product_id = product_item.product_id
            WHERE
            product_tbl.product_category = 'WOMEN' AND product_new=1 LIMIT 4";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image1'];
        $path = "img/product/prod" . $row['product_id'] . $row['id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['product_id'] . $row['id'] . ".png";
        ?>
        <div
            class="w-[276px] md:w-[230px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:md:px-2 before:font-semibold before:tracking-widest before:z-10">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
            </div>
            <div class="flex flex-col gap-2 px-4 py-3">
                <div class="overflow-hidden text-[13px] font-medium">
                    <div class="overflow-hidden">
                        <h3 class="tracking-widest mb-[2px]">
                            <?= $row['product_name'] ?>
                        </h3>
                    </div>
                    <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                        <?= $row['product_price'] ?>
                    </h3>
                </div>
                <?php colourButtons($row['product_id']); ?>
            </div>
        </div>
        <?php
    }
}

/* 
 * Return User Cart Count by Product Item
 */

function cartCount($userID)
{
    require "connection.php";

    $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->num_rows;
    } else {
        return;
    }
}

/* 
 * Check if the User has an empty cart or not
 */

function checkCartProduct($userID)
{
    require "connection.php";

    $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

/* 
 * Show Checkout Products From Cart of User
 */

function showCheckOutProducts($userID) {

    require 'connection.php';

    $sql = "SELECT
            cart_tbl.user_id,
            cart_tbl.product_item_id,
            cart_tbl.quantity cart_quantity,
            product_item.*,
            product_tbl.product_price price,
            colour.colour_value,
            size.size_value,
            product_tbl.product_name
            FROM
            cart_tbl
            JOIN product_item
            JOIN product_tbl ON product_item.product_id = product_tbl.product_id
            JOIN colour ON product_item.colour_id = colour.id
            JOIN size ON product_item.size_id = size.id
            WHERE
            cart_tbl.product_item_id = product_item.id
            AND cart_tbl.user_id = $userID";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $subtotal = 0;
        $product_items = [];
        while($row = $result->fetch_assoc()) {
            $product_items += [$row['product_item_id'] => ["quantity" => $row['cart_quantity'], "price" => $row['price']]];
            ?>
            <div
                class="flex justify-between items-start w-full min-w-[40vw] md:min-w-[min(100%,30rem)] border-b py-3 font-['Lato'] pr-2"
            >
                <div
                    class="flex justify-between items-start gap-5 w-[min(100%,30rem)]"
                >
                    <div class="w-28 h-40 shrink-0 relative">
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">
                            <img class="max-w-full h-full object-cover aspect-square object-top" src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
                        </a>
                        <span class="absolute -top-1 -right-1 w-5 bg-red-300 text-center text-sm rounded-full"><?= $row['cart_quantity'] ?></span>
                    </div>
                    <div
                        class="w-full flex flex-col items-start gap-1 text-start text-[14px]"
                    >
                        <h3 class="text-[15px]"><?= $row['product_name'] ?></h3>
                        <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
                    </div>
                </div>

                <div>
                    <span class="before:content['₱']"><?= $row['price'] * $row['cart_quantity'] ?> </span>
                </div>
            </div>
            <?php
            $subtotal += $row['price'] * $row['cart_quantity'];
        }
        $_SESSION['product_items'] = $product_items;
        return $subtotal;
    }

}

/* 
 * Show Cart Products of User
 */

function showCartProducts($userID)
{

    require 'connection.php';

    $sql = "SELECT
            cart_tbl.user_id,
            cart_tbl.product_item_id,
            cart_tbl.quantity cart_quantity,
            product_item.*,
            product_tbl.product_price price,
            colour.colour_value,
            size.size_value,
            product_tbl.product_name
            FROM
            cart_tbl
            JOIN product_item
            JOIN product_tbl ON product_item.product_id = product_tbl.product_id
            JOIN colour ON product_item.colour_id = colour.id
            JOIN size ON product_item.size_id = size.id
            WHERE
            cart_tbl.product_item_id = product_item.id
            AND cart_tbl.user_id = $userID";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $subtotal = 0;
        while ($row = $result->fetch_assoc()) {
            ?>
            <div
                class="flex justify-between items-start w-full min-w-[50vw] md:min-w-[min(100%,30rem)] border-b py-3 font-['Lato'] pr-2"
            >
                <div
                    class="flex justify-between items-start gap-5 w-[min(100%,20rem)]"
                >
                    <div class="w-32 h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>" alt="product">
                            <img class="max-w-full h-full object-cover aspect-square object-top" src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
                        </a>
                    </div>
                    <div
                        class="w-full flex flex-col items-start gap-1 text-start text-[14px]"
                    >
                        <h3 class="text-[15px]"><?= $row['product_name'] ?></h3>
                        <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
                        <button data-delete-item-id="<?= $row['product_item_id'] ?>" class="underline removeItem">Remove</button>
                        <div
                            class="hidden md:flex justify-center items-center w-14 border mt-10"
                        >
                            <button
                                class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 minusBtn"
                                data-item-id="<?= $row['product_item_id'] ?>"
                            >
                                -
                            </button>
                            <span
                                class="text-gray-600 font-[Open] text-sm quantityCount"
                                data-quantity-id="<?= $row['product_item_id'] ?>"
                                >
                                <?= $row['cart_quantity']; ?>
                                </span
                            >
                            <button
                                class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 addBtn"
                                data-item-id="<?= $row['product_item_id'] ?>"
                            >
                                +
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="flex md:hidden justify-center items-center w-14 border mt-0 ml-2"
                >
                    <button
                        class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 minusBtn"
                        data-item-id="<?= $row['product_item_id'] ?>"
                    >
                        -
                    </button>
                    <span
                        class="text-gray-600 font-[Open] text-sm quantityCount"
                        data-quantity-id="<?= $row['product_item_id'] ?>"
                        ><?= $row['cart_quantity']; ?></span
                    >
                    <button
                        class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 addBtn"
                        data-item-id="<?= $row['product_item_id'] ?>"
                    >
                        +
                    </button>
                </div>
                <div class="pl-4">
                    <p
                        class="before:content-['$'] whitespace-nowrap"
                        data-price-id="<?= $row['product_item_id'] ?>"
                    >
                        <?= $row['price'] * $row['cart_quantity'] ?>
                    </p>
                </div>
            </div>
            <?php
            $subtotal += $row['price'] * $row['cart_quantity'];
        }
        return $subtotal;
        ?>
        
        <?php
    } else {
        ?>
        <h1 class="text-2xl bg-slate-200 p-6 rounded-lg">No item in cart.</h1>
        <?php
    }
}

/* 
 * Check Searched Keyword if it exists and return true or false
 */

function checkSearchKey($keyword) {
    require "connection.php";

    $key = "%$keyword%";

    $sql = "SELECT * FROM product_tbl WHERE keywords LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

/* 
 * Show Searched Product by Keyword
 */

function showSearchProduct($keyword)
{
    require 'connection.php';

    $key = "%$keyword%";

    $sql = "SELECT * FROM product_tbl WHERE keywords LIKE ?";
    $query = $conn->prepare($sql);
    $query->bind_param('s', $key);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image'];
            $path = "../img/product/prod$row[product_id].png";
            blobToImage($img, $path);
            $product_id = $row['product_id'];
            $product_img = "prod$row[product_id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" />
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($product_id); ?>
                    </div>
                </div>

                <?php
            else:
                ?>

                <div
                    class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" />
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($product_id); ?>
                    </div>
                </div>

                <?php
            endif;
        }
    } else {
        ?>
        <div class='w-full h-screen flex justify-center items-center'>
            <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg">No Result Found.</h1>
        </div>
        <?php
    }
}

/* 
 * Show Search Product by Type and Category when The Hover Navbar is clicked
 */

function showSearchProductByType($type_id, $category) {
    require "connection.php";

    $sql = "SELECT 
    product_tbl.product_id, 
    product_tbl.product_name, 
    product_tbl.product_price, 
    product_tbl.product_image, 
    product_tbl.product_new, 
    product_type.type_value 
    FROM product_tbl 
    JOIN product_type ON product_tbl.product_type_id = product_type.id 
    WHERE product_tbl.product_type_id = $type_id 
    AND product_tbl.product_category = $category;";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image'];
            $path = "../img/product/prod$row[product_id].png";
            blobToImage($img, $path);
            $product_id = $row['product_id'];
            $product_img = "prod$row[product_id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" />
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($product_id); ?>
                    </div>
                </div>

                <?php
            else:
                ?>

                <div
                    class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" />
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px]">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['$'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($product_id); ?>
                    </div>
                </div>

                <?php
            endif;
        }
    } else {
        ?>
        <div class='w-full h-screen flex justify-center items-center'>
            <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg">No Result Found.</h1>
        </div>
        <?php
    }
}

/* 
 * Showing All Colour Buttons below of the Product
 */

function colourButtons($product_id)
{
    require "connection.php";

    $sql = "SELECT product_item.product_id, 
            product_item.colour_id, 
            colour.colour_value, 
            colour.hex_code 
            FROM colour JOIN product_item 
            WHERE colour.id = product_item.colour_id 
            AND product_item.product_id = ?";

    $query = $conn->prepare($sql);
    $query->bind_param("i", $product_id);
    $query->execute();

    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        ?>
        <div class="flex gap-2 ">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"
                    class="w-3 h-3 border bg-[<?= $row['hex_code'] ?>]"></a>
                <?php
            }
            ?>
        </div>
        <?php
    }
}

/* 
 * Show Product Colours in View Product Page
 */

function showProductColours($product_id, $selectedColour)
{
    require 'connection.php';

    $sql = "SELECT product_item.product_id, product_item.colour_id, colour.colour_value, colour.hex_code FROM colour JOIN product_item WHERE product_item.product_id = ? AND colour.id = product_item.colour_id";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        ?>
        <select name="colourOption" id="colourOption">
            <?php
            while ($row = $result->fetch_assoc()) {
                if ($row['colour_id'] == $selectedColour):
                    ?>
                    <option data-link='<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>'
                        data-colour-value="<?= $row['colour_value'] ?>" value="<?= $row['colour_id'] ?>" selected>
                        <?= $row['colour_value'] ?>
                    </option>
                    <?php
                else:
                    ?>
                    <option data-link='<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>'
                        data-colour-value="<?= $row['colour_value'] ?>" value="<?= $row['colour_id'] ?>">
                        <?= $row['colour_value'] ?>
                    </option>
                    <?php
                endif;
            }
            ?>
        </select>
        <?php
    } else {
        echo "Item Stock is out of Sizes.";
    }
}

/* 
 * Show Product Sizes in View Product Page | Radio Buttons
 */

function showProductSizes($product_id, $colour_id)
{
    require "connection.php";

    $sql = "SELECT size.* FROM size";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        ?>
        <div class="flex flex-wrap gap-2">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <input data-size-value="<?= $row['size_value'] ?>" class="hidden" type="radio" id="<?= $row['size_value'] ?>"
                    name="size" <?= areSizesAvailable($product_id, $colour_id, $row['size_value']) ? "" : 'disabled' ?> />
                <label class="w-8 h-8 border border-black rounded-full grid place-items-center" for="<?= $row['size_value'] ?>">
                    <span>
                        <?= $row['size_value'] ?>
                    </span>
                </label>
                <?php
            }
            ?>
        </div>
        <?php
    }
}

/* 
 * Check if the Product Sizes are Available or not
 */

function areSizesAvailable($product_id, $color_id, $size_value)
{
    require 'connection.php';

    if ($color_id == 0) {
        $sql = "SELECT colour_id FROM product_item WHERE product_id = ? LIMIT 1";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $product_id);
        $query->execute();
        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $color_id = $row['colour_id'];
        }
    }

    $sql = "SELECT COUNT(*) as count FROM product_item
            WHERE product_id = ? AND colour_id = ? AND size_id = (
                SELECT id FROM size WHERE size_value = ?
            )";

    $query = $conn->prepare($sql);
    $query->bind_param('iis', $product_id, $color_id, $size_value);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }

    return false;
}

/* 
 * Show Navbar Links Dynamically on Mobile
 */

function showNavLinkMobile() {
    require "connection.php";

    $sql = "SELECT distinct
            category_name
            FROM
            category_tbl
            ORDER BY
            CASE
                WHEN category_name = 'MEN' THEN 1
                WHEN category_name = 'WOMEN' THEN 2
                WHEN category_name = 'COLLECTION' THEN 3
                ELSE 4
            END";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
                <a class="pl-5 py-3 text-[1.1rem] hover:underline hover:bg-slate-200 font-medium" href="<?= "/nstudio/$row[category_name].php" ?>">
                    <?= $row['category_name'] ?>
                </a>
            <?php
        }
    }
}

/* 
 * Show Navbar Links Dynamically on Desktop
 */

function showNavLinkDesktop() {
    require "connection.php";

    $sql = "SELECT distinct
            category_name
            FROM
            category_tbl
            ORDER BY
            CASE
                WHEN category_name = 'MEN' THEN 1
                WHEN category_name = 'WOMEN' THEN 2
                WHEN category_name = 'COLLECTION' THEN 3
                ELSE 4
            END";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <li>
                <a class="nav_links uppercase" id="NAV_LINK" href="<?= "/nstudio/$row[category_name].php" ?>">
                    <?= $row['category_name'] ?>
                </a>

                <div
                    class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                    <div class="w-full h-full m-auto flex">
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <?php showLinkCategory($row['category_name']) ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
    }
}

/* 
 * Showing Extra Link Category via Hover Navbar
 */

function showLinkCategory($product_category)
{
    require "connection.php";

    $sql = "SELECT distinct
            product_type.*,
            product_tbl.product_category category
            FROM
            product_type
            JOIN product_tbl ON product_tbl.product_category = '$product_category'
            AND product_tbl.product_type_id = product_type.id LIMIT 8;";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <a class="capitalize" href="/nstudio/views/search.php?type=<?= $row['id']?>&category='<?= $row['category'] ?>'"><?= $row['type_value'] ?></a>
            <?php
        }
    }
}

/* 
 * 
 */