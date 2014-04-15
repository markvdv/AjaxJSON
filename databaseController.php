<?php

require_once 'Business/ProductService.class.php';

// ophalen van voorbeeld gegevensobjecten
$productenlijst = ProductService::toonProducten();


 if ($_POST['w'] != '') {
  $productenlijst= array_reverse($productenlijst);
  $productenlijst['query']=$_POST['w'];
  $productenlijst= array_reverse($productenlijst);
  }
  $json = json_encode($productenlijst); 
//omzetten van gegevensobjecten naar een jsonstring
/*$json = '{"queryParam":"' . $_POST['w'] . '","producten":[';
foreach ($productenlijst as $product) {

    if (isset($_POST['w']) && $_POST['w'] != '') {
        $param = "/" . $_POST['w'] . "/";
        if (preg_match(strtolower($param), strtolower($product->getProductNaam()))) {
            $json.= json_encode($product) . ',';
        }
    } else {
        $json.= json_encode($product) . ',';
    }
}*/



print($json);
?>


