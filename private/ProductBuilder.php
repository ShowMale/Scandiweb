<?php
require_once 'model/dvd.php';
require_once 'model/furniture.php';
require_once 'model/book.php';
require_once 'model/product.php';
require_once 'model/DVDFactory.php';
require_once 'model/BookFactory.php';
require_once 'model/FurnitureFactory.php';

class ProductBuilder
{

    public static function selectProduct($data) {
        $factory_class = ucfirst($data['productType']) . 'Factory';
        $product = $factory_class::create($data);
        return $product;
    }

}
