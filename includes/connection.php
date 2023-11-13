<?php

$db_servername = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'ecom_db';

$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die('Connection Error' . $conn->connect_error);
}