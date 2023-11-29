function showNavLinkMobile()
{
    require "connection.php";

    $sql = "SELECT distinct
            category_name
            FROM
            category_tbl
            ORDER BY
            CASE
                WHEN category_name = 'MEN' THEN 1
                WHEN category_name = 'WOMEN' THEN 2
                WHEN category_name = 'COLLECTION' THEN 3
                ELSE 4
            END";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        ?>
            <a class="pl-5 py-3 text-[1.1rem] hover:underline hover:bg-slate-200 font-medium" href="<?= "/nstudio/$row[category_name].php" ?>">
                <?= $row['category_name'] ?>
            </a>
        <?php
        }
    }
}

/* 
 * Show Navbar Links Dynamically on Desktop
 */

function showNavLinkDesktop()
{
    require "connection.php";

    $sql = "SELECT distinct
            category_name
            FROM
            category_tbl
            ORDER BY
            CASE
                WHEN category_name = 'MEN' THEN 1
                WHEN category_name = 'WOMEN' THEN 2
                WHEN category_name = 'COLLECTION' THEN 3
                ELSE 4
            END";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        ?>
            <li>
                <a class="nav_links uppercase" id="NAV_LINK" href="<?= "/nstudio/$row[category_name].php" ?>">
                    <?= $row['category_name'] ?>
                </a>

                <div class="nav_hover w-full h-0 absolute top-[3rem] flex justify-start items-start left-0 bg-white px-[2rem] py-[0rem] overflow-hidden">
                    <div class="w-full h-full m-auto flex">
                        <div class="flex flex-col items-start text-sm w-[18rem] gap-[6px]">
                            <?php showLinkCategory($row['category_name']) ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php
        }
    }
}