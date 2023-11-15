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

function showAllMenProduct()
{
    require "connection.php";

    $sql = "SELECT * FROM product_tbl WHERE product_category='MEN'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image'];
            $path = "img/product/prod$row[product_id].png";
            blobToImage($img, $path);

            $product_img = "prod$row[product_id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
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
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
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

function showAllWomenProduct()
{
    require "connection.php";

    $sql = "SELECT * FROM product_tbl WHERE product_category='WOMEN'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image'];
            $path = "img/product/prod$row[product_id].png";
            blobToImage($img, $path);

            $product_img = "prod$row[product_id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
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
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                        <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
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

function newMenProduct()
{
    require "connection.php";

    $sql = "SELECT * FROM product_tbl WHERE product_category='MEN' AND product_new=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image'];
        $path = "img/product/prod" . $row['product_id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['product_id'] . ".png";
        ?>
        <div
            class="w-[276px] md:w-[230px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:md:px-2 before:font-semibold before:tracking-widest before:z-10">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
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

function newWomenProduct()
{
    require "connection.php";

    $sql = "SELECT * FROM product_tbl WHERE product_category='WOMEN' AND product_new=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image'];
        $path = "img/product/prod" . $row['product_id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['product_id'] . ".png";
        ?>
        <div
            class="w-[276px] md:w-[230px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:md:px-2 before:font-semibold before:tracking-widest before:z-10">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=0" ?>">→ VIEW</a>
                <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
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



function showCartProducts($userID)
{

    require 'connection.php';

    $sql = "SELECT
            cart_tbl.user_id,
            cart_tbl.product_item_id,
            cart_tbl.quantity cart_quantity,
            product_item.*,
            product_tbl.product_price price
            FROM
            cart_tbl
            JOIN product_item
            JOIN product_tbl ON product_item.product_id = product_tbl.product_id
            WHERE
            cart_tbl.product_item_id = product_item.id
            AND cart_tbl.user_id = $userID;";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $subtotal = 0;
        while ($row = $result->fetch_assoc()) {
            ?>

            <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]'" ?>">
                <img src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
            </a>
            <span>

            </span>
            <!-- MINUS QUANTITY -->
            <button class="bg-red-400 px-2 minusBtn" data-item-id="<?= $row['product_item_id'] ?>">
                -
            </button>
            <!-- CART PRODUCT ITEM QUANTITY -->
            <span class="quantityCount" data-quantity-id="<?= $row['product_item_id'] ?>">
                <?= $row['cart_quantity']; ?>
            </span>
            <!-- ADD QUANTITY -->
            <button class="bg-green-400 px-2 addBtn" data-item-id="<?= $row['product_item_id'] ?>">
                +
            </button>
            <!-- Price -->
            <span data-price-id="<?= $row['product_item_id'] ?>">
                <?= $row['price'] * $row['cart_quantity'] ?>
            </span>
            <?php
            $subtotal += $row['price'] * $row['cart_quantity'];
        }
        ?>
        <span id="subtotal">
            <?= $subtotal ?>
        </span>

        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="popup-btn"
            class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Toggle modal
        </button>
        <div id="popup-modal" tabindex="-1"
            class="fixed top-0 left-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 justify-center items-center w-full h-screen max-h-full">
            <div class="relative mt-[10rem] mx-auto w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button id="closeBtn" type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg clas s="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                            delete
                            this product?</h3>
                        <button id="confirmBtn" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button id="cancelBtn" data-modal-hide="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <h1 class="text-2xl bg-slate-200 p-6 rounded-lg">No item in cart.</h1>
        <?php
    }
}

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

function colourButtons($product_id)
{
    require "connection.php";

    $sql = "SELECT product_item.product_id, product_item.colour_id, colour.colour_value, colour.hex_code FROM colour JOIN product_item WHERE colour.id = product_item.colour_id AND product_item.product_id = ?;";
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

function alert($type = "success", $head = "Alert", $desc = "This is an Alert!")
{
    if ($type === "info"):
        ?>
        <div class="text-center py-4 lg:px-4 absolute">
            <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">
                    <?= $head ?>
                </span>
                <span class="font-semibold mr-2 text-left flex-auto">
                    <?= $desc ?>
                </span>
            </div>
        </div>
        <?php
    elseif ($type === "success"):
        ?>
        <div class="text-center py-4 lg:px-4 absolute">
            <div class="p-2 bg-green-700 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-green-600 uppercase px-2 py-1 text-xs font-bold mr-3">
                    <?= $head ?>
                </span>
                <span class="font-semibold mr-2 text-left flex-auto">
                    <?= $desc ?>
                </span>
            </div>
        </div>
        <?php
    endif;
}