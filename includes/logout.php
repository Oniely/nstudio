<?php

require_once "auth.php";

session_start();

if (updateUserStatus($_SESSION['id'], false)) {
    session_unset();
    session_destroy();
    header("location: /nstudio/");
}
