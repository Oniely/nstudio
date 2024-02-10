<?php

require_once 'THE_MYSQL.php';
require_once 'THE_FUNCTION.php';
require_once 'THE_RENDERER.php';

class App {
    public $db;
    public $render;
    public $store;

    public function __construct()
    {
        $this->db = new Mysql();
        $this->render = new ProductRenderer($this->db);
        $this->store = new EcommerceStore($this->db, $this->render);
    }
}