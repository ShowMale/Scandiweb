<?php
require_once 'product.php';

class Furniture extends Product {

    function __construct($result) {
        parent::__construct($result);
        $this->attribute = 'Dimension';
        $this->value = $this->userData['height'] . "x" . $this->userData['width'] . "x" . $this->userData['length'];
        $this->unit = 'cm';
    }

}
