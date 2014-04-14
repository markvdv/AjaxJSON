<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo __LINE__ . "<br>" . __FILE__ . "<br>";
$db=new PDO('mysql:dbname=pizzeria;host=localhost', 'root', '');
$resultSet=$db->query("SELECT * FROM product");
foreach ($resultSet as $result){
    if($_POST['w']!=''){
    if ($result['productomschrijving'][25]!==null&&$result['productomschrijving'][25]===$_POST['w']){
    print($result['productomschrijving']."<br>");
    }
    }
    else{
         print($result['productomschrijving']."<br>");
    }
}


print('AJAX succes');
