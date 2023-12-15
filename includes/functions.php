<?php

function dd($value)
{
    var_dump("<pre>$value</pre>");
    die(1);
}

function hash_password($passw)
{
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($passw, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
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

/* SHOWING OF PRODUCTS START */

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
            JOIN 
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = 'MEN'
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image1'];
            $path = "img/product/prod" . $row['id'] . ".png";
            blobToImage($img, $path);

            $product_img = "prod" . $row['id'] . ".png";
            if ($row['quantity'] > 0) :
?>
                <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative <?= $row['product_new'] == 1 ? "before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10" : '' ?>">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
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
            JOIN 
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = 'WOMEN'
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image1'];
            $path = "img/product/prod" . $row['id'] . ".png";
            blobToImage($img, $path);

            $product_img = "prod" . $row['id'] . ".png";
            if ($row['quantity'] > 0) :
            ?>
                <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative <?= $row['product_new'] == 1 ? "before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10" : '' ?>">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
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

function checkMenProduct()
{
    require "connection.php";

    $sql = "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = 'MEN' AND product_tbl.product_new = 1
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()
            LIMIT 4";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function newMenProduct()
{
    require "connection.php";

    $sql = "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = 'MEN' AND product_tbl.product_new = 1
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()
            LIMIT 4";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image1'];
        $path = "img/product/prod" . $row['id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['id'] . ".png";
        if ($row['quantity'] > 0) :
            ?>
            <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10">
                <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                    <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                    <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
                </div>
                <div class="flex flex-col gap-2 px-4 py-3">
                    <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                        <div class="overflow-hidden">
                            <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                <?= $row['product_name'] ?>
                            </h3>
                        </div>
                        <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
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

/* 
 * Show All Women New Arrival Product
 */

function checkWomenProduct()
{
    require "connection.php";

    $sql = "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = 'WOMEN' AND product_tbl.product_new = 1
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()
            LIMIT 4";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function newWomenProduct()
{
    require "connection.php";

    $sql = "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_category = 'WOMEN' AND product_tbl.product_new = 1
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()
            LIMIT 4";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $img = $row['product_image1'];
        $path = "img/product/prod" . $row['id'] . ".png";
        blobToImage($img, $path);

        $product_img = "prod" . $row['id'] . ".png";
        if ($row['quantity'] > 0) :
        ?>
            <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10">
                <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                    <a class="magnet-dot" href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                    <a href="<?= "./views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "img/product/$product_img" ?>" alt="product" /></a>
                </div>
                <div class="flex flex-col gap-2 px-4 py-3">
                    <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                        <div class="overflow-hidden">
                            <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                <?= $row['product_name'] ?>
                            </h3>
                        </div>
                        <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
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

/* 
 * Show Searched Product by Keyword
 */

function showSearchProduct($keyword)
{
    require 'connection.php';

    $key = "%$keyword%";

    $sql = "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.keywords LIKE ?
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()";

    $query = $conn->prepare($sql);
    $query->bind_param('s', $key);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image1'];
            $path = "../img/product/prod" . $row['id'] . ".png";
            blobToImage($img, $path);

            $product_img = "prod" . $row['id'] . ".png";

            if ($row['quantity'] > 0) :
            ?>
                <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative <?= $row['product_new'] == 1 ? "before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10" : '' ?>">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>
        <?php
            endif;
        }
    } else {
        ?>
        <div class='w-full h-screen flex justify-center items-center md:col-span-full'>
            <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg whitespace-nowrap">No Result Found.</h1>
        </div>
        <?php
    }
}

/* 
 * Show Search Product by Type and Category when The Hover Navbar is clicked
 */

function showSearchProductByType($type_id, $category)
{
    require "connection.php";

    $sql = "SELECT
                product_tbl.*,
                product_item.*
            FROM
                product_tbl
            JOIN
                product_item ON product_tbl.product_id = product_item.product_id
            WHERE
                product_tbl.product_type_id = ? AND product_tbl.product_category = ?
            GROUP BY
                product_tbl.product_id, product_item.colour_id
            ORDER BY
                RAND()";

    $query = $conn->prepare($sql);
    $query->bind_param("is", $type_id, $category);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = $row['product_image1'];
            $path = "../img/product/prod" . $row['id'] . ".png";

            blobToImage($img, $path);
            $product_id = $row['product_id'];
            $product_img = "prod" . $row['id'] . ".png";

            if ($row['quantity'] > 0) :
        ?>

                <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative <?= $row['product_new'] == 1 ? "before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10" : '' ?>">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>

        <?php
            endif;
        }
    } else {
        ?>
        <div class='w-full h-screen flex justify-center items-center'>
            <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg">No Result Fousnd.</h1>
        </div>
        <?php
    }
}

function checkSuggestionProduct($product_id, $product_item_id)
{
    require 'connection.php';

    $sql = "SELECT
            pi.*, pt.* 
            FROM product_tbl pt
            JOIN product_item pi ON pt.product_id = pi.product_id
            WHERE pt.product_category = (
                SELECT
                product_category
                FROM
                product_tbl
                WHERE
                product_id = ?
            ) 
            AND pi.id <> ?
            AND pt.product_id <> ?
            ORDER BY RAND() LIMIT 4";

    $query = $conn->prepare($sql);
    $query->bind_param("iii", $product_id, $product_item_id, $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function showSuggestionProduct($product_id, $product_item_id)
{
    require 'connection.php';

    $sql = "SELECT pi.*, pt.* 
            FROM product_tbl pt
            JOIN product_item pi ON pt.product_id = pi.product_id
            WHERE pt.product_category = (
                SELECT product_category
                FROM product_tbl
                WHERE product_id = ?
            ) 
            AND pi.id <> ?
            AND pi.product_id <> ?
            GROUP BY pi.product_id, pt.product_id
            ORDER BY RAND() LIMIT 4";

    $query = $conn->prepare($sql);
    $query->bind_param("iii", $product_id, $product_item_id, $product_id);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $img = $row['product_image1'];
            $path = "../img/product/prod" . $row['id'] . ".png";
            blobToImage($img, $path);

            $product_img = "prod" . $row['id'] . ".png";
            if ($row['quantity']) :
        ?>
                <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative <?= $row['product_new'] == 1 ? "before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem] before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10" : '' ?>">
                    <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                        <a class="magnet-dot" href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">→ VIEW</a>
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>"><img class="w-full h-full object-cover" src="<?= "/nstudio/img/product/$product_img" ?>" alt="product" /></a>
                    </div>
                    <div class="flex flex-col gap-2 px-4 py-3">
                        <div class="overflow-hidden text-[13px] sm:text-[12px] xs:text-[10px] text-ellipsis font-medium">
                            <div class="overflow-hidden">
                                <h3 class="tracking-widest mb-[2px] whitespace-nowrap text-ellipsis overflow-x-hidden">
                                    <?= $row['product_name'] ?>
                                </h3>
                            </div>
                            <h3 class="tracking-widest before:content-['₱'] before:mr-[-3px]">
                                <?= $row['product_price'] ?>
                            </h3>
                        </div>
                        <?php colourButtons($row['product_id']); ?>
                    </div>
                </div>
            <?php
            endif;
        endwhile;
    }
}

/* 
 * Showing Showcase Product
 */

function fetchImagesForShowcase()
{
    require "connection.php";

    $sql = "SELECT * 
            FROM product_item 
            GROUP BY product_id
            ORDER BY RAND() LIMIT 4";
    $result = $conn->query($sql);
    $imageData = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $outputPath = "./img/product/prod" . $row['id'] . ".png";

            // Convert blob data to image and save
            $conversionResult = blobToImage($row['product_image1'], $outputPath);

            if ($conversionResult) {
                // If conversion is successful, store the image path along with product_id and colour_id
                $imageData[] = [
                    'image' => $outputPath,
                    'product_id' => $row['product_id'],
                    'colour_id' => $row['colour_id'],
                ];
            }
        }
    }
    return $imageData;
}

/* SHOWING OF PRODUCTS END  */

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

function showCheckOutProducts($userID)
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
        $product_items = [];
        while ($row = $result->fetch_assoc()) {
            $product_items[$row['product_item_id']] = ["quantity" => $row['cart_quantity'], "price" => $row['price']];
            ?>
            <div class="flex justify-between items-start w-full min-w-[40vw] md:min-w-[min(100%,30rem)] border-b py-3 pr-2">
                <div class="flex justify-between items-start gap-5 w-[min(100%,30rem)]">
                    <div class="w-28 h-40 shrink-0 relative">
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">
                            <img class="max-w-full h-full object-cover aspect-square object-top" src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
                        </a>
                        <span class="absolute -top-1 -right-1 w-5 bg-red-300 text-center text-sm rounded-full"><?= $row['cart_quantity'] ?></span>
                    </div>
                    <div class="w-full flex flex-col items-start gap-1 text-start text-[14px]">
                        <h3 class="text-[15px]"><?= $row['product_name'] ?></h3>
                        <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
                    </div>
                </div>

                <div>
                    <span class="before:content-['₱']"><?= $row['price'] * $row['cart_quantity'] ?> </span>
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
 * Show Buy Now Product for Checkout
 */

function showBuyNowProduct($product_id, $colour_id, $size_id)
{
    require 'connection.php';

    $sql = "SELECT
            product_item.*,
            product_item.id product_item_id,
            colour.id colour_id,
            colour.colour_value,
            size.size_value,
            product_tbl.product_id,
            product_tbl.product_name,
            product_tbl.product_price price
            FROM
            product_item
            INNER JOIN product_tbl ON product_item.product_id = product_tbl.product_id
            INNER JOIN colour ON product_item.colour_id = colour.id
            INNER JOIN size ON product_item.size_id = size.id
            WHERE
            product_item.product_id = ?
            AND product_item.colour_id = ?
            AND product_item.size_id = ?";

    $query = $conn->prepare($sql);
    $query->bind_param('iii', $product_id, $colour_id, $size_id);
    $query->execute();

    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if ($result && $result->num_rows > 0) {
        $subtotal = 0;
        $product_items = [];
        $product_items[$row['product_item_id']] = ["quantity" => 1, "price" => $row['price']];
        if ($row['quantity'] <= 0) {
            echo "Product is out of stock";
            exit();
        }
        ?>
        <div class="flex justify-between items-start w-full min-w-[40vw] md:min-w-[min(100%,30rem)] border-b py-3 pr-2">
            <div class="flex justify-between items-start gap-5 w-[min(100%,30rem)]">
                <div class="w-28 h-40 shrink-0 relative">
                    <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">
                        <img class="max-w-full h-full object-cover aspect-square object-top" src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
                    </a>
                    <span class="absolute -top-1 -right-1 w-5 bg-red-300 text-center text-sm rounded-full"><?= 1 ?></span>
                </div>
                <div class="w-full flex flex-col items-start gap-1 text-start text-[14px]">
                    <h3 class="text-[15px]"><?= $row['product_name'] ?></h3>
                    <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
                </div>
            </div>

            <div>
                <span class="before:content-['₱']"><?= $row['price'] ?> </span>
            </div>
        </div>
        <?php
        $subtotal += $row['price'];
    } else {
        echo "No Result Found.";
        exit();
    }
    $_SESSION['product_items'] = $product_items;
    $_SESSION['BUYNOW'] = true;
    return $subtotal;
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
            if ($row['quantity'] > 0) :
        ?>
                <div class="flex justify-between items-start w-full min-w-[50vw] md:min-w-[min(100%,30rem)] border-b py-3 font-['Lato'] pr-2">
                    <div class="flex justify-between items-start gap-5 w-[min(100%,20rem)]">
                        <div class="w-32 h-40 shrink-0">
                            <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>" alt="product">
                                <img class="max-w-full h-full object-cover aspect-square object-top" src="<?= "/nstudio/img/product/" . $row['product_item_id'] . "_image1.png" ?>" alt="product">
                            </a>
                        </div>
                        <div class="w-full flex flex-col items-start gap-1 text-start text-[14px]">
                            <h3 class="[word-spacing:2px] text-[15px] uppercase tracking-tight font-medium"><?= $row['product_name'] ?></h3>
                            <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
                            <div class="flex gap-3">
                                <!-- Left off trying to add edit product on cart like lunya probably ajax -->
                                <button data-product-id="<?= $row['product_id'] ?>" data-item-id="<?= $row['product_item_id'] ?>" class="underline editItem">Edit</button>
                                <button data-delete-item-id="<?= $row['product_item_id'] ?>" class="underline removeItem">Remove</button>
                            </div>
                            <div class="hidden md:flex justify-center items-center w-14 border mt-10">
                                <button class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 minusBtn" data-item-id="<?= $row['product_item_id'] ?>">
                                    -
                                </button>
                                <span class="text-gray-600 font-[Open] text-sm quantityCount" data-quantity-id="<?= $row['product_item_id'] ?>">
                                    <?= $row['cart_quantity']; ?>
                                </span>
                                <button class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 addBtn" data-item-id="<?= $row['product_item_id'] ?>">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex md:hidden justify-center items-center w-14 border mt-0 ml-2">
                        <button class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 minusBtn" data-item-id="<?= $row['product_item_id'] ?>">
                            -
                        </button>
                        <span class="text-gray-600 font-[Open] text-sm quantityCount" data-quantity-id="<?= $row['product_item_id'] ?>"><?= $row['cart_quantity']; ?></span>
                        <button class="flex-grow hover:bg-slate-100 text-gray-300 hover:text-gray-500 transition-colors delay-100 addBtn" data-item-id="<?= $row['product_item_id'] ?>">
                            +
                        </button>
                    </div>
                    <div class="pl-4">
                        <p class="before:content-['₱'] whitespace-nowrap" data-price-id="<?= $row['product_item_id'] ?>">
                            <?= $row['price'] * $row['cart_quantity'] ?>
                        </p>
                    </div>
                </div>
        <?php
                $subtotal += $row['price'] * $row['cart_quantity'];
            endif;
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

function checkSearchKey($keyword)
{
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
 * Showing All Colour Buttons below of the Product
 */

function colourButtons($product_id)
{
    require "connection.php";

    $sql = "SELECT DISTINCT product_item.product_id, 
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
                <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>" class="w-3 h-3 border bg-[<?= $row['hex_code'] ?>]"></a>
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


function showProductColours($product_id, $colour_id)
{
    require "connection.php";

    $sql = "SELECT DISTINCT product_item.product_id, 
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
        while ($row = $result->fetch_assoc()) {
            if ($row['hex_code'] == "#FFFFFF" || $row['hex_code'] == '#F5F5F5') {
                $row['hex_code'] = '#E5E5E5';
            }
        ?>
            <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">
                <div class="w-5 h-4 bg-[<?= $row['hex_code'] ?>] active:border-[3px] active:border-[#cecece] active:border-double hover:border-[2px] hover:border-double <?= $row['colour_id'] == $colour_id ? 'border-[3px] border-[#cecece] border-double' : '' ?>"></div>
            </a>
        <?php
        }
    }
}

function showProductColoursMobile($product_id, $colour_id)
{
    require "connection.php";

    $sql = "SELECT DISTINCT product_item.product_id, 
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
        while ($row = $result->fetch_assoc()) {
            if ($row['hex_code'] == "#FFFFFF" || $row['hex_code'] == '#F5F5F5') {
                $row['hex_code'] = '#E5E5E5';
            }
        ?>
            <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">
                <div class="w-8 sm:w-6 h-6 sm:h-5 bg-[<?= $row['hex_code'] ?>] active:border-[3px] active:border-[#cecece] active:border-double <?= $row['colour_id'] == $colour_id ? 'border-[3px] border-[#cecece] border-double' : '' ?>"></div>
            </a>
        <?php
        }
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
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="group relative w-10 h-9 border border-black grid place-items-center">
                <input data-size-id="<?= $row['id'] ?>" class="hidden peer" type="radio" name="size" id="<?= $row['size_value'] ?>" <?= areSizesAvailable($product_id, $colour_id, $row['size_value']) ? "" : 'disabled' ?> />
                <label class="active:bg-[#303030] active:text-white peer-checked:bg-[#151515] peer-checked:text-white hover:bg-[#151515] hover:text-white peer-disabled:bg-gray-200 text-sm uppercase w-full h-full grid place-items-center cursor-pointer relative" for="<?= $row['size_value'] ?>">
                    <span><?= $row['size_value'] ?></span>
                </label>
                <svg class="w-full h-full absolute hidden peer-disabled:block" viewBox="0 0 10 10" preserveAspectRatio="none">
                    <line x1="0" y1="0" x2="10" y2="10" stroke="black" stroke-width="0.3" />
                </svg>
            </div>
        <?php
        }
    }
}

function showProductSizesMobile($product_id, $colour_id)
{
    require "connection.php";

    $sql = "SELECT size.* FROM size";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        ?>
            <div class="group relative w-16 sm:w-12 h-12 sm:h-10 border border-black grid place-items-center">
                <input data-size-id="<?= $row['id'] ?>" class="hidden peer" type="radio" name="size" id="<?= $row['size_value'] ?>" <?= areSizesAvailable($product_id, $colour_id, $row['size_value']) ? "" : 'disabled' ?> />
                <label class="active:bg-[#303030] active:text-white peer-checked:bg-[#151515] peer-checked:text-white peer-disabled:bg-gray-200 hover:bg-[#151515] hover:text-white text-[15px] uppercase w-full h-full grid place-items-center cursor-pointer relative" for="<?= $row['size_value'] ?>">
                    <span><?= $row['size_value'] ?></span>
                </label>
                <svg class="w-full h-full absolute hidden peer-disabled:block" viewBox="0 0 10 10" preserveAspectRatio="none">
                    <line x1="0" y1="0" x2="10" y2="10" stroke="black" stroke-width="0.2" />
                </svg>
            </div>
        <?php
        }
    }
}

/* 
 * Check if the Product Sizes are Available or not
 */

function areSizesAvailable($product_id, $color_id, $size_value)
{
    require 'connection.php';

    $sql = "SELECT COUNT(*) as count FROM product_item
            WHERE product_id = ? AND colour_id = ? AND size_id = (
                SELECT id FROM size WHERE size_value = ?
            ) AND quantity > 0";

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
 * Showing Extra Link Category via Hover Navbar
 */

function checkLinkCategory($product_category)
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
        return true;
    } else {
        return false;
    }
}

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
            <a class="capitalize" href="<?= "/nstudio/views/search.php?type=$row[id]&category=$row[category]" ?>">
                <?= $row['type_value'] ?>
            </a>
        <?php
        }
    }
}

