<nav class="nav_bar border-b-[0.1px] border-[#101010] w-full h-[3rem] flex justify-between items-center px-[4rem] md:px-4 bottom-[-4.5rem]" id="main_navbar">
    <ul class="flex lg:flex md:hidden gap-6 text-[14px] font-medium">
        <li>
            <a class="nav_links uppercase" id="NAV_LINK" href="/nstudio/men.php">MEN</a>
            <?php if (checkLinkCategory("MEN")): ?>
            <div class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                <div class="w-full h-full m-auto flex">
                    <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                        <?php showLinkCategory("MEN") ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </li>
        <li>
            <a class="nav_links uppercase" id="NAV_LINK" href="/nstudio/women.php">WOMEN</a>
            <?php if (checkLinkCategory("WOMEN")): ?>
            <div class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                <div class="w-full h-full m-auto flex">
                    <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                        <?php showLinkCategory("WOMEN") ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </li>
        <li>
            <a class="nav_links uppercase" id="NAV_LINK" href="/nstudio/community.php">COMMUNITY</a>
            <div class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                <div class="w-full h-full m-auto flex">
                    <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                        <a href="#">About</a>
                        <a href="#">Mission</a>
                        <a href="#">Vision</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="hidden md:flex justify-center items-center gap-8 sm:gap-4 shrink-0">
        <button id="burger" class="hidden md:flex">
            <img id="burger_image" class="max-w-full h-[1.8rem]" src="/nstudio/img/burger.svg" alt="">
        </button>
        <button class="hidden md:flex justify-center items-center" id="searchBtn">
            <img class="max-w-full h-[1.3rem]" src="/nstudio/img/search.svg" alt="" />
        </button>
    </div>

    <div id="burger_menu" class="absolute top-[3rem] left-0 w-full bg-white flex flex-col overflow-hidden transition-all delay-300 ease-in-out border-b border-[#101010]">
        <a class="pl-5 py-4 text-[1.1rem] hover:underline hover:bg-slate-100 font-medium <?= @$homeActive == 'active' ? 'underline' : '' ?>" href="/nstudio/index.php">HOME</a>
        <a class="pl-5 py-4 text-[1.1rem] hover:underline hover:bg-slate-100 font-medium <?= @$menActive == 'active' ? 'underline' : '' ?>" href="/nstudio/men.php">MEN</a>
        <a class="pl-5 py-4 text-[1.1rem] hover:underline hover:bg-slate-100 font-medium <?= @$womenActive == 'active' ? 'underline' : '' ?>" href="/nstudio/women.php">WOMEN</a>
        <a class="pl-5 py-4 text-[1.1rem] hover:underline hover:bg-slate-100 font-medium <?= @$communityActive == 'active' ? 'underline' : '' ?>" href="/nstudio/community.php">COMMUNITY</a>
    </div>

    <a href="/nstudio/" class="h-[2.8rem] shrink-0">
        <img class="max-w-full h-full object-cover object-center" src="/nstudio/img/nechma_logo.svg" alt="logo" />
    </a>

    <ul class="flex gap-8 sm:gap-4 shrink-0 items-center">
        <!-- Search -->
        <li class="items-center md:hidden">
            <button class="md:hidden flex justify-center items-center" id="searchBtn">
                <img class="max-w-full h-[1.3rem]" src="/nstudio/img/search.svg" alt="" />
            </button>
        </li>
        <!-- Search Form -->
        <form id="searchForm" action="" method="GET" class="w-full hidden h-max absolute top-[3rem] left-0 bg-white px-[2rem] py-[0.5rem] overflow-hidden">
            <div class="w-full max-h-full flex flex-col justify-center items-start px-5">

                <div class="w-full flex justify-between items-center">

                    <input class="w-full h-[3.5rem] text-2xl outline-none border-none" id="search" type="text" placeholder="Search" autocomplete="off">

                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" id="searchClose">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>

                </div>

                <div class="flex flex-col" id="suggestions"></div>

            </div>
        </form>
        <!-- Cart -->
        <li>
            <a class="relative" href="/nstudio/views/cart.php">
                <img class="max-w-full h-[1.3rem]" src="/nstudio/img/shopbag.svg" alt="" />
                <span id="cartNumber" class="absolute top-[-10px] right-[-10px] w-5 text-[12px] text-center bg-red-400 rounded-full">
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
        <?php if (!isset($_SESSION["id"]) || $_SESSION["id"] === "") : ?>
            <li class="grid place-items-center">
                <a class="text-[14px] hover:text-[#707070]" href="/nstudio/login.php">SIGN IN</a>
            </li>
        <?php else : ?>
            <li class="grid place-items-center">
                <button type="button" class="relative" id="user-menu-button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>

                    <?php if (@$profile_img) : ?>
                        <img class="w-[1.6rem] h-[1.6rem] object-cover object-top rounded-full" src="<?= $profile_img ?>" alt="Profile">
                    <?php else : ?>
                        <img class="w-[1.5rem]" src="/nstudio/img/profile.svg" alt="Profile" />
                    <?php endif ?>

                    <div class="absolute top-[1.1rem] right-0 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 border rounded-lg shadow" id="user-dropdown">
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="/nstudio/views/dashboard/profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 whitespace-nowrap">Profile</a>
                            </li>
                            <li>
                                <a href="/nstudio/views/dashboard/purchases.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 whitespace-nowrap">My Purchases</a>
                            </li>
                            <li>
                                <a href="/nstudio/views/dashboard/address.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 whitespace-nowrap">Address</a>
                            </li>
                            <li>
                                <a href="/nstudio/includes/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 whitespace-nowrap">Sign
                                    out</a>
                            </li>
                        </ul>
                    </div>
                </button>

            </li>
        <?php endif; ?>
    </ul>
</nav>