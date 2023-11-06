<nav class="nav_bar w-full h-[4.5rem] flex justify-between items-center px-[4rem] bottom-[-4.5rem]" id="main_navbar">
        <ul class="flex gap-6 text-[16px]">
            <li>
                <a class="nav_links" id="NAV_LINK" href="/nstudio/men.php">MEN</a>

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
                <a class="nav_links" id="NAV_LINK" href="/nstudio/women.php">WOMEN</a>

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

        <a href="/nstudio/" class="w-[8rem] shrink-0">
            <img class="w-full h-full object-contain" src="/nstudio/img/nechma_logo.svg" alt="logo" />
        </a>

        <ul class="flex gap-12 shrink-0">
            <!-- Search -->
            <li>
                <button id="searchBtn">
                    <img class="w-[1.5rem]" src="/nstudio/img/search.svg" alt="" />
                </button>
                
                <form id="searchForm" action="" method="GET" class="w-full hidden h-max absolute mt-5 left-0 bg-white px-[2rem] py-[0.5rem] overflow-hidden">
                    <div class="w-full max-h-full flex flex-col justify-center items-start px-5">

                        <div class="w-full flex justify-between items-center">

                            <input class="w-full h-[3.5rem] text-2xl outline-none border-none" id="search" type="text" placeholder="Search" autocomplete="off">

                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" id="searchClose">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>

                        </div>

                        <div class="flex flex-col" id="suggestions"></div>

                    </div>
                </form>
            </li>
            <!-- Cart -->
            <li>
                <a class="relative" href="/nstudio/views/cart.php?id=<?= @$_SESSION['id'] ?>">
                    <img class="w-[1.5rem]" src="/nstudio/img/shopbag.svg" alt="" />
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
            <?php if (!isset($_SESSION["id"]) || $_SESSION["id"] === ""): ?>
            <li>
                <a class="text-[14px]" href="/nstudio/login.php">Sign in</a>
            </li>
            <?php else: ?>
            <li>
                <button type="button" class="relative" id="user-menu-button"  data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>

                    <img class="w-[1.5rem]" src="/nstudio/img/profile.svg" alt="" />

                    <div class="absolute top-[1.2rem] right-0 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?= @$_SESSION['user_email'] ?></span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="/nstudio/includes/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </li>
                        </ul>
                    </div>
                </button>
                
            </li>
            <?php endif; ?>
        </ul>
</nav>