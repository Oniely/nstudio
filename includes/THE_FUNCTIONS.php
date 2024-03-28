<?php

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
