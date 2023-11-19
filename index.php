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
    <!-- Product Showcase Section -->
    <section class="min-h-screen">
        <div class="container min-h-screen bg-[#101010]">
                <div
                    class="flex md:hidden justify-center items-center w-full py-20 px-10 lg:px-6 gap-5"
                >
                    <div
                        class="lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)] flex flex-col justify-between"
                    >
                        <div
                            class="lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] lg:h-[clamp(13rem,31.25vw+-2rem,18rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)] h-[clamp(18rem,10.6154rem+11.5385vw,21rem)]"
                        >
                            <img
                                class="w-full h-full object-contain"
                                src="./img/big_new_title.png"
                                alt="/"
                            />
                        </div>
                        <!-- prettier-ignore -->
                        <div class="flex justify-between items-center lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)]">
                            <img class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" src="./img/product/1_image1.jpg" alt="">
                            <img class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" src="./img/product/1_image2.jpg" alt="">
                            <img class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)] max-w-full object-cover object-top" src="./img/product/1_image3.jpg" alt="">
                        </div>
                    </div>
                    <div
                        class="lg:w-[clamp(32rem,23rem+18.75vw,35rem)] lg:h-[clamp(26.5rem,_59.375vw_+_-2rem,36rem)] w-[35rem] h-[clamp(36rem,21.2308rem+23.0769vw,42rem)]"
                    >
                        <img
                            class="w-full h-full object-cover object-top"
                            src="./img/big_hero.png"
                            alt=""
                        />
                    </div>
                </div>

                <div class="hidden md:flex flex-col justify-center items-center w-full p-12 px-16 md:px-6 gap-8 sm:gap-5">
                    <div class="xs:w-full w-[clamp(26rem,43.902vw+13.927rem,35rem)] xs:h-fit h-[clamp(11rem,19.512vw+5.634rem,15rem)]">
                        <img class="w-full h-full object-cover xs:object-contain" src="./img/big_new_title.png" alt="">
                    </div>
                    <div class="xs:w-full w-[clamp(26rem,43.902vw+13.927rem,35rem)]">
                        <img class="w-full h-full object-cover object-top" src="./img/big_hero.png" alt="big_hero">
                    </div>
                    <div class="flex justify-between items-center xs:gap-1 xs:w-full xs:h-fit w-[clamp(26rem,43.902vw+13.927rem,35rem)] h-[clamp(14rem,19.512vw+8.634rem,18rem)]">
                        <img class="xs:flex-1 xs:basis-0 xs:w-0 xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" src="./img/product/1_image1.jpg" alt="1">
                        <img class="xs:flex-1 xs:basis-0 xs:w-0 xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" src="./img/product/1_image2.jpg" alt="1">
                        <img class="xs:flex-1 xs:basis-0 xs:w-0 xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" src="./img/product/1_image3.jpg" alt="1">
                    </div>
                </div>
            </div>
    </section>
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