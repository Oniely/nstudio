<?php

require_once "../includes/session.php";

if (!isset($_SESSION['from_enter_email']) && $_SESSION['from_enter_email'] != true) {
    header("Location: enter_email.php");
}

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
                <h1 class="text-3xl font-semibold text-[#101010] mb-3">Enter Code</h1>
                <?php

                require_once "../includes/connection.php";
                require_once "../includes/auth.php";

                if (isset($_POST['continue'])) {
                    $code = $_POST['code'];

                    if (strlen($code) == 6 && $code != 0) {
                        $sql = "SELECT * FROM site_user WHERE token = ?";
                        $query = $conn->prepare($sql);
                        $query->bind_param("i", $code);
                        $query->execute();

                        $result = $query->get_result();

                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $_SESSION['user_id'] = $row['id'];
                            header("Location: reset_password.php");
                        } else {
                            echo "<span class='err'>Invalid Code.</span>";
                        }
                    } else {
                        echo "<span class='err'>Invalid Code.</span>";
                    }
                }

                ?>
                <div class="w-full max-w-[18rem] flex flex-col">
                    <input class="w-full h-full border border-[#505050] px-[10px] py-3" type="text" name="code" id="code" placeholder="Enter Code" />
                </div>
                <button type="submit" name="continue" class="w-[18rem] py-3 bg-[#101010] text-white">Continue</button>
            </form>
        </div>
    </main>
</body>

</html>