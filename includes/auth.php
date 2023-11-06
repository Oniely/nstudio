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

    $sql = "SELECT * FROM user_tbl WHERE user_email='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password === $row['user_password']) {
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['user_email'] = $row['user_email'];
            return true;
        } else {
            session_destroy();
            return false;
        }
    } else {
        session_destroy();
        return false;
    }
}
