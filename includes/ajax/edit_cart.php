<?php

global $conn;

session_start();

require "../connection.php";

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['product_id']) && isset($_GET['item_id']) && isset($_GET['colour_value'])) {
        $product_id = $_GET['product_id'];
        $product_item_id = $_GET['item_id'];
        $colour_value = $_GET['colour_value'];

        $sql = "SELECT
                product_item.id,
                colour.colour_value,
                size.size_value
                FROM
                product_item
                JOIN colour ON product_item.colour_id = colour.id
                JOIN size ON product_item.size_id = size.id
                WHERE
                product_item.product_id = ? AND colour_value = ?";

        $query = $conn->prepare($sql);
        $query->bind_param('is', $product_id, $colour_value);
        $query->execute();

        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
?>
            <select class="w-fit py-1 variation" name="variation" id="variation">
                <?php
                while ($row = $result->fetch_assoc()) :
                ?>
                    <option class="text-gray-400" value="<?= $row['id'] ?>" <?= $product_item_id == $row['id'] ? "selected" : "" ?>><?= $row['colour_value'] .  " | " . $row['size_value'] ?></option>
                <?php
                endwhile;
                ?>
            </select>
            <?php
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == "done" && isset($_POST['item_id']) && isset($_POST['currentItemID'])) {
        $product_item_id = $_POST['item_id'];
        $currentItemID = $_POST['currentItemID'];
        // check if the item already exist in the cart
        $sql = "SELECT * FROM cart_tbl WHERE product_item_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $product_item_id);
        $query->execute();

        $result = $query->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // if the selected value is already in the cart then just update the quantity of that cart
            if ($row['product_item_id'] == $product_item_id) {
                $sql = "SELECT quantity FROM cart_tbl WHERE product_item_id = $currentItemID";
                $quantity = $conn->query($sql)->fetch_assoc();

                $sqlDelete = "DELETE FROM cart_tbl WHERE product_item_id = $currentItemID";
                $result = $conn->query($sqlDelete);

                if ($result) {
                    $sql = "UPDATE cart_tbl SET quantity = quantity + $quantity[quantity] WHERE product_item_id = ?";
                    $query = $conn->prepare($sql);
                    $query->bind_param('i', $product_item_id);
                    $query->execute();

                    if ($query->affected_rows == 1) {
                        echo "SUCCESS";
                        exit();
                    } else {
                        echo "ERROR";
                        exit();
                    }
                }
            } else {
                echo "ERROR";
                exit();
            }
        }
        // real editing here
        $sql = "UPDATE cart_tbl SET product_item_id = ?  WHERE product_item_id = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("ii", $product_item_id, $currentItemID);

        if ($query->execute()) {
            $sql = "SELECT
                    product_item.id,
                    colour_value,
                    size_value
                    FROM
                    product_item
                    JOIN colour ON product_item.colour_id = colour.id
                    JOIN size ON product_item.size_id = size.id
                    WHERE
                    product_item.id = ?";

            $query = $conn->prepare($sql);
            $query->bind_param("i", $product_item_id);
            $query->execute();

            $result = $query->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
            ?>
                <p class="text-gray-400"><?= $row['colour_value'] ?> | <?= $row['size_value'] ?></p>
<?php
            }
        } else {
            echo false;
        }
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}
