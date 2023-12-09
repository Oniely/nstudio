<body>
    <!-- GOOD JUST GOOD -->
    <nav
        class="nav_bar border-b-[0.1px] border-[#101010] w-full h-[3rem] flex justify-between items-center px-[4rem] md:px-4 bottom-[-4.5rem]"
        id="main_navbar"
    >
        <ul class="flex lg:flex md:hidden gap-6 text-[14px] font-medium">
            <li>
                <a class="nav_links uppercase" id="NAV_LINK" href="men.php"
                >MEN</a
                >

                <div
                    class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden"
                >
                    <div class="w-full h-full m-auto flex">
                        <div
                            class="flex flex-col items-start text-sm w-[18rem] gap-[6px]"
                        >
                            <a href="#">About</a>
                            <a href="#">Mission</a>
                            <a href="#">Vision</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a
                    class="nav_links uppercase"
                    id="NAV_LINK"
                    href="women.php"
                >WOMEN</a
                >

                <div
                    class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden"
                >
                    <div class="w-full h-full m-auto flex">
                        <div
                            class="flex flex-col items-start text-sm w-[18rem] gap-[6px]"
                        >
                            <a href="#">About</a>
                            <a href="#">Mission</a>
                            <a href="#">Vision</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a
                    class="nav_links uppercase"
                    id="NAV_LINK"
                    href="community.php"
                >COMMUNITY</a
                >

                <div
                    class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden"
                >
                    <div class="w-full h-full m-auto flex">
                        <div
                            class="flex flex-col items-start text-sm w-[18rem] gap-[6px]"
                        >
                            <a href="#">About</a>
                            <a href="#">Mission</a>
                            <a href="#">Vision</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <a href="#" class="h-[2.8rem] shrink-0">
            <img
                class="max-w-full h-full object-contain"
                src="img/nechma_logo.svg"
                alt="logo"
            />
        </a>

        <ul class="flex gap-8 shrink-0 items-center">
            <!-- Search -->
            <li class="items-center md:hidden">
                <button
                    class="md:hidden flex justify-center items-center"
                    id="searchBtn"
                >
                    <img
                        class="max-w-full h-[1.3rem]"
                        src="img/search.svg"
                        alt=""
                    />
                </button>
            </li>
            <!-- Search Form -->
            <form
                id="searchForm"
                action=""
                method="GET"
                class="w-full hidden h-max absolute top-[3rem] left-0 bg-white px-[2rem] py-[0.5rem] overflow-hidden"
            >
                <div
                    class="w-full max-h-full flex flex-col justify-center items-start px-5"
                >
                    <div class="w-full flex justify-between items-center">
                        <input
                            class="w-full h-[3.5rem] text-2xl outline-none border-none"
                            id="search"
                            type="text"
                            placeholder="Search"
                            autocomplete="off"
                        />

                        <button
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            id="searchClose"
                        >
                            <svg
                                class="w-4 h-4"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                        </button>
                    </div>

                    <div class="flex flex-col" id="suggestions"></div>
                </div>
            </form>
            <!-- Cart -->
            <li>
                <a class="relative" href="/nstudio/views/cart.php">
                    <img
                        class="max-w-full h-[1.3rem]"
                        src="./img/shopbag.svg"
                        alt=""
                    />
                    <span
                        id="cartNumber"
                        class="absolute top-[-10px] right-[-10px] w-5 text-[12px] text-center bg-red-400 rounded-full"
                    >
                        1
                    </span>
                </a>
            </li>
            <!-- Account -->
            <li class="grid place-items-center">
                <a
                    class="text-[14px] hover:text-[#707070]"
                    href="/nstudio/login.php"
                >SIGN IN</a
                >
            </li>
        </ul>
    </nav>

    <main class="min-h-screen pt-[3rem]">
        <div
            class="container min-h-[125vh] py-[2.5rem] pb-[5rem] px-[4rem] bg-[#252525] text-white flex flex-col gap-10 md:gap-6 md:px-[1.5rem] items-center"
        >
            <div class="flex flex-col gap-3 text-center">
                <h1 class="uppercase text-2xl whitespace-nowrap">
                    The Coldest Collection
                </h1>
                <div class="flex gap-3 md:hidden">
                    <a
                        class="border-[1px] border-[#FFF] w-[14rem] sm:w-[14rem] py-[0.5rem] text-[14px] text-center whitespace-nowrap"
                        href="men.php"
                    >FOR MEN</a
                    >
                    <a
                        class="border-[1px] border-[#FFF] w-[14rem] sm:w-[14rem] py-[0.5rem] text-[14px] text-center whitespace-nowrap"
                        href="women.php"
                    >FOR WOMEN</a
                    >
                </div>
            </div>
            <div class="flex md:flex-col gap-6">
                <div class="max-w-full h-[35rem] md:mb-[3rem]">
                    <a href="#">
                        <img
                            class="w-full h-full object-cover"
                            src="img/hero_shop_now (1).svg"
                            alt="img"
                        />
                    </a>
                    <a class="underline text-sm uppercase pl-[1px]" href="#"
                    >Shop Now</a
                    >
                </div>
                <div class="max-w-full h-[35rem]">
                    <a href="#">
                        <img
                            class="w-full h-full object-cover"
                            src="img/hero_shop_now (2).svg "
                            alt="img"
                        />
                    </a>
                    <a class="underline text-sm uppercase pl-[1px]" href="#"
                    >Shop Now</a
                    >
                </div>
            </div>
        </div>
    </main>

    <section class="w-full min-h-[40vh] bg-[#F8F6F0] px-8">
        <hr />
        <div
            class="container h-full flex flex-row md:flex-col-reverse justify-between gap-14 md:gap-4 md:px-2 px-8 py-4"
        >
            <div
                class="flex gap-5 leading-5 md:leading-6 sm:text-[12px] text-[14px] font-medium"
            >
                <ul class="md:w-full">
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Delivery Information</a></li>
                    <li><a href="#">Returns & Funds</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Payment</a></li>
                    <li><a href="#">Size Guide</a></li>
                    <li><a href="#">FAQs Privacy</a></li>
                    <li><a href="#">Notice Cookie</a></li>
                    <li><a href="#">Notice Cookie Settings</a></li>
                </ul>
                <ul class="md:w-full">
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Spotify</a></li>
                </ul>
            </div>
            <div
                class="flex md:flex-col md:items-center justify-center items-start md:gap-3 gap-2"
            >
                <div
                    class="md:flex md:gap-[5px] text-lg font-semibold leading-5"
                >
                    <!-- prettier-ignore -->
                    <p class="whitespace-pre md:whitespace-nowrap">Enjoy 10% off your
                        first order.</p>
                </div>
                <div class="w-[12rem] md:w-full text-center">
                    <button
                        class="w-full h-full bg-[#101010] text-white text-[12px] py-3"
                    >
                        SUBSCRIBE
                    </button>
                </div>
            </div>
        </div>
    </section>
</body>

<div class="flex justify-between items-center lg:w-[clamp(28rem,1.0000rem+56.2500vw,37rem)] w-[clamp(37rem,24.6923rem+19.2308vw,42rem)]">
                        <img src="./img/1_image1.jpg" class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" alt="Showcase Image 1">
                        <img src="./img/1_image2.jpg" class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)]  max-w-full object-cover object-top" alt="Showcase Image 2">
                        <img src="./img/1_image3.jpg" class="lg:w-[clamp(9rem,0.0000rem+18.7500vw,12rem)] lg:h-[clamp(13rem,1.0000rem+25.0000vw,17rem)] w-[clamp(12rem,8.3077rem+5.7692vw,13.5rem)] h-[clamp(17rem,7.1538rem+15.3846vw,21rem)] max-w-full object-cover object-top" alt="Showcase Image 3">
                    </div>