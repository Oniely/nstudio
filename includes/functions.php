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

function newMenProduct($table)
{
    include "connection.php";

    $sql = "SELECT * FROM $table WHERE prod_category='MEN' && NEW_ARRIVAL=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['prod_img'];
        $path = "img/product/prod" . $row['id'] . ".png";

        $product_img = "prod" . $row['id'] . ".png";
        blobToImage($img, $path);

        if ($row['prod_category'] === "MEN" && $row['NEW_ARRIVAL'] == 1) {
        ?>
        <div
            class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10 animate__animated slideUp">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="#">→ VIEW</a>
                <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
            </div>
            <div class="flex flex-col gap-2 px-4 py-3">
                <div class="overflow-hidden text-[13px] font-medium">
                    <div class="overflow-hidden">
                        <h3 class="tracking-widest slideUp animate__animated delay-200 mb-[2px]">
                            <?= $row['prod_name'] ?>
                        </h3>
                    </div>
                    <h3 class="tracking-widest slideUp animate__animated delay-200 before:content-['$'] before:mr-[-3px]">
                        <?= $row['prod_price'] ?>
                    </h3>
                </div>
                <div class="flex gap-2 slideUp animate__animated">
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

function newWomenProduct($table)
{
    include "connection.php";

    $sql = "SELECT * FROM $table WHERE prod_category='WOMEN' && NEW_ARRIVAL=1 LIMIT 4";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['prod_img'];
        $path = "img/product/prod" . $row['id'] . ".png";

        $product_img = "prod" . $row['id'] . ".png";
        blobToImage($img, $path);

        if ($row['prod_category'] === "WOMEN" && $row['NEW_ARRIVAL'] == 1) {
            ?>
                    <div
                        class="w-[276px] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:bg-black before:text-white before:text-[10px] before:font-['Lato'] before:p-1 before:px-4 before:font-semibold before:tracking-widest before:z-10 animate__animated slideUp">
                        <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                            <a class="magnet-dot" href="<?= "../views/product.php/id=$row[id]" ?>">→ VIEW</a>
                            <img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" />
                        </div>
                        <div class="flex flex-col gap-2 px-4 py-3">
                            <div class="overflow-hidden text-[13px] font-medium">
                                <div class="overflow-hidden">
                                    <h3 class="tracking-widest slideUp animate__animated delay-200 mb-[2px]">
                                        <?= $row['prod_name'] ?>
                                    </h3>
                                </div>
                                <h3 class="tracking-widest slideUp animate__animated delay-200 before:content-['$'] before:mr-[-3px]">
                                    <?= $row['prod_price'] ?>
                                </h3>
                            </div>
                            <div class="flex gap-2 slideUp animate__animated">
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

function selectRow($table, $id, $idName = "id")
{
    include "connection.php";

    $sql = "SELECT * FROM $table WHERE $idName=$id";
    $result = $conn->query($sql)->fetch_row();

    return $result;
}


