<?php

session_start();

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    header('location: login.php');
}

require_once "includes/redirect.php";
require_once "./includes/THE_MYSQL.php";
require_once "./includes/THE_AUTH.php";

$db = new Mysql();
$Auth = new Auth($db);

?>

<!DOCTYPE html>
<html lang="en">

<?php require 'views/partials/head.php' ?>
<script src="script/auth.js" defer></script>

<body class="min-h-screen py-14">
    <!-- Main -->
    <main class="w-full h-screen flex justify-center items-center">
        <div class="container max-w-[25rem] border border-[#101010] flex flex-col items-center py-[1.5rem] pb-[2.5rem] shadow-lg">
            <div class="w-[8rem] mb-[1.5rem] md:mb-[1rem]">
                <img class="w-full h-full object-cover" src="./img/nechma_logo.svg" alt="" />
            </div>
            <form method="POST" id="signUpForm" class="w-full h-full flex flex-col items-center gap-[1.2rem] md:gap-[15px] text-[14px] text-[#101010]">
                <?php

                if (isset($_POST['submit'])) {
                    $fname = $_POST["fname"];
                    $lname = $_POST["lname"];
                    $contact = $_POST["contact"];
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    if ($Auth->signUpAuth($fname, $lname, $contact, $username, $email, $password)) {
                        redirect('login.php');
                    } else {
                        echo "<span class='err'>Account Already Exist.</span>";
                    }
                }

                ?>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="fname">First Name</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2" type="text" name="fname" id="fname" placeholder="Your First Name" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="lname">Last Name</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2" type="text" name="lname" id="lname" placeholder="Your Last Name" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="contact">Contact Number</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2" type="text" name="contact" id="contact" placeholder="Your Contact Number" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="username">Username</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2" type="text" name="username" id="username" placeholder="Your Username" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="email">Email</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2" type="text" name="email" id="email" placeholder="Your Email Address" />
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="password">Password</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2 relative" type="password" name="password" id="password" placeholder="Your Password">
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                    <img data-visibility="invisible" class="password_visibility absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_invisible.png" alt="invisible">
                    <img data-visibility="visible" class="password_visibility hidden absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_visible.png" alt="visible">
                </div>
                <div class="w-full max-w-[18rem] flex flex-col relative">
                    <label class="text-[13px]" for="confirmPass">Confirm Password</label>
                    <input class="w-full h-full border border-[#101010] px-[10px] py-2 relative" type="password" name="confirmPass" id="confirmPass" placeholder="Your Password">
                    <span class="absolute bottom-[-1rem] left-0 text-xs text-[#ff0000] hidden"></span>
                    <img data-visibility="invisible" class="password_visibility absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_invisible.png" alt="invisible">
                    <img data-visibility="visible" class="password_visibility hidden absolute top-[1.6rem] right-[10px] cursor-pointer w-6 h-6" src="img/p_visible.png" alt="visible">

                </div>
                <div class="w-full max-w-[18rem] text-center">
                    <input class="w-full bg-[#101010] py-2 mb-2  text-white font-semibold cursor-pointer" type="submit" name="submit" value="Sign Up">
                    <span class="underline text-[12px] font-semibold">Already have an account? <a class="text-blue-800" href="login.php">Log in</a></span>
                </div>
            </form>
        </div>
    </main>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>