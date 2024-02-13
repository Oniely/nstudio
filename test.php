<?php

require_once './includes/THE_INITIALIZER.php';
require_once './views/partials/head.php';


$App = new App();

?>
<div class="flex">

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="profile_img" id="profile_img">
        <input type="submit" name="submit" id="submit">
    </form>

    <?php

    if (isset($_POST['submit'])) {
        if (
            isset($_FILES['profile_img'])
            && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK
            && $_FILES['profile_img']['size'] > 0
        ) {

            $file_name = $_FILES['profile_img']['name'];
            $file_temp = $_FILES['profile_img']['tmp_name'];

            $destination = "/nstudio/img/profile/" . $file_name;

            if (move_uploaded_file($file_temp, "./img/profile/" . $file_name)) {
                echo $destination;
            } else {
                echo "FAILED";
            }
        }
    }

    ?>
</div>