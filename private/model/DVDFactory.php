<?php

class DVDFactory {

    public static function create($data) {
        return new DVD($data);
    }
}
