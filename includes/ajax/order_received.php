<?php

session_start();

require "../connection.php";
require "../functions.php";

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['orderID'])) {
        $order_id = $_POST['orderID'];

        $sql = 'SELECT
                shop_order_tbl.*,
                order_line_tbl.quantity,
                order_line_tbl.product_item_id
                FROM
                shop_order_tbl
                JOIN order_line_tbl ON order_line_tbl.order_id = shop_order_tbl.id
                WHERE
                shop_order_tbl.id = ? AND order_status = "DELIVERED"';

        $query = $conn->prepare($sql);
        $query->bind_param('i', $order_id);
        $query->execute();

        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) :
                $completed = "COMPLETED";
                $order_id = $row['id'];
                $product_item_id = $row['product_item_id'];
                $backQuantity = $row['quantity'];

                $sql = "UPDATE shop_order_tbl SET order_status = ?, receive_date = CURRENT_TIMESTAMP WHERE id = ?";

                $query1 = $conn->prepare($sql);
                $query1->bind_param('si', $completed, $order_id);


                $query1->execute();

                if ($query1) {
                    echo "SUCCESS";
                } else {
                    echo "ERROR";
                }
            endwhile;
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}
