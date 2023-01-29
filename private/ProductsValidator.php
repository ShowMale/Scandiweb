<?php 

class ProductsValidator {

    private array $data;
    private array $errors = [];
    private static array $dvd_fields = ['sku', 'name', 'price', 'size'];
    private static array $furniture_fields = ['sku', 'name', 'price', 'height', 'width', 'length'];
    private static array $book_fields = ['sku', 'name', 'price', 'weight'];

    public function __construct($post_data) {
    $this->data = $post_data;
    }

    public function validateDvdForm() {

    foreach(self::$dvd_fields as $field){
        if(!array_key_exists($field, $this->data)){
        trigger_error("Please, provide '$field'");
        return;
        }
    }

    $this->validateSku();
    $this->validateName();
    $this->validatePrice();
    $this->validateSize();
    return $this->errors;

    }

    public function validateFurnitureForm() {

    foreach(self::$furniture_fields as $field){
        if(!array_key_exists($field, $this->data)){
        trigger_error("Please, provide '$field'");
        return;
        }
    }

    $this->validateSku();
    $this->validateName();
    $this->validatePrice();
    $this->validateHeight();
    $this->validateWidth();
    $this->validateLength();
    return $this->errors;

    }

    public function validateBookForm() {

    foreach(self::$book_fields as $field){
        if(!array_key_exists($field, $this->data)){
        trigger_error("Please, provide '$field'");
        return;
        }
    }

    $this->validateSku();
    $this->validateName();
    $this->validatePrice();
    $this->validateWeight();
    return $this->errors;

    }

    private function validateSku() {

    $val = trim($this->data['sku']);

    if(empty($val)){
        $this->addError('sku', 'SKU cannot be empty.');
    } else {
        if(!preg_match('/^[a-zA-Z0-9-:._ ]+$/', $val)) {
            $this->addError('sku','SKU must contain [-:._ ] chars & alphanumeric.');
        } else {
            $skuCheck = new Dbc;
            if ( ($skuCheck->checkSKU($val)) === true ) {
                $this->addError('sku','This SKU already exists, choose another.');
            }
        }
    }

    }

    private function validateName() {

    $val = trim($this->data['name']);

    if(empty($val)){
        $this->addError('name', 'Name cannot be empty.');
    } else {
        if(!preg_match('/^[a-zA-Z0-9-:._ ]+$/', $val)){
        $this->addError('name','Name must contain [-:._ ] chars & alphanumeric.');
        }
    }

    }

    private function validatePrice() {

    $val = trim($this->data['price']);

    if(empty($val)){
        $this->addError('price', 'Price cannot be empty.');
    } else {
        if(!preg_match('/^([0-9]+(\\.[0-9]{1,2})?)$/', $val)){
        $this->addError('price','Price must contain numbers in 0.00 format.');
        }
    }

    }

    private function validateSize() {

    $val = trim($this->data['size']);

    if(empty($val)){
        $this->addError('size', 'Size cannot be empty.');
    } else {
        if(!preg_match('/^(0|[1-9][0-9]*)$/', $val)){
        $this->addError('size','Size must contain only whole numbers.');
        }
    }

    }

    private function validateHeight() {

    $val = trim($this->data['height']);

    if(empty($val)){
        $this->addError('height', 'Height cannot be empty.');
    } else {
        if(!preg_match('/^(0|[1-9][0-9]*)$/', $val)){
        $this->addError('height','Height must contain whole numbers.');
        }
    }

    }

    private function validateWidth() {

    $val = trim($this->data['width']);

    if(empty($val)){
        $this->addError('width', 'Width cannot be empty.');
    } else {
        if(!preg_match('/^(0|[1-9][0-9]*)$/', $val)){
        $this->addError('width','Width must contain whole numbers.');
        }
    }

    }

    private function validateLength() {

    $val = trim($this->data['length']);

    if(empty($val)){
        $this->addError('length', 'Length cannot be empty.');
    } else {
        if(!preg_match('/^(0|[1-9][0-9]*)$/', $val)){
        $this->addError('length','Length must contain whole numbers.');
        }
    }

    }

    private function validateWeight() {

    $val = trim($this->data['weight']);

    if(empty($val)){
        $this->addError('weight', 'Weight cannot be empty.');
    } else {
        if(!preg_match('/^([0-9]+(\\.[0-9]{1,2})?)$/', $val)){
        $this->addError('weight','Weight must contain numbers in 0.00 format.');
        }
    }

    }

    private function addError($key, $val) {
    $this->errors[$key] = $val;
    }

}
