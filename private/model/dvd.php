<?php
require_once 'product.php';

class Dvd extends Product {


    function __construct($result) {
        parent::__construct($result);
    }

    function setAttr() {
        $this->attribute = 'Size';
    }

    function setValue() {
        $this->value = $this->userData['size'];
    }

    function setUnit() {
        $this->unit = 'MB';
    }

}
