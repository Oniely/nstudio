<?php

session_start();

require '../connection.php';

if (isset($_GET["keywords"])) {
    $keywords = $_GET["keywords"];

    $sql = 
        "SELECT DISTINCT
            product_tbl.*,
            product_item.*
        FROM
            product_tbl
        JOIN
            product_item ON product_tbl.product_id = product_item.product_id WHERE keywords LIKE '%$keywords%'";
    $result = $conn->query($sql);

    $suggestions = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (stripos($row['keywords'], ',') !== false) {
                $keywordsArr = explode(",", $row['keywords']);
                $pattern = "/\b" . $keywords . "\w*/i";

                foreach ($keywordsArr as $keyword) {
                    if (preg_match($pattern, $keyword)) {
                        $suggestions[] = $keyword;
                    }
                }
            } else {
                $suggestions[] = $row['keywords'];
            }
        }
    }
    echo json_encode(array_unique($suggestions));
}
