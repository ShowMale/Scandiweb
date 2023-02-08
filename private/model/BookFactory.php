<?php

class BookFactory {

    public static function create($data) {
        return new Book($data);
    }
}
