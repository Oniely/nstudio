<?php

require_once '../../includes/session.php';
require_once '../../includes/connection.php';
require_once '../../includes/functions.php';

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

?>
<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<?php require '../partials/head.php' ?>

<body class="min-h-screen">
    <!-- Navbar -->
    <?php require '../partials/nav.php' ?>
    <!-- Main -->
    <main class="min-h-screen h-full py-6">
        <div class="container min-h-screen pt-[4rem] px-[4rem] flex flex-col gap-7">
            <div class="pl-[10rem] text-[#505050]">
                <p class="uppercase text-sm">Account / Dashboard / Profile</p>
                <h1 class="uppercase text-4xl font-semibold tracking-wider">Your Profile</h1>
            </div>
            <div class="flex items-start">
                <div class="flex flex-col justify-start items-start gap-1 pt-[3.1rem]">
                    <h1 class="text-xl font-semibold px-2">Account</h1>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="dashboard.php">Dashboard</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100 font-medium underline" href="profile.php">Profile</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="address.php">Address</a>
                    <a class="py-1 text-start px-2 w-[8rem] hover:bg-slate-100" href="/nstudio/includes/logout.php">Logout</a>
                </div>
                <form method="POST" class="container h-auto pl-10 grid grid-cols-2 gap-10 pr-[12rem]" enctype="multipart/form-data">
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
                        <input type="password" name="password" id="password" value="" class="border w-full py-2 px-2" minlength="8" required>
                    </div>
                    <div class="col-span-2">
                        <label for="profile_img" class="block text-sm font-medium text-gray-700">Profile Image</label>
                        <input type="file" name="profile_img" id="profile_img" accept="image/png, image/jpeg" class="border w-full py-2 px-2" required>
                    </div>
                    <div class="col-span-1">
                        <input class="border border-[#101010] bg-[#101010] text-white hover:bg-white hover:text-[#101010] w-full py-3 transition-colors delay-75 ease-linear cursor-pointer" type="submit" value="Update Profile">
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
                    $hashPass = hash_password($newPassword);

                    if (isset($_FILES["profile_img"]) && $_FILES["profile_img"]["error"] == UPLOAD_ERR_OK) {
                        $file_name = $_FILES["profile_img"]["name"];
                        $file_type = $_FILES["profile_img"]["type"];
                        $file_size = $_FILES["profile_img"]["size"];
                        $file_temp = $_FILES["profile_img"]["tmp_name"];

                        $upload_dir = "/nstudio/img/profile/";
                        $destination = $upload_dir . $file_name;

                        if (move_uploaded_file($file_temp, "../../img/profile/" . $file_name)) {
                            $sql = "UPDATE site_user SET 
                                    fname = ?, lname = ?, 
                                    email = ?, image_path = ?, 
                                    username = ?, contact_number = ?, 
                                    password = ? WHERE id = $userID";

                            $query = $conn->prepare($sql);
                            $query->bind_param("sssssss", $fname, $lname, $email, $destination, $username, $contact_number, $hashPass);
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
                    }
                }

                ?>
            </div>
    </main>
    <!-- Footer -->
    <?php require '../partials/footer.php' ?>
</body>

</html>