<?php
require_once 'product.php';

class Book extends Product {

    function __construct($result) {
        parent::__construct($result);
        $this->attribute = 'Weight';
        $this->value = $this->userData['weight'];
        $this->unit = 'kg';
    }

}
