<?php

require_once 'includes/session.php';
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

?>
<!doctype html>
<html lang="en">

<!-- Head -->
<?php require './views/partials/head.php' ?>

<body class="min-h-screen">
    <!-- Navbar -->
    <?php require_once './views/partials/nav.php' ?>
    <!-- Hero Section -->
    <main class="main_hero w-full h-[110vh] sm:h-screen flex justify-center items-center pt-[5rem] overflow-hidden" id="hero_section">
        <div class="container h-full relative text-sm flex flex-col justify-center items-center">
            <!-- Hero Text -->
            <div class="absolute top-[0] px-1">
                <img class="h-[35vh] md:min-h-full md:h-full object-cover" src="./img/nechma_text.svg" alt="text">
            </div>
            <!-- Hero Image -->
            <div class="w-[min(100%_30rem)] xs:w-full max-w-full sm:h-[85vh] h-[100vh] absolute bottom-[-2.5rem] animate__animated animate__fadeIn delay-400 pointer-events-none select-none">
                <img class="w-full h-full object-cover" src="./img/nechma_hero.svg" alt="hero" />
            </div>
            <!-- Hero Buttons -->
            <div class="w-[min(100%,_68rem)] absolute bottom-[8rem] flex justify-between gap-2 items-center px-10 xs:px-[1rem]">
                <a class="border-[2px] border-[#211f22] sm:border-[1px] sm:border-[#FFF] sm:text-[#FFF] w-[14rem] sm:w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp" href="men.php">FOR MEN</a>
                <a class="border-[2px] border-[#211f22] sm:border-[1px] sm:border-[#FFF] sm:text-[#FFF] w-[14rem] sm:w-[14rem] py-[0.8rem] text-[16px] text-center whitespace-nowrap animate__animated animate__slideInUp" href="women.php">FOR WOMEN</a>
            </div>
        </div>
    </main>
    <!-- Product Showcase Section -->
    <section class="min-h-screen">
        <div class="container min-h-screen bg-[#252525]">
            <div class="flex md:hidden justify-center items-center w-full py-20 px-10 lg:px-6 gap-5">
                <div class="lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)] flex flex-col justify-between">
                    <div class="lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] lg:h-[clamp(13rem,31.25vw+-2rem,18rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)] h-[clamp(18rem,10.6154rem+11.5385vw,21rem)]">
                        <img class="w-full h-full object-contain" src="./img/big_new_title.png" alt="/" />
                    </div>
                    <!-- prettier-ignore -->
                    <div class="flex justify-between items-center lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)]">
                        <img class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" src="./img/product/1_image1.jpg" alt="">
                        <img class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" src="./img/product/1_image2.jpg" alt="">
                        <img class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)] max-w-full object-cover object-top" src="./img/product/1_image3.jpg" alt="">
                    </div>
                </div>
                <div class="lg:w-[clamp(32rem,23rem+18.75vw,35rem)] lg:h-[clamp(26.5rem,_59.375vw_+_-2rem,36rem)] w-[35rem] h-[clamp(36rem,21.2308rem+23.0769vw,42rem)]">
                    <img class="w-full h-full object-cover object-top" src="./img/big_hero.svg" alt="" />
                </div>
            </div>

            <div class="hidden md:flex flex-col justify-center items-center w-full p-12 px-16 md:px-6 gap-8 sm:gap-5">
                <div class="xs:w-full w-[clamp(26rem,43.902vw+13.927rem,35rem)] xs:h-fit h-[clamp(11rem,19.512vw+5.634rem,15rem)]">
                    <img class="w-full h-full object-cover xs:object-contain" src="./img/big_new_title.png" alt="">
                </div>
                <div class="xs:w-full w-[clamp(26rem,43.902vw+13.927rem,35rem)]">
                    <img class="w-full h-full object-cover object-top" src="./img/big_hero.svg" alt="big_hero">
                </div>
                <div class="flex justify-between items-center xs:gap-1 xs:w-full xs:h-fit w-[clamp(26rem,43.902vw+13.927rem,35rem)] h-[clamp(14rem,19.512vw+8.634rem,18rem)]">
                    <img class="xs:flex-1 xs:basis-0 xs:w-0 xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" src="./img/1_image1.jpg" alt="1">
                    <img class="xs:flex-1 xs:basis-0 xs:w-0 xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" src="./img/1_image2.jpg" alt="1">
                    <img class="xs:flex-1 xs:basis-0 xs:w-0 xs:h-[clamp(9.5rem,60vw+-2.5rem,14rem)] w-[clamp(8.4rem,12.683vw+4.912rem,11rem)] h-full object-cover" src="./img/1_image3.jpg" alt="1">
                </div>
            </div>
        </div>
    </section>
    <!-- New Arival Section -->
    <section class="flex flex-col justify-center items-center w-full h-auto px-[4rem] md:px-4 overflow-hidden">
        <!-- Header -->
        <header class="container h-[15rem] grid place-items-center text-center">
            <h1 class="text-[clamp(2.7rem,4.091vw+1.882rem,4.5rem)] font-['Lato'] whitespace-nowrap">
                NEW ARRIVAL
            </h1>
        </header>
        <!-- Sub Header -->
        <div class="container flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR MEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="/nstudio/men.php">View all</a>
        </div>
        <!-- MEN PRODUCT -->
        <div class="container flex md:grid md:grid-cols-2 md:gap-8 place-items-center justify-evenly items-center gap-5 px-3">
            <?php

            newMenProduct();

            ?>
        </div>
        <!-- Sub Header -->
        <div class="container flex justify-between mt-4 mb-3">
            <h3 class="text-2xl font-[600] font-['Lato']">FOR WOMEN</h3>
            <a class="text-xl underline decoration-1 font-['Lato'] text-[#505050] font-semibold" href="/nstudio/women.php">View all</a>
        </div>
        <!-- WOMEN PRODUCT -->
        <div class="container flex md:grid md:grid-cols-2 md:gap-8 place-items-center justify-evenly items-center gap-5 px-3 mb-6">
            <?php

            newWomenProduct();

            ?>
        </div>
    </section>
    <section class="container min-h-[125vh] py-[2.5rem] pb-[5rem] px-[4rem] bg-[#252525] text-white flex flex-col gap-10 md:gap-6 md:px-[1.5rem] items-center">
        <div class="flex flex-col gap-3 text-center">
            <h1 class="uppercase text-2xl whitespace-nowrap">The Coldest Collection</h1>
            <div class="flex gap-3 md:hidden">
                <a class="border-[1px] border-[#FFF] w-[14rem] sm:w-[14rem] py-[0.5rem] text-[14px] text-center whitespace-nowrap" href="men.php">FOR MEN</a>
                <a class="border-[1px] border-[#FFF] w-[14rem] sm:w-[14rem] py-[0.5rem] text-[14px] text-center whitespace-nowrap" href="women.php">FOR WOMEN</a>
            </div>
        </div>
        <div class="flex md:flex-col gap-6">
            <div class="max-w-full h-[35rem] md:mb-[3rem]">
                <a href="#">
                    <img class="w-full h-full object-cover" src="img/hero_shop_now (1).svg" alt="img" />
                </a>
                <a class="underline text-sm uppercase pl-[1px]" href="#">Shop Now</a>
            </div>
            <div class="max-w-full h-[35rem]">
                <a href="#">
                    <img class="w-full h-full object-cover" src="img/hero_shop_now (2).svg " alt="img" />
                </a>
                <a class="underline text-sm uppercase pl-[1px]" href="#">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- Footer Section -->
    <?php require_once './views/partials/footer.php' ?>
</body>

</html>