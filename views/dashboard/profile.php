<?php

session_start();
require_once '../../includes/THE_INITIALIZER.php';

require '../../includes/connection.php';
require '../../includes/functions.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];

    $sql = "SELECT * FROM site_user WHERE id = $userID";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $username = $row['username'];
    $contact_number = $row['contact_number'];
    $password = $row['password'];
    $profile_img = $row['image_path'];
} else {
    header("Location: /nstudio/login.php");
}

$profile = true;

?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require '../partials/head.php' ?>

<body class="min-h-screen">
    <!-- Loading Screen -->
    <?php include '../partials/loading.php' ?>
    <!-- Navbar -->
    <?php require '../partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen h-full pt-6 pb-10 md:pb-14 animate__animated fadeIn">
        <div class="container min-h-screen pt-[4rem] px-[4rem] md:px-[2rem] sm:px-[1rem] flex flex-col gap-7 relative overflow-hidden">
            <div class="pl-[10rem] md:pl-0 text-[#505050]">
                <p class="uppercase text-sm">Account / Dashboard / Profile</p>
                <h1 class="uppercase text-4xl font-semibold tracking-wider">Your Profile</h1>
                <div class="md:flex w-full hidden"><?php require 'nav.php' ?></div>
            </div>
            <div class="flex items-start">
                <!-- Dashboard Nav -->
                <div class="md:hidden"><?php require 'nav.php' ?></div>
                <!-- Main -->
                <form method="POST" class="container h-auto pl-10 md:pl-0 grid grid-cols-2 gap-10 pr-[8rem] md:pr-0" enctype="multipart/form-data">
                    <div class=" col-span-1">
                        <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="fname" id="fname" value="<?= $fname ?>" class="border w-full py-2 px-2" required>
                    </div>
                    <div class="col-span-1">
                        <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="lname" id="lname" value="<?= $lname ?>" class="border w-full py-2 px-2" required>
                    </div>
                    <div class="col-span-1">
                        <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" value="<?= $contact_number ?>" class="border w-full py-2 px-2" required>
                    </div>
                    <div class="col-span-1">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" value="<?= $username ?>" class="border w-full py-2 px-2" required>
                    </div>
                    <div class="col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" value="<?= $email ?>" class="border w-full py-2 px-2" required>
                    </div>
                    <div class="col-span-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" value="" class="border w-full py-2 px-2" minlength="8">
                    </div>
                    <div class="col-span-2">
                        <label for="profile_img" class="block text-sm font-medium text-gray-700">Profile Image</label>
                        <input type="file" name="profile_img" id="profile_img" accept="image/png, image/jpeg" class="border w-full py-2 px-2">
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <input class="border border-[#101010] bg-[#101010] text-white hover:bg-white hover:text-[#101010] w-full py-2.5 transition-colors delay-75 ease-linear cursor-pointer" type="submit" value="Update Profile">
                    </div>
                </form>

                <?php

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $contact_number = $_POST['contact_number'];

                    $newPassword = $_POST['password'];
                    if ($newPassword != "") {
                        $hashPass = hash_password($newPassword);
                    }

                    if (isset($_FILES["profile_img"]) && $_FILES["profile_img"]["error"] == UPLOAD_ERR_OK) {
                        $file_name = $_FILES["profile_img"]["name"];
                        $file_type = $_FILES["profile_img"]["type"];
                        $file_size = $_FILES["profile_img"]["size"];
                        $file_temp = $_FILES["profile_img"]["tmp_name"];

                        $upload_dir = "/nstudio/img/profile/";
                        $destination = $upload_dir . $file_name;

                        if (move_uploaded_file($file_temp, "../../img/profile/" . $file_name)) {
                            if (isset($hashPass)) {
                                $sql = "UPDATE site_user SET 
                                        fname = ?, lname = ?, 
                                        email = ?, image_path = ?, 
                                        username = ?, contact_number = ?, 
                                        password = ? WHERE id = $userID";
                            } else {
                                $sql = "UPDATE site_user SET 
                                        fname = ?, lname = ?, 
                                        email = ?, image_path = ?, 
                                        username = ?, contact_number = ? 
                                        WHERE id = $userID";
                            }

                            $query = $conn->prepare($sql);

                            if (isset($hashPass)) {
                                $query->bind_param("sssssss", $fname, $lname, $email, $destination, $username, $contact_number, $hashPass);
                            } else {
                                $query->bind_param("ssssss", $fname, $lname, $email, $destination, $username, $contact_number);
                            }
                            $query->execute();

                            if ($query->affected_rows == 1) {
                                echo "<script>alert('Profile Updated!')</script>";
                                echo "<script>window.location.href = 'profile.php'</script>";
                            } else {
                                echo "<script>alert('Error!')</script>";
                                echo "<script>window.location.href = 'profile.php'</script>";
                            }
                        } else {
                            echo "Error uploading file.";
                        }
                    } else {
                        if (isset($hashPass)) {
                            $sql = "UPDATE site_user SET 
                                    fname = ?, lname = ?, 
                                    email = ?, 
                                    username = ?, contact_number = ?, 
                                    password = ? WHERE id = $userID";
                        } else {
                            $sql = "UPDATE site_user SET 
                                    fname = ?, lname = ?, 
                                    email = ?,
                                    username = ?, contact_number = ? 
                                    WHERE id = $userID";
                        }
                        $query = $conn->prepare($sql);

                        if (isset($hashPass)) {
                            $query->bind_param("ssssss", $fname, $lname, $email, $username, $contact_number, $hashPass);
                        } else {
                            $query->bind_param("sssss", $fname, $lname, $email, $username, $contact_number);
                        }
                        $query->execute();

                        if ($query->affected_rows == 1) {
                            echo "<script>alert('Profile Updated!')</script>";
                            echo "<script>window.location.href = 'profile.php'</script>";
                        } else {
                            echo "<script>alert('Error!')</script>";
                            echo "<script>window.location.href = 'profile.php'</script>";
                        }
                    }
                }

                ?>
            </div>
    </main>
    <!-- Footer -->
    <?php require '../partials/footer.php' ?>
</body>

</html>