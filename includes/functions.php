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

function newMenProduct($table = "product_tbl")
{
    require "connection.php";

    $sql = "SELECT * FROM $table WHERE product_category='MEN' && product_new=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_img'];
        $path = "img/product/prod" . $row['product_id'] . ".png";

        $product_img = "prod" . $row['product_id'] . ".png";
        blobToImage($img, $path);

        if ($row['product_category'] === "MEN" && $row['product_new'] == 1) {
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
}

function newWomenProduct($table = "product_tbl")
{
    require  "connection.php";

    $sql = "SELECT * FROM $table WHERE product_category='WOMEN' && product_new=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_img'];
        $path = "img/product/prod" . $row['product_id'] . ".png";
        
        $product_img = "prod" . $row['product_id'] . ".png";
        blobToImage($img, $path);

        if ($row['product_category'] === "WOMEN" && $row['product_new'] == 1) {
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
}

function cartCount($table, $columnID = "id", $id)
{
    require "connection.php";

    $sql = "SELECT * FROM $table WHERE $columnID=$id";
    $result = $conn->query($sql);

    return $result->num_rows;
}
