<?php

require_once 'THE_MYSQL.php';
require_once 'THE_RENDERER.php';
require_once 'THE_FUNCTIONS.php';
require_once 'THE_AUTH.php';

class EcommerceStore extends Auth
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
        return blobToImageConverter($blobData, $outputPath);
    }

    public function getUser($user_id)
    {
        $data = $this->db->selectWhere('site_user', 'id', '=', $user_id, 'int');
        return $data[0];
    }

    public function showProducts($products)
    {
        if ($products == null) {
            $this->render->showFallbackMessage("No result found.");
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

    public function showCaseProducts()
    {

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

    public function checkCategory($category)
    {
        $count = $this->db->getCategoryCount($category);
        $exists = $count > 0 ? true : false;
        return $exists;
    }

    public function showCategoryLinks($category)
    {
        $links = $this->db->getCategoryLinks($category);

        foreach ($links as $link) {
            $this->render->categoryLinks($link);
        }
    }

    public function cartCount($userID)
    {
        $count = $this->db->countRowsWhere('cart_tbl', 'user_id', '=', $userID, 'int');
        return $count;
    }

    public function showCartProducts($userID)
    {
        $products = $this->db->getCartProducts($userID);

        if ($products == null) {
            return;
        }

        foreach ($products as $row) {
            $img = $row['product_image1'];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/nstudio/img/product/prod" . $row['id'] . ".png";
            $this->blobToImage($img, $path);
            $img_path = "/nstudio/img/product/prod" . $row['product_item_id'] . ".png";
            $this->render->cartProducts($row, $img_path);
        }
    }

    public function getCartSubtotal($userID)
    {
        $products = $this->db->getCartProducts($userID);
        $subtotal = 0;

        if ($products == null) {
            return $subtotal;
        }

        foreach ($products as $product) {
            $subtotal += ($product['price'] * $product['cart_quantity']);
        }

        return $subtotal;
    }

    public function viewProduct($product_id, $colour_id)
    {
        $data = $this->db->getProduct($product_id, $colour_id);

        if ($data == null) {
            $this->render->showFallbackMessage('Product Not Available.');
            return;
        }
        $product = $data[0];

        $this->render->desktopViewProduct($product);
        $this->render->mobileViewProduct($product);
    }
}
