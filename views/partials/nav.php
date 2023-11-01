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

        <a href="/nstudio/" class="w-[8rem] shrink-0">
            <img class="w-full h-full object-contain" src="/nstudio/img/nechma_logo.svg" alt="logo" />
        </a>

        <ul class="flex gap-12 shrink-0">
            <?php if (!isset($_SESSION["id"]) || $_SESSION["id"] === ""): ?>
            <li>
                <a class="text-[14px]" href="/nstudio/login.php">Sign in</a>
            </li>
            <?php endif; ?>
            <li>
                <a href=""><img class="w-[1.5rem]" src="/nstudio/img/search.svg" alt="" /></a>
            </li>
            <li>
                <a href=""><img class="w-[1.5rem]" src="/nstudio/img/heart.svg" alt="" /></a>
            </li>
            <li>
                <a class="relative" href="">
                    <img class="w-[1.5rem]" src="/nstudio/img/shopbag.svg" alt="" />
                    <span id="cartNumber" class="absolute top-[-10px] right-[-10px] w-5 text-[12px] text-center bg-red-400 rounded-full">                       
                    <?php 
                        if (isset($_SESSION["id"]) || $_SESSION["id"] !== "") {
                            echo cartCount('cart_tbl', 'user_id', $_SESSION['id']) === 0 ? "" : cartCount('cart_tbl', 'user_id', $_SESSION['id']); 
                        }
                    ?>
                    </span>
                </a>
            </li>
            <?php if (!isset($_SESSION["id"]) || $_SESSION["id"] === ""): ?>
            <li>
                <a href="/nstudio/login.php">
                    <img class="w-[1.5rem]" src="/nstudio/img/profile.svg" alt="" />
                </a>
            </li>
            <?php else: ?>
            <li>
                <a href="/nstudio/includes/logout.php">
                    <img class="w-[1.5rem]" src="/nstudio/img/profile.svg" alt="" />
                </a>
            </li>
            <?php endif; ?>
        </ul>
</nav>