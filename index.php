<?php

session_start();
require_once 'includes/connection.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $profile_img = $row['image_path'];
} else {
    $userID = "";
}

require_once "./includes/functions.php";

$homeActive = "active";

$images = fetchImagesForShowcase();

?>
<!doctype html>
<html lang="en">

<!-- Head -->
<?php require './views/partials/head.php' ?>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php require './views/partials/loading.php' ?>
    <!-- Navbar -->
    <?php require './views/partials/nav.php' ?>
    <!-- Hero Section -->
    <main class="main_hero w-full h-[110vh] sm:h-screen flex justify-center items-center pt-[5rem] overflow-hidden" id="hero_section">
        <div class="container h-full relative text-sm flex flex-col justify-center items-center">
            <!-- Hero Text -->
            <div class="absolute md:top-0 top-[0] px-1">
                <img class="max-w-full h-[minmax(100%,35vh)] object-cover object-center animate__animated fadeIn" src="./img/nechma_text.svg" alt="Nechma Studio">
            </div>
            <!-- Hero Image -->
            <div class="w-[min(100%_30rem)] xs:w-full max-w-full sm:h-[85vh] h-[100vh] absolute bottom-[-2.5rem] pointer-events-none select-none animate__animated fadeIn">
                <img class="w-full h-full object-cover" src="./img/nechma_hero.svg" alt="hero" />
            </div>
            <!-- Hero Buttons -->
            <div class="w-[min(100%,_68rem)] absolute bottom-[8rem] sm:bottom-[4rem] flex justify-between gap-3 items-center px-10 xs:px-[1rem]">
                <a class="border-[2px] border-[#211f22] md:border-[1px] lgt:border-[#FFF] lgt:text-[#FFF] w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated fadeUp" href="men.php">FOR MEN</a>
                <a class="border-[2px] border-[#211f22] md:border-[1px] lgt:border-[#FFF] lgt:text-[#FFF] w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated fadeUp" href="women.php">FOR WOMEN</a>
            </div>
        </div>
    </main>
    <!-- Product Showcase Section -->
    <section class="h-full animate__animated fadeIn">
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
    </section>
    <!-- New Arival Section -->
    <?php if (checkMenProduct() || checkWomenProduct()) : ?>
        <section class="flex flex-col justify-center items-center w-full h-auto px-[4rem] md:px-4 overflow-hidden">
            <!-- Header -->
            <header class="container h-[15rem] grid place-items-center text-center">
                <h1 class="text-[clamp(2.7rem,4.091vw+1.882rem,4.5rem)] font-['Lato'] whitespace-nowrap">
                    NEW ARRIVAL
                </h1>
            </header>
            <?php if (checkMenProduct()) : ?>
                <!-- Sub Header -->
                <div class="container flex justify-between mt-4 mb-3">
                    <h3 class="text-2xl font-[600] font-['Lato']">FOR MEN</h3>
                    <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="/nstudio/men.php">View all</a>
                </div>
                <!-- MEN PRODUCT -->
                <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3 animate__animated fadeIn">
                    <?php

                    newMenProduct();

                    ?>
                </div>
            <?php endif ?>
            <?php if (checkWomenProduct()) : ?>
                <!-- Sub Header -->
                <div class="container flex justify-between mt-4 mb-3">
                    <h3 class="text-2xl font-[600] font-['Lato']">FOR WOMEN</h3>
                    <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="/nstudio/women.php">View all</a>
                </div>
                <!-- WOMEN PRODUCT -->
                <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3 mb-6 animate__animated fadeIn">
                    <?php

                    newWomenProduct();

                    ?>
                </div>
            <?php endif ?>
        </section>
    <?php endif; ?>
    <section class="container h-full py-[2.5rem] pb-[5rem] px-[4rem] bg-[#252525] text-white flex flex-col gap-10 md:gap-6 md:px-[1.5rem] items-center animate__animated fadeIn">
        <div class="flex flex-col gap-3 text-center">
            <h1 class="uppercase text-2xl whitespace-nowrap">The Coldest Collection</h1>
            <div class="flex gap-3 md:hidden">
                <a class="border-[1px] border-[#FFF] w-[14rem] sm:w-[14rem] py-[0.5rem] text-[14px] text-center whitespace-nowrap" href="men.php">FOR MEN</a>
                <a class="border-[1px] border-[#FFF] w-[14rem] sm:w-[14rem] py-[0.5rem] text-[14px] text-center whitespace-nowrap" href="women.php">FOR WOMEN</a>
            </div>
        </div>
        <div class="flex md:flex-col gap-6">
            <div class="max-w-full h-[35rem] md:mb-[3rem]">
                <a href="women.php">
                    <img class="w-full h-full object-cover pointer-events-none select-none" src="img/hero_shop_now (1).svg" alt="img" />
                </a>
                <a class="underline text-sm uppercase pl-[1px]" href="women.php">Shop Now</a>
            </div>
            <div class="max-w-full h-[35rem]">
                <a href="men.php">
                    <img class="w-full h-full object-cover pointer-events-none select-none" src="img/hero_shop_now (2).svg " alt="img" />
                </a>
                <a class="underline text-sm uppercase pl-[1px]" href="men.php">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- Footer Section -->
    <?php require_once './views/partials/footer.php' ?>
</body>

</html>