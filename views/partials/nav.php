<nav class="nav_bar w-full h-[3rem] flex justify-between items-center px-[4rem] md:px-4 bottom-[-4.5rem] border-b border-[#101010]"
    id="main_navbar">
    <ul class="flex lg:flex md:hidden gap-6 text-[14px] font-medium">
        <?php showNavLinkDesktop() ?>
    </ul>

    <div class="hidden md:flex justify-center items-center gap-8">
        <button id="burger" class="hamburger-lines hidden md:flex">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </button>
        <button class="hidden md:flex justify-center items-center" id="searchBtn">
            <img class="max-w-full h-[1.3rem]" src="/nstudio/img/search.svg" alt="" />
        </button>
    </div>

    <div id="burger_menu" class="absolute top-[3rem] left-0 w-full bg-slate-100 flex flex-col overflow-hidden transition-all delay-300 ease-in-out">
        <?php showNavLinkMobile() ?>
    </div>

    <a href="/nstudio/" class="h-[2.8rem] shrink-0">
        <img class="max-w-full h-full object-contain" src="/nstudio/img/nechma_logo.svg" alt="logo" />
    </a>

    <ul class="flex gap-8 shrink-0 items-center">
        <!-- Search -->
        <li class="items-center">
            <button class="md:hidden flex justify-center items-center" id="searchBtn">
                <img class="max-w-full h-[1.3rem]" src="/nstudio/img/search.svg" alt="" />
            </button>

            <form id="searchForm" action="" method="GET"
                class="w-full hidden h-max absolute top-[3rem] left-0 bg-white px-[2rem] py-[0.5rem] overflow-hidden">
                <div class="w-full max-h-full flex flex-col justify-center items-start px-5">

                    <div class="w-full flex justify-between items-center">

                        <input class="w-full h-[3.5rem] text-2xl outline-none border-none" id="search" type="text"
                            placeholder="Search" autocomplete="off">

                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            id="searchClose">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>

                    </div>

                    <div class="flex flex-col" id="suggestions"></div>

                </div>
            </form>
        </li>
        <!-- Cart -->
        <li>
            <a class="relative" href="/nstudio/views/cart.php">
                <img class="max-w-full h-[1.3rem]" src="/nstudio/img/shopbag.svg" alt="" />
                <span id="cartNumber"
                    class="absolute top-[-10px] right-[-10px] w-5 text-[12px] text-center bg-red-400 rounded-full">
                    <?php
                    if (!isset($_SESSION["id"]) || $_SESSION["id"] === "") {
                        echo "";
                    } else {
                        echo cartCount($_SESSION['id']);
                    }
                    ?>
                </span>
            </a>
        </li>
        <!-- Account -->
        <?php if (!isset($_SESSION["id"]) || $_SESSION["id"] === ""): ?>
            <li class="md:hidden">
                <a class="text-[14px] hover:text-[#707070]" href="/nstudio/login.php">SIGN IN</a>
            </li>
        <?php else: ?>
            <li>
                <button type="button" class="relative" id="user-menu-button" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>

                    <img class="w-[1.5rem]" src="/nstudio/img/profile.svg" alt="" />

                    <div class="absolute top-[1.2rem] right-0 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="user-dropdown">
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="/nstudio/views/dashboard/dashboard.php"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                            </li>
                            <li>
                                <a href="/nstudio/includes/logout.php"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                    out</a>
                            </li>
                        </ul>
                    </div>
                </button>

            </li>
        <?php endif; ?>
    </ul>
</nav>