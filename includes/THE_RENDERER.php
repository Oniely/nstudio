<?php

require_once 'THE_MYSQL.php';
require_once 'THE_FUNCTIONS.php';

class ProductRenderer
{
    public $db;

    const NEWSTYLE =
    "before:content-['NEW'] before:absolute before:top-[1rem] before:left-[-1.5rem]
    before:md:top-[0.8rem] before:sm:top-[0.5rem] before:md:left-[-0.5rem] before:bg-[#252525] 
    before:text-white before:text-[10px] before:sm:text-[8px] before:font-['Lato'] before:p-1 
    before:px-4 before:sm:px-2 before:font-semibold before:tracking-widest before:z-10";

    public function __construct(Mysql $db)
    {
        $this->db = $db;
    }

    public function blobToImage($blobData, $outputPath)
    {
        return blobToImageConverter($blobData, $outputPath);
    }

    public function showFallbackMessage($msg)
    {
?>
        <div class='w-full h-screen flex justify-center items-center md:col-span-full absolute top-0 left-0 z-10'>
            <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg whitespace-nowrap"><?= $msg ?></h1>
        </div>
        <?php
    }

    public function showColorButtons($product_id, $type = 'card')
    {
        $buttons = $this->db->getColorButtons($product_id);

        foreach ($buttons as $row) {
            $this->colorButtons($row, $type);
        }
    }

    public function colorButtons($row, $type = "card", $id = null)
    {
        $product_link = "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]";

        if ($type == 'card') {
        ?>
            <a href="<?= "$product_link" ?>" class="w-3 h-3 border bg-[<?= $row['hex_code'] ?>]"></a>
        <?php
        } else if ($type == 'view') {
            if ($row['hex_code'] == "#FFFFFF" || $row['hex_code'] == '#F5F5F5') {
                $row['hex_code'] = '#E5E5E5';
            }
        ?>
            <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>">
                <div class="sm:w-6 sm:h-5 md:w-8 md:h-6 w-5 h-4 bg-[<?= $row['hex_code'] ?>] active:border-[3px] active:border-[#cecece] active:border-double hover:border-[2px] hover:border-double <?= $id != null && $row['colour_id'] == $id ? 'border-[3px] border-[#cecece] border-double' : '' ?>"></div>
            </a>
        <?php
        }
        /* add this to div on type view:  */
    }

    public function productCard($row, $path)
    {
        $product_link = "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]";
        $product_new = $row['product_new'] == 1 ? self::NEWSTYLE : "";
        ?>
        <div class="max-w-full w-[265px] md:w-[calc(100%+1.2rem)] h-auto mb-[1.5rem] relative <?= $product_new ?>">
            <div class="w-full relative hover:after:transition-all hover:after:delay-75 magnet">
                <a class="magnet-dot" href="<?= "$product_link" ?>">→ VIEW</a>
                <a href="<?= "$product_link" ?>"><img class="w-full h-full object-cover" src="<?= $path ?>" alt="product" /></a>
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
                <div class="flex gap-2"><?php $this->showColorButtons($row['product_id']); ?></div>
            </div>
        </div>
    <?php
    }

    public function showCaseImages($images)
    {
    ?>
        <div class="container h-full bg-[#252525]">
            <div class="flex md:hidden justify-center items-center w-full py-20 px-10 lg:px-6 gap-5">
                <div class="lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)] flex flex-col justify-between">
                    <div class="lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] lg:h-[clamp(13rem,31.25vw+-2rem,18rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)] h-[clamp(18rem,10.6154rem+11.5385vw,21rem)]">
                        <img class="w-full h-full object-contain" src="./img/big_new_title.png" alt="/" />
                    </div>
                    <!-- prettier-ignore -->
                    <div class="flex justify-between items-center lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)]">
                        <a href="<?= "/nstudio/views/product.php?id=" . $images[1]['product_id'] . "&colour=" . $images[1]['colour_id'] ?>"><img src="<?= $images[1]['image'] ?>" class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" alt="Showcase Image 1"></a>
                        <a href="<?= "/nstudio/views/product.php?id=" . $images[2]['product_id'] . "&colour=" . $images[2]['colour_id'] ?>"><img src="<?= $images[2]['image'] ?>" class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" alt="Showcase Image 2"></a>
                        <a href="<?= "/nstudio/views/product.php?id=" . $images[3]['product_id'] . "&colour=" . $images[3]['colour_id'] ?>"><img src="<?= $images[3]['image'] ?>" class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)] max-w-full object-cover object-top" alt="Showcase Image 3"></a>
                    </div>
                </div>
                <div class="lg:w-[clamp(32rem,23rem+18.75vw,35rem)] lg:h-[clamp(26.5rem,_59.375vw_+_-2rem,36rem)] w-[35rem] h-[clamp(36rem,21.2308rem+23.0769vw,42rem)]">
                    <a href="<?= "/nstudio/views/product.php?id=" . $images[0]['product_id'] . "&colour=" . $images[0]['colour_id'] ?>"><img src="<?= $images[0]['image'] ?>" class="w-full h-full object-cover object-top" alt="Big Hero" /></a>
                </div>
            </div>

