<?php

require_once './includes/THE_INITIALIZER.php';
require_once './views/partials/head.php';


$App = new App();

?>
<div class="flex">
<?php
    $products = $App->db->getSearchProducts("tailored");
    $App->store->showProducts($products);
?>
</div>