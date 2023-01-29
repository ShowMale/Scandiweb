<?php
require_once 'product.php';

class Furniture extends Product {


    function __construct($result) {
        parent::__construct($result);
    }

    function setAttr() {
        $this->attribute = 'Dimension';
    }

    function setValue() {
        $this->value = $this->userData['height'] . "x" . $this->userData['width'] . "x" . $this->userData['length'];
    }

    function setUnit() {
        $this->unit = 'CM';
    }

}
