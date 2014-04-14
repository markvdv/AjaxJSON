<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductService
 *
 * @author mark.vanderveken
 */
require_once 'Data/ProductDAO.class.php';

class ProductService {

    public static function toonProducten() {
        $productenlijst = ProductDAO::getAll();
        return $productenlijst;
    }

  
  /*  private static function toonProductenSerialized() {
         $productenlijst = ProductDAO::getAll();
         echo "<pre>";
         print_r($productenlijst);
         echo "</pre>";
         echo __LINE__ . "<br>" . __FILE__ . "<br>";
         foreach ($productenlijst as $product){
             $product= $this->jsonSerialize($product);
         }
         print_r($productenlijst);
         die;
        return $productenlijst;
    }*/
}
