<?php

global $conn;

session_start();

require '../connection.php';

if (isset($_SESSION['id']) && $_SESSION['id'] !== "") {
    $userID = $_SESSION['id'];
} else {
    header("Location: /nstudio/login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $street_name = $_POST['street_name'];
    $pcode = $_POST['pcode'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $country = $_POST['country'];
    $contact_number = $_POST['contact_number'];
    $default = $_POST['default'];

    if (isset($_POST['action']) && $_POST['action'] == "add_address") {
        $sql = "INSERT INTO address_tbl VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sssssssss", $fname, $lname, $email, $street_name, $pcode, $city, $province, $country, $contact_number);
        $query->execute();

        $addressID = $conn->insert_id;

        if ($query->affected_rows == 1) {
            if ($default == 1) {
                $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
                $updateQuery = $conn->prepare($updateSql);
                $updateQuery->bind_param("i", $userID);
                $updateQuery->execute();
            } else {
                $default = 0;
            }

            $sql = "INSERT INTO user_address VALUES (?, ?, ?)";
            $query = $conn->prepare($sql);
            $query->bind_param("iii", $userID, $addressID, $default);
            $query->execute();

            if ($query->affected_rows == 1) {
                $sql = "SELECT * FROM address_tbl WHERE id = ?";
                $query = $conn->prepare($sql);
                $query->bind_param('i', $addressID);
                $query->execute();

                $result = $query->get_result();
                $address = $result->fetch_assoc();
                $newData = array();

                $html = '<div class="addressCard w-[19rem] md:w-full flex flex-col border-[0.1px] border-[#505050] hover:shadow-xl hover:bg-[#f7f7f7] p-4 text-[15px] gap-3" data-address-id="' . $address['id'] . '">';
                $html .= '<div class="font-semibold flex justify-between">';
                $html .= '<h1 class="is_default">' . ($default == 1 ? 'Default' : '') . '</h1>';
                $html .= '<button class="deleteBtn p-1 active:scale-90" data-address-id="' . $address['id'] . '">';
                $html .= '<img class="w-4 h-4 object-cover pointer-events-none" src="/nstudio/img/x.svg" alt="x">';
                $html .= '</button>';
                $html .= '</div>';
                $html .= '<div class="font-medium leading-[1.2rem]">';
                $html .= '<p class="fullname overflow-hidden text-ellipsis whitespace-nowrap">' . $address['fname'] . ' ' . $address['lname'] . '</p>';
                $html .= '<p class="email overflow-hidden text-ellipsis whitespace-nowrap">' . $address['email'] . '</p>';
                $html .= '<p class="street_name overflow-hidden text-ellipsis whitespace-nowrap">' . $address['street_name'] . '</p>';
                $html .= '<p class="city overflow-hidden text-ellipsis whitespace-nowrap">' . $address['city'] . ', ' . $address['province'] . '</p>';
                $html .= '<p class="pcode overflow-hidden text-ellipsis whitespace-nowrap">' . $address['postal_code'] . '</p>';
                $html .= '<p class="country overflow-hidden text-ellipsis whitespace-nowrap">' . $address['country'] . '</p>';
                $html .= '<p class="contact_number overflow-hidden text-ellipsis whitespace-nowrap">' . $address['contact_number'] . '</p>';
                $html .= '</div>';
                $html .= '<div class="flex justify-center items-center border border-[#505050] transition-colors delay-75 ease-in-out">';
                $html .= '<button class="editBtn w-full h-full py-1 font-medium hover:text-white hover:bg-[#101010] active:bg-[#202020]" data-address-id="' . $address['id'] . '">Edit</button>';
                $html .= '</div>';
                $html .= '</div>';

                $newData[] = $html;
                $newData[] = $default;

                $json = json_encode($newData);

                echo $json;
            } else {
                echo "ERROR";
                return;
            }
        } else {
            echo "ERROR";
            return;
        }
    } else {
        echo "ERROR";
        return;
    }
} else {
    echo "ERROR";
    return;
}
