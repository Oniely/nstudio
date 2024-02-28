<?php

require_once './includes/THE_INITIALIZER.php';
require_once './views/partials/head.php';


$App = new App();

?>
<div class="flex">

    <?php

    $username = "admins";
    $email = "asdasd@gmail.com";

    $result = $App->store->checkUsernameAndEmail(1, $username, $email);

    echo $result;

    ?>

</div>