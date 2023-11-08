<?php

include '../session.php';

include '../connection.php';

if (isset($_GET["keywords"])) {
    $keywords = $_GET["keywords"];

    $sql = "SELECT DISTINCT keywords FROM product_tbl WHERE keywords LIKE '%$keywords%'";
    $result = $conn->query($sql);

    $suggestions = array();

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
    echo json_encode($suggestions);
}
