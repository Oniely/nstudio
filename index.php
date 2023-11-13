<?php

require_once 'includes/session.php';

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
} else {
    $userID = "";
}

require_once "./includes/functions.php";

?>
<!doctype html>
<html lang="en">

<!-- Head -->
<?php require './views/partials/head.php' ?>

<body class="min-h-screen">
    <!-- Navbar -->
    <?php require_once './views/partials/nav.php' ?>
    <!-- Hero Section -->
    <main class="w-full h-[110vh] flex justify-center items-center pt-[6rem] overflow-hidden main_hero" id="hero_section">
        <div class="container h-full relative text-sm flex flex-col justify-center items-center">
            <!-- Hero Text -->
            <div class="absolute top-[0]">
                <img src="./img/nechma_text.png" alt="text">
            </div>
            <!-- Hero Image -->
            <div class="w-[min(100%_35rem)] h-[max(100%,_40rem)] absolute bottom-[-2.5rem] animate__animated animate__fadeIn delay-400 pointer-events-none select-none">
                <img class="w-full h-full object-cover" src="./img/nechma_hero.svg" alt="hero" />
            </div>
            <!-- Hero Buttons -->
            <div class="w-[min(95%,_65rem)] absolute bottom-[7rem] flex justify-between items-center md:px-14">
                <a class="border-[2px] border-[#211f22] md:border-[1px] md:border-[#FFF] md:text-[#FFF] w-[14rem] py-[0.8rem] text-[16px] text-center mr-4 whitespace-nowrap animate__animated animate__slideInUp" href="">FOR MEN</a>
                <a class="border-[2px] border-[#211f22] md:border-[1px] md:border-[#FFF] md:text-[#FFF] w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp" href="">FOR WOMEN</a>
            </div>
        </div>
    </main>
    <!-- New Arival Section -->
    <section class="flex flex-col justify-center items-center w-full h-auto px-14 overflow-y-hidden">
        <!-- Header -->
        <header class="container h-[13rem] grid place-items-center text-center">
            <h1 class="text-[clamp(4rem,10vw,4.5rem)] font-['Lato'] whitespace-nowrap">
                NEW ARRIVAL
            </h1>
        </header>
        <!-- Sub Header -->
        <div class="container flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR MEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="">View all</a>
        </div>
        <!-- MEN PRODUCT -->
        <div class="container flex justify-evenly items-center gap-5 px-3">
            <?php

            newMenProduct();

            ?>
        </div>
        <!-- Sub Header -->
        <div class="container flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR WOMEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="">View all</a>
        </div>
        <!-- WOMEN PRODUCT -->
        <div class="container flex justify-evenly items-center gap-5 px-3 pb-[3rem]">
            <?php

            newWomenProduct();

            ?>
        </div>
    </section>
    <!-- Footer Section -->
    <?php require_once './views/partials/footer.php' ?>
</body>

</html>