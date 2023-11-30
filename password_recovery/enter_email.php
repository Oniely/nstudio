<?php

require_once "../includes/session.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php require '../views/partials/head.php' ?>

<body class="min-h-screen">
    <main class="w-full h-screen flex justify-center items-center px-5">
        <div class="w-[25rem] border border-[#101010] flex flex-col items-center pt-[2rem] pb-[3rem] px-5 shadow-lg">
            <div class="w-[8rem] mb-[1rem]">
                <img class="w-full h-full object-cover" src="../img/nechma_logo.svg" alt="" />
            </div>
            <form method="POST" class="w-full h-full flex flex-col items-center gap-[1.2rem] text-[14px] text-[#101010]">
                <h1 class="text-3xl font-semibold text-[#101010] mb-3">Forgot Password</h1>
                <?php

                require_once "../includes/connection.php";
                require_once "../includes/auth.php";
                require_once "../includes/send_email.php";

                if (isset($_POST['continue'])) {
                    $email = $_POST['email'];

                    if (checkEmail($email)) {
                        if (sendEmail($email)) {
                            $sql = "UPDATE site_user SET token = ? WHERE email = ?";
                            $query = $conn->prepare($sql);
                            $query->bind_param("is", $_SESSION['otp'], $email);
                            $query->execute();
                            
                            if ($query->affected_rows == 1) {
                                unset($_SESSION['otp']);
                                $_SESSION['from_enter_email'] = true;
                                header("Location: enter_code.php");
                            } else {
                                echo "<span class='err'>Something went wrong. Token.</span>";
                            }
                        } else {
                            echo "<span class='err'>Something went wrong. Send Email.</span>";
                        }
                    } else {
                        echo "<span class='err'>Email not found.</span>";
                    }
                }

                ?>
                <div class="w-full max-w-[18rem] flex flex-col">
                    <input class="w-full h-full border border-[#505050] px-[10px] py-3" type="email" name="email" id="email" placeholder="Enter Email Address" />
                </div>
                <button type="submit" name="continue" class="w-[18rem] py-3 bg-[#101010] text-white">Continue</button>
            </form>
        </div>
    </main>
</body>

</html>