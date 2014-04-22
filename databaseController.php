<?php

require_once 'Business/ProductService.class.php';

// ophalen van voorbeeld gegevensobjecten
$productenlijst = ProductService::toonProducten();

//check for user input and encodes of the json string with the data from the db 
// added JsonSerialize to the entity for proper Json encoding
if ($_GET['w'] != '') {
    $productenlijst['query'] = $_GET['w'];
}
$json = json_encode($productenlijst);



//omzetten van gegevensobjecten naar een jsonstring
/* $json = '{"queryParam":"' . $_POST['w'] . '","producten":[';
  foreach ($productenlijst as $product) {

  if (isset($_POST['w']) && $_POST['w'] != '') {
  $param = "/" . $_POST['w'] . "/";
  if (preg_match(strtolower($param), strtolower($product->getProductNaam()))) {
  $json.= json_encode($product) . ',';
  }
  } else {
  $json.= json_encode($product) . ',';
  }
  } */
print($json);
?>


