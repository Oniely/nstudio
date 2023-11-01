<?php

session_start();
session_regenerate_id();

if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    header('location: index.php');
}

require "./includes/auth.php";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nechma Studios</title>
    <link rel="stylesheet" href="./styles/style.css">

    <!-- CDNs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
</head>

<body>
    <main class="w-full h-screen flex justify-center items-center">
        <div class="w-[25rem] border border-[#101010] flex flex-col items-center py-[1.3rem] shadow-lg">
            <div class="w-[8rem] mb-[1.5rem]">
                <img class="w-full h-full object-cover" src="./img/nechma_logo.svg" alt="" />
            </div>
            <form method="POST" class="w-full h-full flex flex-col items-center gap-[1.2rem] text-[14px] text-[#101010]">
                <?php

                include_once "./includes/auth.php";

                if (isset($_POST['submit'])) {
                    $userEmail = $_POST['user_email'];
                    $passw = $_POST['password'];

                    if (loginAuth($userEmail, $passw)) {
                        header('location: index.php');
                    } else {
                        echo "<span class='err'>Credentials Incorrect.</span>";
                    }
                }

                ?>
                <div class="w-[18rem] flex flex-col">
                    <label class="text-[13px]" for="userEmail">Username/Email</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2" type="text" name="user_email" id="user_email" placeholder="example@gmail.com" />
                </div>
                <div class="w-[18rem] flex flex-col">
                    <label class="text-[13px]" for="password">Password</label>
                    <input class="w-full h-full bg-slate-200 px-[10px] py-2" type="text" name="password" id="password" placeholder="password" />
                    <a class="self-end text-[12px] font-semibold mt-3 mb-[-8px]" href="">forgot password?</a>
                </div>
                <div class="w-[18rem] text-center">
                    <input class="w-full bg-[#101010] py-2 mb-2  text-white font-semibold cursor-pointer" type="submit" name="submit" value="Log In">
                    <span class="underline text-[12px] font-semibold">Don't have an account yet? <a class="text-blue-800" href="">Sign Up</a></span>
                </div>
                <div class="w-[18rem] flex flex-col items-center text-center text-[0.8rem] font-semibold gap-1">
                    <a class="w-full flex justify-start items-center pl-[3.3rem] gap-4 py-2 hover:bg-[#101010] hover:text-white transition" href="">
                        <i class="fab fa-facebook text-[1.2rem]"></i>
                        <span class="underline">Sign in with Facebook</span>
                    </a>
                    <a class="w-full flex justify-start items-center pl-[3.3rem] gap-4 py-2 hover:bg-[#101010] hover:text-white transition" href="">
                        <i class="fab fa-google text-[1.2rem]"></i>
                        <span class="underline">Sign in with Google</span>
                    </a>
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