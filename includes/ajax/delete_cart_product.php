<?php

session_start();

require '../redirect.php';
require '../connection.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if (isset($_POST['action']) && $_POST['action'] === "delete_product") {
    if (isset($_POST['item_id'])) {
        $product_item_id = $_POST['item_id'];

        $sql = "DELETE FROM cart_tbl WHERE user_id=? AND product_item_id=?";
        $query = $conn->prepare($sql);
        $query->bind_param('ii', $userID, $product_item_id);
        $query->execute();

        if ($query->affected_rows > 0) {
            $sql = "SELECT * FROM cart_tbl WHERE user_id=?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $userID);

            if ($query->execute()) {
                $result = $query->get_result();
                if ($result->num_rows > 0) {
                    echo "SUCCESS";
                    return;
                } else {
                    echo "EMPTY";
                    return;
                }
            } else {
                echo "FAILURE";
                return;
            }
        } else {
            echo "FAILURE";
        }
    } else {
        echo "FAILURE";
    }
}
