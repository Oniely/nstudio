<?php

require "./includes/functions.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nechma Studios</title>
    <link rel="stylesheet" href="./styles/style.css" />
    <script src="./script/animation.js" defer></script>
    <script src="./script/magnet.js" defer></script>
    <script src="./script/nav.js" defer></script>

    <!-- CDNs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <!-- Navbar -->
    <nav class="nav_bar w-full h-[4.5rem] flex justify-between items-center px-[4rem] animate__animated animate__fadeInDown"
        id="main_navbar">
        <ul class="flex gap-6 text-[16px]">
            <li>
                <a class="nav_links" id="NAV_LINK" href="">MEN</a>

                <div
                    class="nav_hover w-full h-0 absolute top-[4.5rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                    <div class="w-full h-full m-auto flex">
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <a href="">New Arrivals</a>
                            <a href="">Knitwear & Cardigans</a>
                            <a href="">Cashmere</a>
                            <a href="">Coats & Jackets</a>
                            <a href="">Trousers</a>
                            <a href="">Skirt</a>
                            <a href="">Tops</a>
                            <a href="">Dressese & Jumpsuits</a>
                            <a href="">Blazers & Tailoring</a>
                            <a href="">Shirt & Blouses</a>
                            <a href="">T-shirts & Vests</a>
                            <a href="">Jeans</a>
                            <a href="">All Womenswear</a>
                        </div>
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <a href="">New Accessories</a>
                            <a href="">Bags</a>
                            <a href="">Scarves & Hats</a>
                            <a href="">Shoes</a>
                            <a href="">Underwear & Socks</a>
                            <a href="">All Accessories</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a class="nav_links" id="NAV_LINK" href="">WOMEN</a>

                <div
                    class="nav_hover w-full h-0 absolute top-[4.5rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                    <div class="w-full h-full m-auto flex">
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <a href="">New Arrivals</a>
                            <a href="">Knitwear & Cardigans</a>
                            <a href="">Cashmere</a>
                            <a href="">Coats & Jackets</a>
                            <a href="">Trousers</a>
                            <a href="">Skirt</a>
                            <a href="">Tops</a>
                            <a href="">Dressese & Jumpsuits</a>
                            <a href="">Blazers & Tailoring</a>
                            <a href="">Shirt & Blouses</a>
                            <a href="">T-shirts & Vests</a>
                            <a href="">Jeans</a>
                            <a href="">All Womenswear</a>
                        </div>
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <a href="">New Accessories</a>
                            <a href="">Bags</a>
                            <a href="">The Quilted Bag</a>
                            <a href="">Shoes & Boots</a>
                            <a href="">Jewellery</a>
                            <a href="">Scarves, Hats & Gloves</a>
                            <a href="">Outdoor Layers</a>
                            <a href="">Belts</a>
                            <a href="">Underwear & Lingerie</a>
                            <a href="">Socks & Tights</a>
                            <a href="">All Accessories</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a class="nav_links" id="NAV_LINK" href="">COMMUNITY</a>
                <div
                    class="nav_hover w-full h-0 absolute top-[4.5rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                    <div class="w-full h-full m-auto flex">
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <a href="">Our mission</a>
                            <a href="">COS Full Circle</a>
                            <a href="">Product Care</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="w-[8rem] shrink-0">
            <img class="w-full h-full object-contain" src="./img/nechma_logo.svg" alt="logo" />
        </div>

        <ul class="flex gap-12 shrink-0">
            <li>
                <a href=""><img class="w-[1.5rem]" src="./img/search.svg" alt="" /></a>
            </li>
            <li>
                <a href=""><img class="w-[1.5rem]" src="./img/heart.svg" alt="" /></a>
            </li>
            <li>
                <a href=""><img class="w-[1.5rem]" src="./img/shopbag.svg" alt="" /></a>
            </li>
            <li>
                <a href=""><img class="w-[1.5rem]" src="./img/profile.svg" alt="" /></a>
            </li>
        </ul>
    </nav>
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
            <h1 class="text-[4.5rem] font-['Lato'] whitespace-nowrap animate__animated slideUp">
                NEW ARRIVAL

            </h1>
        </header>
        <!-- Sub Header -->
        <div class="w-full flex justify-between mt-4 mb-3 animate__animated slideUp animate__faster">
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
        <div class="w-full flex justify-between mt-4 mb-3 animate__animated slideUp animate__faster">
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
    <section class="w-full h-[100vh] bg-[#101010]">
        <div class="container flex h-full mx-auto px-[2.5rem] py-[3rem] text-[14px] relative">
            <div class="flex flex-col items-start w-[18rem] gap-[6px] text-white">
                <a href="">Contact Us</a>
                <a href="">Delivery Information</a>
                <a href="">Returns & Refunds</a>
                <a href="">Customer Service</a>
                <a href="">Payment</a>
                <a href="">Size Guide</a>
                <a href="">FAQs Privacy</a>
                <a href="">Notice Cookie</a>
                <a href="">Notice Cookie Settings</a>
            </div>
            <div class="flex flex-col items-start w-[18rem] gap-[6px] text-white">
                <a href="">Store Locator</a>
                <a href="">Student Discount</a>
                <a href="">Sustainability</a>
                <a href="">Suppliers List</a>
                <a href="">Nstudio Resell</a>
                <a href="">Product Care</a>
                <a href="">COS Collective</a>
                <a href="">About Nstudio</a>
                <a href="">Careers</a>
                <a href="">Press</a>
            </div>
            <div class="flex flex-col items-start w-[18rem] gap-[6px] text-white">
                <a href="">Facebook</a>
                <a href="">Pinterest</a>
                <a href="">Instagram</a>
                <a href="">Spotify</a>
            </div>
            <div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14350.909776848246!2d122.82587729262792!3d9.97737942037196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33ac113abdc74dc7%3A0xfd31dde515e4c24!2sSouthland%20College%20of%20Kabankalan%20City%2C%20Inc.!5e0!3m2!1sen!2sph!4v1698300721408!5m2!1sen!2sph"
                    class="h-full" width="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
</body>

</html>