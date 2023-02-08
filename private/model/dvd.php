<?php
require_once 'product.php';

class Dvd extends Product {


    function __construct($result) {
        parent::__construct($result);
        $this->attribute = 'Size';
        $this->value = $this->userData['size'];
        $this->unit = 'MB';
    }

}
