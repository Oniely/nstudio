<?php

require "../session.php";
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
                shop_order_tbl.id = ? AND order_status="TO PAY"';

        $query = $conn->prepare($sql);
        $query->bind_param('i', $order_id);
        $query->execute();

        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) :
                $cancel = "CANCELLED";
                $order_id = $row['id'];
                $product_item_id = $row['product_item_id'];
                $backQuantity = $row['quantity'];

                $sql = "UPDATE shop_order_tbl SET order_status = ? WHERE id = ?";
                $sql2 = "UPDATE product_item SET quantity = quantity + ? WHERE id = ?";
                $sql3 = "UPDATE order_line_tbl SET quantity = 0 WHERE order_id = ?";

                $query1 = $conn->prepare($sql);
                $query1->bind_param('si', $cancel, $order_id);

                $query2 = $conn->prepare($sql2);
                $query2->bind_param('ii', $backQuantity, $product_item_id);

                $query3 = $conn->prepare($sql3);
                $query3->bind_param('i', $order_id);

                $query1->execute();
                $query2->execute();
                $query3->execute();

                if ($query1 && $query2 && $query3) {
                    echo "SUCCESS";
                } else {
                    echo "ERROR";
                }
            endwhile;
        }
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}
