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
    <main class="main_hero w-full h-[110vh] flex justify-center items-center pt-[6rem] overflow-hidden"
        id="hero_section">
        <div class="container h-full relative text-sm flex flex-col justify-center items-center">
            <!-- Hero Text -->
            <div class="absolute md:top-5 top-[0] px-1">
                <img class="h-[35vh] md:min-h-full md:h-full object-cover" src="./img/nechma_text.png" alt="text">
            </div>
            <!-- Hero Image -->
            <div
                class="w-[min(100%_30rem)] h-[100vh] absolute bottom-[-2.5rem] animate__animated animate__fadeIn delay-400 pointer-events-none select-none">
                <img class="w-full h-full object-cover" src="./img/nechma_hero.svg" alt="hero" />
            </div>
            <!-- Hero Buttons -->
            <div class="w-[min(100%,_68rem)] absolute bottom-[8rem] flex justify-between gap-2 items-center px-[3rem] xs:px-[1rem]">
                <a class="border-[2px] border-[#211f22] sm:border-[1px] sm:border-[#FFF] sm:text-[#FFF] w-[14rem] sm:w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp"
                    href="men.php">FOR MEN</a>
                <a class="border-[2px] border-[#211f22] sm:border-[1px] sm:border-[#FFF] sm:text-[#FFF] w-[14rem] sm:w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp"
                    href="women.php">FOR WOMEN</a>
            </div>
        </div>
    </main>
    <!-- New Arival Section -->
    <section class="flex flex-col justify-center items-center w-full h-auto px-14 md:px-4 overflow-hidden">
        <!-- Header -->
        <header class="container h-[13rem] grid place-items-center text-center">
            <h1 class="text-[clamp(2.8rem,10vw,4.5rem)] font-['Lato'] whitespace-nowrap">
                NEW ARRIVAL
            </h1>
        </header>
        <!-- Sub Header -->
        <div class="container flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR MEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="">View all</a>
        </div>
        <!-- MEN PRODUCT -->
        <div class="container flex justify-evenly items-center gap-5 px-3 md:flex-wrap">
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
        <div class="container flex justify-evenly items-center gap-5 px-3 pb-[3rem] md:flex-wrap">
            <?php

            newWomenProduct();

            ?>
        </div>
    </section>
    <!-- Footer Section -->
    <?php require_once './views/partials/footer.php' ?>
</body>

</html>