/* 
 * Address Default
 */

function checkAddressDefault($userID)
{
    require "connection.php";

    $sql = "SELECT * FROM user_address WHERE user_id = ? AND is_default = 1";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function addressDefault($userID)
{
    require "connection.php";

    $sql = "SELECT * FROM user_address WHERE user_id = ? AND is_default = 1";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['address_id'];
    } else {
        return;
    }
}

function clearUserAddressDefaults($userID)
{
    require "connection.php";

    $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
    $updateQuery = $conn->prepare($updateSql);
    $updateQuery->bind_param("i", $userID);
    $updateQuery->execute();

    if ($updateQuery) {
        return true;
    } else {
        return false;
    }
}

function checkUserAddress($userID, $addressID)
{
    require "connection.php";

    $sql = "SELECT * FROM user_address WHERE user_id = ? and address_id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('ii', $userID, $addressID);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function showUserAddress($userID)
{
    require "connection.php";

    $sql = "SELECT * FROM user_address WHERE user_id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('i', $userID);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
            $sql = "SELECT * FROM address_tbl WHERE id = $row[address_id]";
            $address = $conn->query($sql);
            $address = $address->fetch_assoc();
        ?>
            <div class="w-[19rem] md:w-full flex flex-col border-[0.1px] border-[#505050] hover:shadow-xl hover:bg-[#f7f7f7] p-4 text-[15px] gap-3">
                <div class="font-semibold flex justify-between">
                    <h1><?= $row['is_default'] == 1 ? 'Default' : "" ?></h1>
                    <button class="deleteBtn p-1 active:scale-90" data-address-id="<?= $address['id'] ?>">
                        <img class="w-4 h-4 object-cover pointer-events-none" src="/nstudio/img/x.svg" alt="x">
                    </button>
                </div>
                <div class="font-medium leading-[1.2rem]">
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['fname'] . " " . $address['lname'] ?></p>
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['email'] ?></p>
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['street_name'] ?></p>
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['city'] . ", " .  $address['province'] ?></p>
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['postal_code'] ?></p>
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['country'] ?></p>
                    <p class="overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['contact_number'] ?></p>
                </div>
                <div class="flex justify-center items-center border border-[#505050] transition-colors delay-75 ease-in-out">
                    <button class="editBtn w-full h-full py-1 font-medium hover:text-white hover:bg-[#101010] active:bg-[#202020]" data-address-id="<?= $address['id'] ?>">Edit</button>
                </div>
            </div>
        <?php
        endwhile;
    } else {
        ?>
        <div class="h-[6rem] flex items-center">
            <h1>No added address yet.</h1>
        </div>
        <?php
    }
}

/* 
 * Dashboard
 */

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

// make this responsive and copy it to all the other order status function
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

            $shipMonth = $month[$shipDateTime->format('m')];
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
            $receivedMonth = $month[$dateTime->format('m')];
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
