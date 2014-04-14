<?php

require_once 'Business/ProductService.class.php';

// ophalen van voorbeeld gegevensobjecten
$productenlijst = ProductService::toonProducten();

//omzetten van gegevensobjecten naar een jsonstring
$json = '{"producten":[';
foreach ($productenlijst as $product) {
    $json.= json_encode($product) . ',';
}
$json = rtrim($json, ',');

//test adding functions for sorting
$json.='],"functies": [1,2,3,4';
$json.="]}";

print($json);
?>


