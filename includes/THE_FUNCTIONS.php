<?php

function blobToImageConverter($blobData, $outputPath)
{
    $image = imagecreatefromstring($blobData);
    if ($image !== false) {
        $result = imagejpeg($image, $outputPath, 90);
        imagedestroy($image);
        if ($result) {
            return true;
        } else {
            error_log("Failed to save image to $outputPath");
            return false;
        }
    } else {
        error_log("Failed to create image from blob data");
        return false;
    }
}