            <div class="hidden md:flex flex-col justify-center items-center w-full p-12 px-16 md:px-6 gap-8 sm:gap-5 sm:px-[1rem]">
                <div class="xs:w-full w-[clamp(26rem,43.902vw+13.927rem,35rem)] xs:h-fit h-[clamp(11rem,19.512vw+5.634rem,15rem)]">
                    <img class="w-full h-full object-cover xs:object-contain" src="./img/big_new_title.png" alt="">
                </div>
                <div class="xs:w-full w-[clamp(26rem,43.902vw+13.927rem,35rem)]">
                    <a href="<?= "/nstudio/views/product.php?id=" . $images[0]['product_id'] . "&colour=" . $images[0]['colour_id'] ?>"><img class="w-full h-full object-cover object-top" src="<?= $images[0]['image'] ?>" alt="big_hero"></a>
                </div>
                <div class="flex justify-between items-center xs:gap-1 xs:w-full xs:h-fit w-[clamp(26rem,43.902vw+13.927rem,35rem)] h-[clamp(14rem,19.512vw+8.634rem,18rem)]">
                    <a href="<?= "/nstudio/views/product.php?id=" . $images[1]['product_id'] . "&colour=" . $images[1]['colour_id'] ?>"><img src="<?= $images[1]['image'] ?>" class="xs:flex-1 xs:basis-0 xs:w-auto xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" alt="Showcase Image1"></a>
                    <a href="<?= "/nstudio/views/product.php?id=" . $images[2]['product_id'] . "&colour=" . $images[2]['colour_id'] ?>"><img src="<?= $images[2]['image'] ?>" class="xs:flex-1 xs:basis-0 xs:w-auto xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" alt="Showcase Image2"></a>
                    <a href="<?= "/nstudio/views/product.php?id=" . $images[3]['product_id'] . "&colour=" . $images[3]['colour_id'] ?>"><img src="<?= $images[3]['image'] ?>" class="xs:flex-1 xs:basis-0 xs:w-auto xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" alt="Showcase Image3"></a>
                </div>
            </div>
        </div>
    <?php
    }

    public function categoryLinks($row)
    {
    ?>
        <a class="capitalize text-black" href="<?= "/nstudio/views/search.php?type=$row[id]&category=$row[category]" ?>">
            <?= $row['type_value'] ?>
        </a>
        <?php
    }

    public function cartProducts($row, $img_path)
    {
        if ($row['quantity'] > 0) :
        ?>
            <div data-item-id="<?= $row['id'] ?>" class="cartProduct flex justify-between items-start w-full min-w-[50vw] md:min-w-[min(100%,30rem)] border-b py-3 font-['Lato'] pr-2">
                <div class="flex justify-between items-start gap-5 w-[min(100%,20rem)]">
                    <div class="w-32 h-40 shrink-0">
                        <a href="<?= "/nstudio/views/product.php?id=$row[product_id]&colour=$row[colour_id]" ?>" alt="product">
                            <img class="max-w-full h-full object-cover aspect-square object-top" src="<?= $img_path ?>" alt="product">
                        </a>
                    </div>
                    <div class="w-full flex flex-col items-start gap-1 text-start text-[14px]">
                        <h3 class="[word-spacing:2px] text-[15px] uppercase tracking-tight font-medium"><?= $row['product_name'] ?></h3>
                        <div class="editContainer">
                            <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
                        </div>
                        <div class="flex gap-3">
                            <button class="hidden underline doneBtn">Done</button>
                            <button data-product-id="<?= $row['product_id'] ?>" data-item-id="<?= $row['product_item_id'] ?>" data-colour-value="<?= $row['colour_value'] ?>" class="underline editItem">Edit</button>
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
                    <span class="before:content-['₱'] whitespace-nowrap priceCount" data-price-id="<?= $row['product_item_id'] ?>">
                        <?= $row['price'] * $row['cart_quantity'] ?>
                    </span>
                </div>
            </div>
        <?php
        endif;
    }

    public function desktopViewProduct($row)
    {
        if ($row == null) {
            $this->showFallbackMessage("No product available.");
            return;
        }

        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $outputPathsArray = [
            $rootPath . "/nstudio/img/product/{$row['id']}_image1.png",
            $rootPath . "/nstudio/img/product/{$row['id']}_image2.png",
            $rootPath . "/nstudio/img/product/{$row['id']}_image3.png"
        ];

        $blobDataArray = [
            $row['product_image1'],
            $row['product_image2'],
            $row['product_image3']
        ];
        for ($i = 0; $i < count($blobDataArray); $i++) {
            $this->blobToImage($blobDataArray[$i], $outputPathsArray[$i]);
        }

        ?>
        <div class="parent-container container min-h-screen pt-[5rem] pb-[1rem] relative md:hidden">
            <div class="flex items-center font-semibold px-[4rem] lgt:px-[2rem]">
                <a class="after:content-['_/'] after:mx-2" href="../index.php">HOME</a>
                <a class="after:content-['_/'] after:mx-2" href="<?= "../$row[product_category].php" ?>"><?= $row['product_category'] ?></a>
                <a href="#">VIEW PRODUCT</a>
            </div>

            <div class="flex items-start pt-[1rem] px-[4rem] lgt:px-[2rem] relative">
                <div id="leftContainer" class="overflowYelement w-[9rem] lgt:hidden flex flex-col sticky top-12 h-[37rem] overflow-y-auto gap-2">
                    <a href="#rimg1">
                        <img fetchpriority="high" class="max-w-full h-[13rem] object-cover cursor-pointer hover:opacity-90 hoverProduct" id="limg1" src="<?= "/nstudio/img/product/{$row['id']}_image1.png" ?>" alt=" img1" draggable="false" />
                    </a>
                    <a href="#rimg2">
                        <img fetchpriority="high" class="max-w-full h-[13rem] object-cover cursor-pointer hover:opacity-90 hoverProduct" id="limg2" src="<?= "/nstudio/img/product/{$row['id']}_image2.png" ?>" alt=" img2" draggable="false" />
                    </a>
                    <a href="#rimg3">
                        <img  fetchpriority="high" class="max-w-full h-[13rem] object-cover cursor-pointer hover:opacity-90 hoverProduct" id="limg3" src="<?= "/nstudio/img/product/{$row['id']}_image3.png" ?>" alt=" img3" draggable="false" />
                    </a>
                </div>
                <div id="rightContainer" class="flex flex-col ml-[4rem] lgt:ml-0 gap-2">
                    <img fetchpriority="low" class="max-w-full h-[40rem] lgt:h-[45rem] object-cover cursor-auto" id="rimg1" src="<?= "/nstudio/img/product/{$row['id']}_image1.png" ?>" alt="img1" draggable="false" />
                    <img fetchpriority="low" class="max-w-full h-[40rem] lgt:h-[45rem] object-cover cursor-auto" id="rimg2" src="<?= "/nstudio/img/product/{$row['id']}_image2.png" ?>" draggable="false" />
                    <img fetchpriority="low" class="max-w-full h-[40rem] lgt:h-[45rem] object-cover cursor-auto" id="rimg3" src="<?= "/nstudio/img/product/{$row['id']}_image3.png" ?>" alt="img3" draggable="false" />
                </div>
                <form id="productForm" class="productForm flex flex-col justify-start gap-6 sticky top-12 ml-[4rem] lgt:ml-[2rem] w-[26rem]">
                    <div class="flex flex-col text-xl">
                        <h1 class="uppercase font-medium"><?= $row['product_name'] ?></h1>
                        <p class="font-semibold before:content-['₱'] before:font-medium before:mr-[2px]"><?= $row['product_price'] ?></p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs tracking-wider">COLOR</p>
                        <div class="flex gap-[7px] pl-[2px]" id="colourContainer" data-colour-id="<?= $row['colour_id'] ?>" draggable="false">
                            <?php $this->showProductColorButtons($row['product_id'], $row['colour_id']) ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs tracking-wider">SIZES</p>
                        <div class="flex flex-wrap justify-between pl-[2px] w-[20rem]">
                            <?php $this->showProductSizeButtons($row['product_id']) ?>
                        </div>
                    </div>
                    <div class="flex">
                        <button type="button" id="showSizeModalBtn" class="showSizeModalBtn text-xs font-medium underline cursor-pointer">
                            FIND YOUR SIZE
                        </button>
                    </div>
                    <div class="flex flex-col gap-5">
                        <div class="w-full h-[2.7rem] border border-[#101010]">
                            <button type="submit" value="add" class="addToCartBtn w-full h-full border border-[#101010] text-center text-[16px] capitalize disabled:bg-gray-200 disabled:cursor-not-allowed" name="addToCartBtn" id="addToCartBtn">
                                Add To Bag
                            </button>
                        </div>
                        <div class="w-full h-[2.7rem]">
                            <button type="submit" value="buy" data-item-id="<?= $row['product_id'] ?>" class="buyNowBtn w-full h-full border border-[#101010] bg-[#101010] text-white text-center text-[16px] capitalize disabled:opacity-80 disabled:cursor-not-allowed">
                                Buy Now
                            </button>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="flex flex-col w-full gap-3">
                        <div class="flex gap-3 text-xs font-medium pl-[1px]">
                            <button type="button" id="dBtn2" class="dBtn2 underline uppercase">
                                Description
                            </button>
                            <span>-</span>
                            <button type="button" id="dBtn1" class="dBtn1 uppercase">
                                Delivery
                            </button>
                            <span>-</span>
                            <button type="button" id="dBtn3" class="dBtn3 uppercase">
                                Details
                            </button>
                        </div>
                        <!-- Static -->
                        <!-- prettier-ignore -->
                        <div id="desc1" class="desc1 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">Shipping to: International

                            Standard home delivery ₱120 PHP / Free on orders over ₱10,000 PHP

                            Payment methods: Credit / Debit card | Klarna | Paypal

                            Please note, that the total amount of your order does not include local sales taxes and VAT, which means extra fees may be applied after placing your order. Read more about the delivery fees here.

                            Your return will cost ₱199. If something isn’t quite right, you have 28 days to send it back to us.

                            Minimum order value is ₱249 PHP

                            Free shipping on orders over threshold
                        </div>
                        <!-- Dynamic -->
                        <!-- prettier-ignore -->
                        <div id="desc2" class="desc2 text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium"><?= $row['product_description'] ?>,

                            Discover the perfect fusion of comfort and style with our latest fashion essential.

                            Unwind in the luxurious comfort of this meticulously designed piece, crafted to elevate your style effortlessly.

                            Embrace a lifestyle where comfort meets chic, making every day a stylish occasion.

                            • Supreme Comfort
                            • Effortless Elegance
                            • Tailored Fit
                            • Versatile Style
                            • Fashion Forward

                            100% RWS Wool / Machine wash

                            Elevate your wardrobe with the perfect harmony of comfort and style.
                            Experience a new level of confidence and sophistication in every step.
                        </div>
                        <!-- Static -->
                        <!-- prettier-ignore -->
                        <div id="desc3" class="desc3 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">100% Cotton / Medium iron / Line dry / Only non-chlorine bleach when needed / Dry clean / Machine wash 40°C

                            Make sure that your favourite items remain long-loved pieces for years to come; read our product care guide.
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }

    public function showProductColorButtons($product_id, $colour_id)
    {
        $colorButtons = $this->db->getProductAvailableColor($product_id);

        foreach ($colorButtons as $button) {
            $this->colorButtons($button, 'view', $colour_id);
        }
    }

    public function showProductSizeButtons($product_id)
    {
        $sizes = $this->db->getAllSizes();
        $productSizes = $this->db->getProductAvailableSize($product_id);
        $availableSize = [];

        foreach ($productSizes as $size) {
            $availableSize[] = $size['id'];
        }

        foreach ($sizes as $size) {
            if (in_array($size['id'], $availableSize)) {
                $this->sizeButtons($size, true);
            } else {
                $this->sizeButtons($size, false);
            }
        }
    }

    public function sizeButtons($row, $availableSize)
    {
    ?>
        <div class="group relative sm:w-12 sm:h-10 md:w-16 md:h-12 w-10 h-9 border border-black grid place-items-center">
            <input data-size-id="<?= $row['id'] ?>" class="hidden peer" type="radio" name="size" id="<?= $row['size_value'] ?>" <?= $availableSize ? "" : "disabled" ?> ?>
            <label class="active:bg-[#303030] active:text-white peer-checked:bg-[#151515] peer-checked:text-white hover:bg-[#151515] hover:text-white peer-disabled:bg-gray-200 text-sm uppercase w-full h-full grid place-items-center cursor-pointer relative" for="<?= $row['size_value'] ?>">
                <span><?= $row['size_value'] ?></span>
            </label>
            <svg class="w-full h-full absolute hidden peer-disabled:block" viewBox="0 0 10 10" preserveAspectRatio="none">
                <line x1="0" y1="0" x2="10" y2="10" stroke="black" stroke-width="0.3" />
            </svg>
        </div>
    <?php
    }

    public function mobileViewProduct($row)
    {
    ?>
        <div class="parent-container container min-h-screen pt-[4rem] pb-[1rem] relative md:block hidden">
            <div class="flex items-center text-sm font-medium px-[4rem] md:px-[2rem] sm:px-[1rem]">
                <a class="after:content-['_/'] after:mx-2" href="#">HOME</a>
                <a class="after:content-['_/'] after:mx-2" href="<?= "../$row[product_category].php" ?>"><?= $row['product_category'] ?></a>
                <a href="#">VIEW PRODUCT</a>
            </div>

            <form id="productForm" class="productForm flex flex-col w-full justify-start gap-6 sticky top-4 py-[2rem]">
                <div class="flex items-start px-[4rem] md:px-[0]">
                    <div id="imageSlider" class="flex w-full overflow-auto snap-x snap-mandatory">
                        <span id="counter" class="absolute top-[3rem] md:top-[2.5rem] left-[1rem] md:left-[0.5rem] px-2 bg-gray-600 rounded-xl text-white md:text-sm xs:text-xs">1/3</span>
                        <div class="w-full shrink-0 snap-start snap-always">
                            <img fetchpriority="high" id="image1" class="img1 max-w-full w-full h-full object-cover object-top" src="<?= "/nstudio/img/product/{$row['id']}_image1.png" ?>" alt="image1" />
                        </div>
                        <div class="w-full shrink-0 snap-start snap-always">
                            <img fetchpriority="low" id="image2" class="img2 max-w-full w-full h-full object-cover object-top" src="<?= "/nstudio/img/product/{$row['id']}_image2.png" ?>" alt="image2" />
                        </div>
                        <div class="w-full shrink-0 snap-start snap-always">
                            <img fetchpriority="low" id="image3" class="img3 max-w-full w-full h-full object-cover object-top" src="<?= "/nstudio/img/product/{$row['id']}_image3.png" ?>" alt="image3" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col text-3xl sm:text-xl px-[1rem]">
                    <h1 class="uppercase font-medium"><?= $row["product_name"] ?></h1>
                    <p class="font-semibold before:content-['₱'] before:font-medium before:mr-[2px]"><?= $row["product_price"] ?></p>
                </div>
                <div class="flex flex-col gap-2 px-[1rem]">
                    <p class="text-xs tracking-wider">COLOR</p>
                    <div class="flex gap-[12px] xs:gap-[8px] pl-[2px]" id="colourContainer" data-colour-id="<?= $row["colour_id"] ?>" draggable="false">
                        <?php $this->showProductColorButtons($row["product_id"], $row["colour_id"]) ?>
                    </div>
                </div>
                <div class="flex flex-col gap-2 px-[1rem]">
                    <p class="text-xs tracking-wider">SIZES</p>
                    <div class="flex flex-wrap justify-start gap-6 sm:gap-4 pl-[1px] w-full">
                        <?php $this->showProductSizeButtons($row['product_id']) ?>
                    </div>
                </div>
                <div class="flex px-[1rem]">
                    <button type="button" id=" showSizeModalBtn" class="showSizeModalBtn text-xs font-medium underline cursor-pointer">
                        FIND YOUR SIZE
                    </button>
                </div>
                <div class="flex flex-col w-full gap-3 px-[1rem]">
                    <div class="flex gap-3 justify-center text-xs font-medium pl-[1px]">
                        <button type="button" id="dBtn2" class="dBtn2 underline uppercase">
                            Description
                        </button>
                        <span>-</span>
                        <button type="button" id="dBtn1" class="dBtn1 uppercase">
                            Delivery
                        </button>
                        <span>-</span>
                        <button type="button" id="dBtn3" class="dBtn3 uppercase">
                            Details
                        </button>
                    </div>
                    <!-- prettier-ignore -->
                    <div id="desc1" class="desc1 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">Shipping to: International

                        Standard home delivery $20 USD / Free on orders over $200 USD
                        Payment methods: Credit / Debit card | Klarna | Paypal

                        Please note, that the total amount of your order does not include local sales taxes and VAT, which means extra fees may be applied after placing your order. Read more about the delivery fees here.

                        Your return will cost $25. If something isn’t quite right, you have 28 days to send it back to us.

                        Minimum order value is $5 USD

                        Free shipping on orders over threshold
                    </div>
                    <!-- prettier-ignore -->
                    <div id="desc2" class="desc2 text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium"><?= $row['product_description'] ?>,

                        Discover the perfect fusion of comfort and style with our latest fashion essential.

                        Unwind in the luxurious comfort of this meticulously designed piece, crafted to elevate your style effortlessly.

                        Embrace a lifestyle where comfort meets chic, making every day a stylish occasion.

                        • Supreme Comfort
                        • Effortless Elegance
                        • Tailored Fit
                        • Versatile Style
                        • Fashion Forward

                        100% RWS Wool / Machine wash

                        Elevate your wardrobe with the perfect harmony of comfort and style.
                        Experience a new level of confidence and sophistication in every step.
                    </div>
                    <!-- prettier-ignore -->
                    <div id="desc3" class="desc3 hidden text-sm leading-6 h-[15rem] overflow-y-scroll whitespace-pre-line font-medium">100% Cotton / Medium iron / Line dry / Only non-chlorine bleach when needed / Dry clean / Machine wash 40°C

                        Make sure that your favourite items remain long-loved pieces for years to come; read our product care guide.
                    </div>
                </div>
                <div class="flex flex-col gap-5 bg-white sticky bottom-0 pt-2 pb-4 px-[2rem] sm:px-[1rem] border-t">
                    <div class="flex justify-between text-sm">
                        <p class="font-medium uppercase"><?= $row['product_name'] ?></p>
                        <p class="font-semibold before:content-['₱'] before:font-medium before:mr-[2px]"><?= $row['product_price'] ?></p>
                    </div>
                    <div class="w-full h-[2.5rem] border border-[#101010]">
                        <button type="submit" value="add" class="addToCartBtn w-full h-full border border-[#101010] text-center text-[16px] capitalize disabled:bg-gray-200 disabled:cursor-not-allowed" name="addToCartBtn" id="addToCartBtn">
                            Add To Bag
                        </button>
                    </div>
                    <div class="w-full h-[2.5rem]">
                        <button type="submit" value="buy" data-item-id="<?= $row['product_id'] ?>" class="buyNowBtn w-full h-full border border-[#101010] bg-[#101010] text-white text-center text-[16px] capitalize disabled:opacity-80 disabled:cursor-not-allowed">
                            Buy Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    <?php
    }

    public function renderCheckoutProducts($row)
    {
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
    }

    public function renderAddressCard($row) {
        $sql = "SELECT * FROM address_tbl WHERE id = ?";
        $address = $this->db->select($sql, [$row['address_id']])[0];
        ?>
        <div class="addressCard w-[19rem] md:w-full flex flex-col border-[0.1px] border-[#505050] hover:shadow-xl hover:bg-[#f7f7f7] p-4 text-[15px] gap-3" data-address-id="<?= $address['id'] ?>">
            <div class="font-semibold flex justify-between">
                <h1 class="is_default"><?= $row['is_default'] == 1 ? 'Default' : "" ?></h1>
                <button class="deleteBtn p-1 active:scale-90" data-address-id="<?= $address['id'] ?>">
                    <img class="w-4 h-4 object-cover pointer-events-none" src="/nstudio/img/x.svg" alt="x">
                </button>
            </div>
            <div class="font-medium leading-[1.2rem]">
                <p class="fullname overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['fname'] . " " . $address['lname'] ?></p>
                <p class="email overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['email'] ?></p>
                <p class="street_name overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['street_name'] ?></p>
                <p class="city overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['city'] . ", " .  $address['province'] ?></p>
                <p class="pcode overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['postal_code'] ?></p>
                <p class="country overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['country'] ?></p>
                <p class="contact_number overflow-hidden text-ellipsis whitespace-nowrap"><?= $address['contact_number'] ?></p>
            </div>
            <div class="flex justify-center items-center border border-[#505050] transition-colors delay-75 ease-in-out">
                <button class="editBtn w-full h-full py-1 font-medium hover:text-white hover:bg-[#101010] active:bg-[#202020]" data-address-id="<?= $address['id'] ?>">Edit</button>
            </div>
        </div>
        <?php
    }


}
