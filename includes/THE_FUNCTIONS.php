<?php

function dd($value)
{
    var_dump("<pre>$value</pre>");
    die(1);
}

function blobToImageConverter($blobData, $outputPath)
{
    $image = imagecreatefromstring($blobData);
    if ($image !== false) {
        $rootDirectory = $_SERVER['DOCUMENT_ROOT'];
        $saveDirectory = $rootDirectory . $outputPath;

        // Ensure the output directory exists
        if (!is_dir(dirname($saveDirectory))) {
            // Create the directory if it doesn't exist
            mkdir(dirname($saveDirectory), 0777, true);
        }

        // Try saving the image
        $result = imagejpeg($image, $saveDirectory, 90);
        imagedestroy($image);

        if ($result) {
            return true;
        } else {
            error_log("Failed to save image to $saveDirectory");
            return false;
        }
    } else {
        error_log("Failed to create image from blob data");
        return false;
    }
}

function checkUserAddress($userID, $addressID)
{
    require "connection.php";

    $sql = "SELECT * FROM user_address WHERE user_id = ? and address_id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param('ii', $userID, $addressID);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function clearUserAddressDefaults($userID)
{
    require "connection.php";

    $updateSql = "UPDATE user_address SET is_default = 0 WHERE user_id = ?";
    $updateQuery = $conn->prepare($updateSql);
    $updateQuery->bind_param("i", $userID);
    $updateQuery->execute();

    if ($updateQuery) {
        return true;
    } else {
        return false;
    }
}