<?php

class FurnitureFactory {

    public static function create($data) {
        return new Furniture($data);
    }
}
