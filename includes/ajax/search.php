<?php

session_start();
session_regenerate_id();

include '../connection.php';

if(isset($_GET["keywords"])) {
    $keywords = $_GET["keywords"];
    
    $sql = "SELECT DISTINCT keywords FROM product_tbl WHERE keywords LIKE '%$keywords%'";
    $result = $conn->query($sql);
    
    $suggestions = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $suggestions[] = $row["keywords"];
        }
    }
    
    echo json_encode($suggestions);
}
