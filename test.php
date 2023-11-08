<?php
// Outer associative array
$outerArray = array(
    "key1" => "value1",
    "key2" => "value2"
);

// Inner associative array
$innerArray = array(
    "inner_key1" => "inner_value1",
    "inner_key2" => "inner_value2"
);

// Append inner associative array to outer associative array
$outerArray["inner_data"] = $innerArray;

// Now $outerArray contains the inner associative array under the key "inner_data"
print_r($outerArray);
?>