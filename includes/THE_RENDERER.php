<?php

require_once 'THE_MYSQL.php';

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

    public function showColorButtons($product_id, $type = 'card')
    {
        $buttons = $this->db->getColorButtons($product_id);

        foreach ($buttons as $row) {
            $this->colorButtons($row, $type);
        }
    }

    public function colorButtons($row, $type = "card")
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
                <div class="w-5 h-4 bg-[<?= $row['hex_code'] ?>] active:border-[3px] active:border-[#cecece] active:border-double hover:border-[2px] hover:border-double"></div>
            </a>
        <?php
        }
        /* add this to div on type view: <?= $row['colour_id'] == $colour_id ? 'border-[3px] border-[#cecece] border-double' : '' ?> */
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

    public function noProductAvailable()
    {
    ?>
    <div class='w-full h-screen flex justify-center items-center md:col-span-full'>
        <h1 class="text-2xl text-[#101010] bg-gray-200 p-10 px-24 rounded-lg whitespace-nowrap">No Result Found.</h1>
    </div>
    <?php
    }
}
