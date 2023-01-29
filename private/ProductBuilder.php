<?php
require_once 'model/dvd.php';
require_once 'model/furniture.php';
require_once 'model/book.php';
require_once 'model/product.php';


class ProductBuilder
{
    public static function selectProduct($data)
    {
        $product = '';
        switch($data['productType']) {
        case 'dvd':
                $product = new Dvd($data);
            break;
        case 'furniture':
                $product = new Furniture($data);               
            break;
        case 'book':
                $product = new Book($data);               
            break;
        }
        return $product;

    }

}
