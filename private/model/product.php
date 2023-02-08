<?php

class Product {

    protected $userData;
    protected $name;
    protected $sku;
    protected $price;
    protected $attribute;
    protected $value;
    protected $unit;

    function __construct($result) {
        $this->userData = $result;
        $this->name = $result['name'];
        $this->sku = $result['sku'];
        $this->price = $result['price'];
    }

    // Getter for Showing products

    public function getSku() {
        return $this->sku . "<br/>";
    }

    public function getName() {
        return $this->name . "<br/>";
    }
    
    public function getPrice() {
        return $this->price . " $" . "<br/>";
    }

    public function getAttribute() {
        return $this->userData['attribute'] . ": ";
    }

    public function getValue() {
        return $this->userData['value'] . " ";
    }

    public function getUnit() {
        return $this->userData['unit'];
    }

    // Getters for Creating a product

    public function getSkus() {
        return $this->sku;
    }

    public function getNames() {
        return $this->name;
    }

    public function getPrices() {
        return $this->price;
    }

    public function getAttributes() {
        return $this->attribute;
    }

    public function getValues() {
        return $this->value;
    }

    public function getUnits() {
        return $this->unit;
    }

}
