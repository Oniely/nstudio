<?php

$realpath = realpath($_SERVER['DOCUMENT_ROOT']) . '/nstudio/includes/THE_APP.php';
require_once $realpath;

$App = new App();
if (isset($_SESSION["id"]) && $_SESSION["id"] !== "") {
    $userID = $_SESSION["id"];
    $user = $App->store->getUser($userID);
    $profile_img = $user['image_path'];
} else {
    $userID = "";
}