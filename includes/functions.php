<?php

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

function showAllMenProduct() {
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

            <div class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
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
            <div class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
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
    require  "connection.php";

    $sql = "SELECT * FROM product_tbl WHERE product_category='WOMEN' AND product_new=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image'];
        $path = "img/product/prod" . $row['product_id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['product_id'] . ".png";
        ?>
            <div class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
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

function deleteItem($column, $product_id) {
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
            $sql = "SELECT cart_tbl.user_id, cart_tbl.product_id,cart_tbl.quantity, product_tbl.* FROM cart_tbl JOIN product_tbl WHERE cart_tbl.product_id = product_tbl.product_id AND cart_tbl.user_id = $userID;";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $subtotal = 0;
                while ($row = $result->fetch_assoc()) {
                    ?>

                    <a href="<?= "/nstudio/views/product.php?id=$row[product_id]" ?>">
                        <img src="<?= "/nstudio/img/product/prod" . $row['product_id'] . ".png" ?>" alt="product">
                    </a>
                    <button class="bg-red-400 px-2 minusBtn" data-product-id="<?= $row['product_id'] ?>">-</button>
                    <span class="quantityCount" data-quantity-id="<?= $row['product_id'] ?>" ><?= $row['quantity']; ?></span>
                    <button class="bg-green-400 px-2 addBtn" data-product-id="<?= $row['product_id'] ?>">+</button>
                    <span data-price-id="<?= $row['product_id'] ?>"> <?= $row['product_price'] * $row['quantity'] ?> </span>
                    <?php
                    $subtotal += $row['product_price'];
                }
                ?>
                
                <?php
            }
        }
    }
}

function showSearchProduct($keyword) {

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

            <div class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10">
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