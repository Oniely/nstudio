<?php

function dd($value)
{
    var_dump("<pre>$value</pre>");
    die(1);
}

function hash_password($passw)
{
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($passw, PASSWORD_BCRYPT, $options);

    return $hashedPassword;
}

function loginAuth($usernameEmail, $password)
{
    require "connection.php";


    if (filter_var($usernameEmail, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM site_user WHERE email = BINARY '$usernameEmail'";
        $result = $conn->query($sql);
    } else {
        $sql = "SELECT * FROM site_user WHERE username = BINARY '$usernameEmail'";
        $result = $conn->query($sql);
    }

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION['id'] = $row['id'];
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

function signUpAuth($fname, $lname, $contact, $username, $email, $password)
{
    require "connection.php";

    $sql = "SELECT * FROM site_user WHERE username='$username' AND email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return false;
    }

    $hashedPass = hash_password($password);

    $insertSql = "INSERT INTO site_user VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, DEFAULT, DEFAULT, DEFAULT)";
    $query = $conn->prepare($insertSql);
    $query->bind_param("ssssss", $fname, $lname, $contact, $username, $email, $hashedPass);
    $query->execute();

    if ($query->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function updateUserStatus($userID, $status)
{
    require "connection.php";

    $status = intval($status);
    $sql = "UPDATE site_user SET status=$status, token=DEFAULT WHERE id='$userID'";
    $result = $conn->query($sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function checkEmail($email)
{
    require "connection.php";

    $sql = "SELECT * FROM site_user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
