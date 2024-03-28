<?php

global $App;

session_start();
require_once './includes/THE_INITIALIZER.php';

$homeActive = "active";
?>

<!doctype html>
<html lang="en">

<!-- Head -->
<?php require './views/partials/head.php' ?>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php include './views/partials/loading.php' ?>
    <!-- Navbar -->
    <?php require './views/partials/nav.php' ?>
    <!-- Hero Section -->
    <main class="main_hero w-full h-[110vh] sm:h-screen flex justify-center items-center pt-[5rem] overflow-hidden text" id="hero_section">
        <div class="container h-full relative text-sm flex flex-col justify-center items-center">
            <!-- Hero Text -->
            <div class="absolute md:top-0 top-[0] px-1">
                <img fetchpriority="high" class="max-w-full h-[minmax(100%,35vh)] object-cover object-center animate__animated fadeIn" src="./img/nechma_text.svg" alt="Nechma Studio">
            </div>
            <!-- Hero Image -->
            <div class="w-[min(100%_30rem)] xs:w-full max-w-full sm:h-[85vh] h-[100vh] absolute bottom-[-2.5rem] pointer-events-none select-none animate__animated fadeIn">
                <img fetchpriority="high" class="w-full h-full object-cover" src="./img/nechma_hero.svg" alt="hero" />
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
        <?php $App->store->showCaseProducts() ?>
    </section>
    <!-- New Arival Section -->
    <?php
    $menCount = $App->db->countCategoryRows('MEN', true);
    $womenCount = $App->db->countCategoryRows('WOMEN', true);
    if ($menCount > 0 || $womenCount > 0) :
    ?>
        <section class="flex flex-col justify-center items-center w-full h-auto px-[4rem] md:px-4 overflow-hidden">
            <!-- Header -->
            <header class="container h-[15rem] grid place-items-center text-center">
                <h1 class="text-[clamp(2.7rem,4.091vw+1.882rem,4.5rem)] font-['Lato'] whitespace-nowrap">
                    NEW ARRIVAL
                </h1>
            </header>
            <?php if ($menCount > 0) : ?>
                <!-- Sub Header -->
                <div class="container flex justify-between mt-4 mb-3">
                    <h3 class="text-2xl font-[600] font-['Lato']">FOR MEN</h3>
                    <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="/nstudio/men.php">View all</a>
                </div>
                <!-- MEN PRODUCT -->
                <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3 animate__animated fadeIn">
                    <?php

                    $products = $App->db->getCategoryProducts('MEN', true, 4);
                    $App->store->showProducts($products);

                    ?>
                </div>
            <?php endif ?>
            <?php if ($womenCount > 0) : ?>
                <!-- Sub Header -->
                <div class="container flex justify-between mt-4 mb-3">
                    <h3 class="text-2xl font-[600] font-['Lato']">FOR WOMEN</h3>
                    <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="/nstudio/women.php">View all</a>
                </div>
                <!-- WOMEN PRODUCT -->
                <div class="container flex flex-wrap md:grid md:grid-cols-2 md:gap-8 xs:gap-4 place-items-center justify-evenly items-center md:px-3 mb-6 animate__animated fadeIn">
                    <?php

                    $products = $App->db->getCategoryProducts('WOMEN', true, 4);
                    $App->store->showProducts($products);

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