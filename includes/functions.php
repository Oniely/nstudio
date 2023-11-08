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
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]" ?>">→ VIEW</a>
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
                        <div class="flex gap-2 ">
                            <button class="w-3 h-3 bg-[#211f22]"></button>
                            <button class="w-3 h-3 bg-[#524947]"></button>
                            <button class="w-3 h-3 bg-[#8c7975]"></button>
                        </div>
                    </div>
                </div>

                <?php
            else:
                ?>

                <div
                    class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]" ?>">→ VIEW</a>
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
                        <div class="flex gap-2 ">
                            <button class="w-3 h-3 bg-[#211f22]"></button>
                            <button class="w-3 h-3 bg-[#524947]"></button>
                            <button class="w-3 h-3 bg-[#8c7975]"></button>
                        </div>
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
            class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]" ?>">→ VIEW</a>
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
                <div class="flex gap-2 ">
                    <button class="w-3 h-3 bg-[#211f22]"></button>
                    <button class="w-3 h-3 bg-[#524947]"></button>
                    <button class="w-3 h-3 bg-[#8c7975]"></button>
                </div>
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
            class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]" ?>">→ VIEW</a>
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
                <div class="flex gap-2 ">
                    <button class="w-3 h-3 bg-[#211f22]"></button>
                    <button class="w-3 h-3 bg-[#524947]"></button>
                    <button class="w-3 h-3 bg-[#8c7975]"></button>
                </div>
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

function deleteItem($column, $product_id)
{
    require "connection.php";

    $sql = "DELETE FROM product_tbl WHERE $column = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $product_id);
    $query->execute();

    if ($query->affected_rows > 0) {
        echo "Successfully Deleted";
    }
}

function showCartProducts($userID)
{

    require 'connection.php';

    $sql = "SELECT * FROM cart_tbl WHERE user_id=$userID";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql = "SELECT cart_tbl.user_id, cart_tbl.product_item_id,cart_tbl.quantity cart_quantity, product_item.* FROM cart_tbl JOIN product_item WHERE cart_tbl.product_item_id = product_item.id AND cart_tbl.user_id = $userID;";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $subtotal = 0;
                while ($row = $result->fetch_assoc()) {
                    ?>

                    <a href="<?= "/nstudio/views/product.php?id=$row[product_id]" ?>">
                        <img src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
                    </a>
                    <button class="bg-red-400 px-2 minusBtn" data-item-id="<?= $row['product_item_id'] ?>">-</button>
                    <span class="quantityCount" data-quantity-id="<?= $row['product_item_id'] ?>">
                        <?= $row['cart_quantity']; ?>
                    </span>
                    <button class="bg-green-400 px-2 addBtn" data-item-id="<?= $row['product_item_id'] ?>">+</button>
                    <span data-price-id="<?= $row['product_item_id'] ?>">
                        <?= $row['price'] * $row['cart_quantity'] ?>
                    </span>
                    <?php
                    $subtotal += $row['price'];
                }
                ?>

                <?php
            }
        }
    } else {
        ?>
        <h1 class="text-2xl bg-slate-200 p-8 rounded-lg">No Item in Cart</h1>
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

            $product_img = "prod$row[product_id].png";
            if ($row['product_new'] != 1):
                ?>

                <div class="w-[276px] h-auto mb-[1.5rem] relative">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]" ?>">→ VIEW</a>
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
                        <div class="flex gap-2 ">
                            <button class="w-3 h-3 bg-[#211f22]"></button>
                            <button class="w-3 h-3 bg-[#524947]"></button>
                            <button class="w-3 h-3 bg-[#8c7975]"></button>
                        </div>
                    </div>
                </div>

                <?php
            else:
                ?>

                <div
                    class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]" ?>">→ VIEW</a>
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
                        <div class="flex gap-2 ">
                            <button class="w-3 h-3 bg-[#211f22]"></button>
                            <button class="w-3 h-3 bg-[#524947]"></button>
                            <button class="w-3 h-3 bg-[#8c7975]"></button>
                        </div>
                    </div>
                </div>

                <?php
            endif;
        }
    }
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
    elseif($type === "success"):
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