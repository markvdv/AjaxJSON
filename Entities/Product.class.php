<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *implements JsonSerializable (http://www.php.net/manual/en/class.jsonserializable.php)
 * @author mark.vanderveken
 */

class Product implements JsonSerializable{

    private static $idMap = array();
    private $productid;
    private $productnaam;
    private $productomschrijving;
    private $productprijs;
    
    private function __construct($productid,$productnaam,$productomschrijving,$productprijs){
        $this->productid=$productid;
        $this->productnaam=$productnaam;
        $this->productomschrijving=$productomschrijving;
        $this->productprijs=$productprijs;
    }
    public function create($productid,$productnaam,$productomschrijving,$productprijs) {
        if(!isset(self::$idMap[$productid])){
            self::$idMap[$productid]=new Product($productid, $productnaam, $productomschrijving, $productprijs);
        }
        return self::$idMap[$productid];
    }
    /**wordt automatisch opgeroepen wanneer json_encode wordt toegepast op een object van de class Product.
     * 
     * @return object in JSONString
     */
  public function jsonSerialize() {
        return [
            "productId" => $this->productid,
            "productNaam" => $this->productnaam,
            "productOmschrijving" => $this->productomschrijving,
            "productPrijs" => $this->productprijs
        ];
    }
// <editor-fold defaultstate="collapsed" desc="getter setter">
    public function getProductid() {
        return $this->productid;
    }

    public function setProductid($productid) {
        $this->productid = $productid;
    }

    public function getProductnaam() {
        return $this->productnaam;
    }

    public function setProductnaam($productnaam) {
        $this->productnaam = $productnaam;
    }

    public function getProductomschrijving() {
        return $this->productomschrijving;
    }

    public function setProductomschrijving($productomschrijving) {
        $this->productomschrijving = $productomschrijving;
    }

    public function getProductprijs() {
        return $this->productprijs;
    }

    public function setProductprijs($Productprijs) {
        $this->productprijs = $Productprijs;
    }

    public function getBestelregelid() {
        return $this->bestelregelid;
    }

    public function setBestelregelid($bestelregelid) {
        $this->bestelregelid = $bestelregelid;
    }

// </editor-fold>
}
