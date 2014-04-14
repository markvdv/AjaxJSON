<?php
require_once 'Business/ProductService.class.php';
$db = new PDO('mysql:dbname=pizzeria;host=localhost', 'root', '');
$resultSet = $db->query("SELECT * FROM product");

// ophalen van voorbeeld gegevens
$productenlijst=ProductService::toonProducten();
$json='';
foreach ($productenlijst as $product){
    $json.= json_encode($product,JSON_PRETTY_PRINT);
}

/*foreach ($resultSet as $result) {
    if ($_POST['w'] != '') {
        if ($result['productomschrijving'][0] === $_POST['w']) {
            print($result['productomschrijving'] . "<br>");
           
            
            
            
            $json=json_encode(array("test"=>$result['productomschrijving']));
        }
    } else {
        print($result['productomschrijving'] . "<br>");
    }
}*/

print("JSON".$json);
print('AJAX succes');
