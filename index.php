<?php

session_start();
session_regenerate_id();

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $id = $_SESSION["id"];
} else {
    $id = "";
}

require_once "./includes/functions.php";

?>
<!doctype html>
<html lang="en">

<!-- Head -->
<?php require './views/partials/head.php' ?>

<body>
    <!-- Navbar -->
    <?php require_once './views/partials/nav.php' ?>
    <!-- Hero Section -->
    <main class="w-full h-[110vh] flex justify-center items-center pt-[6rem] overflow-hidden main_hero"
        id="hero_section">
        <div class="container h-full relative text-sm flex flex-col justify-center items-center">
            <!-- Hero Text -->
            <h1
                class="text-[clamp(5rem,_9.8vw,10rem)] font-['Lato'] text-[#101010] tracking-wide whitespace-nowrap absolute top-[13rem] animate__animated animate__fadeIn delay-200 pointer-events-none select-none">
                <span>NECHMA</span>
                <span class="ml-[5rem]">STUDIO</span>
            </h1>
            <!-- Hero Image -->
            <div
                class="w-[min(100%_35rem)] h-[max(100%,_40rem)] absolute bottom-[-2.5rem] animate__animated animate__fadeIn delay-400 pointer-events-none select-none">
                <img class="w-full h-full object-cover" src="./img/nechma_hero.svg" alt="hero" />
            </div>
            <!-- Hero Buttons -->
            <div class="w-[min(95%,_65rem)] absolute bottom-[7rem] flex justify-between items-center">
                <a class="border-[2px] border-[#211f22] w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp"
                    href="">FOR MEN</a>
                <a class="border-[2px] border-[#211f22] w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp"
                    href="">FOR WOMEN</a>
            </div>
        </div>
    </main>
    <!-- Showcase Product Section -->
    <section class="w-full min-h-[110vh] bg-[#101010] flex">
        <div class="container m-auto h-fit p-[3rem] parent">
            <div class="h-full shrink-0 mr-[3rem] div1">
                <img class="w-full h-full object-cover" src="./img/product/big_black_hero.svg" alt="product" />
            </div>
            <div class="flex flex-col div2 text-[clamp(4.8rem,_10vw,_7.7rem)] text-left">
                <h1 class="font-['Lato'] leading-[1] text-[#d9d9d9] whitespace-nowrap mb-[10px]">
                    NEW YEAR,
                </h1>
                <h1 class="font-['Lato'] leading-[1] text-[#d9d9d9] whitespace-nowrap">
                    NEW STYLE
                </h1>
            </div>
            <div class="flex justify-between w-full gap-[10px] pr-[3rem] div3">
                <img class="object-cover" src="./img/product/1.svg" alt="product" />
                <img class="object-cover" src="./img/product/2.svg" alt="product" />
                <img class="object-cover" src="./img/product/3.svg" alt="product" />
            </div>
        </div>
    </section>
    <!-- New Arival Section -->
    <section class="flex flex-col justify-center items-center w-full h-auto px-14 overflow-y-hidden">
        <!-- Header -->
        <header class="w-full h-[13rem] grid place-items-center text-center">
            <h1 class="text-[4.5rem] font-['Lato'] whitespace-nowrap">
                NEW ARRIVAL

            </h1>
        </header>
        <!-- Sub Header -->
        <div class="w-full flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR MEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="">View all</a>
        </div>
        <!-- MEN PRODUCT -->
        <div class="container flex justify-evenly items-center gap-5 px-3">
            <?php

            newMenProduct("product_tbl");

            ?>
        </div>
        <!-- Sub Header -->
        <div class="w-full flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR WOMEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="">View all</a>
        </div>
        <!-- WOMEN PRODUCT -->
        <div class="container flex justify-evenly items-center gap-5 px-3 pb-[3rem]">
            <?php

            newWomenProduct("product_tbl");

            ?>
        </div>
    </section>
    <!-- Footer Section -->
    <?php require_once './views/partials/footer.php' ?>
</body>

</html>