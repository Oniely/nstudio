<?php

function hash_password($passw) {
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($passw, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}

function loginAuth($username, $password)
{
    require "connection.php";

    $sql = "SELECT id, username_email, password FROM user_acc_tbl WHERE username_email='$username'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            return true;
        } else {
            session_destroy();
            return false;
        }
    }
}