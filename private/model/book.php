<?php
require_once 'product.php';

class Book extends Product {


    function __construct($result) {
        parent::__construct($result);
    }

    function setAttr() {
        $this->attribute = 'Weight';
    }

    function setValue() {
        $this->value = $this->userData['weight'];
    }

    function setUnit() {
        $this->unit = 'KG';
    }

}
