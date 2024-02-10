<?php

require_once 'THE_MYSQL.php';
require_once 'THE_RENDERER.php';

class EcommerceStore
{
    public $db;
    public $render;

    public function __construct(Mysql $db, ProductRenderer $render)
    {
        $this->db = $db;
        $this->render = $render;
    }

    public function blobToImage($blobData, $outputPath)
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

    public function getUser($user_id) {
        $data = $this->db->selectWhere('site_user', 'id', '=', $user_id, 'int');
        return $data[0];
    }

    public function showProducts($products)
    {
        if ($products == null) {
            $this->render->noProductAvailable();
            return;
        }

        foreach ($products as $row) {
            $img = $row['product_image1'];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/nstudio/img/product/prod" . $row['id'] . ".png";
            $this->blobToImage($img, $path);
            $img_path = "/nstudio/img/product/prod" . $row['id'] . ".png";
            if ($row['quantity'] > 0) {
                $this->render->productCard($row, $img_path);
            }
        }
    }

    public function showCaseProducts() {
        
        $dataSet = $this->db->getShowCaseProducts();
        $imageData = [];

        foreach ($dataSet as $row) {
            $img = $row['product_image1'];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/nstudio/img/product/prod" . $row['id'] . ".png";
            $this->blobToImage($img, $path);

            $img_path = "./img/product/prod" . $row['id'] . ".png";
            
            $imageData[] = [
                'image' => $img_path,
                'product_id' => $row['product_id'],
                'colour_id' => $row['colour_id'],
            ];
        }
        $this->render->showCaseImages($imageData);
    }

    public function checkCategory($category) {
        $count = $this->db->getCategoryCount($category);
        $exists = $count > 0 ? true : false;
        return $exists;
    }

    public function showCategoryLinks($category) {
        $links = $this->db->getCategoryLinks($category);

        foreach ($links as $link) {
            $this->render->categoryLinks($link);
        }
    }

    public function cartCount($userID) {
        $count = $this->db->countRowsWhere('cart_tbl', 'user_id', '=', $userID, 'int');
        return $count;
    }
}
