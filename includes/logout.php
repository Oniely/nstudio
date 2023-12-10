<?php

session_start();

require_once "auth.php";

if (updateUserStatus($_SESSION['id'], false)) {
    session_unset();
    session_destroy();
    header("location: /nstudio/");
}
