<?php
require_once('db_credentials.php');

class Dbc {

    public ?PDO $pdo=null;
    public static ?Dbc $dbInstance = null;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=" . dbhost . "; dbname=" . dbname, dbuser, dbpass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$dbInstance = $this;
    }

    public function getData() {
        $dbCommand = 'SELECT * FROM products';
        $statement = $this->pdo->prepare($dbCommand);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count > 0) {
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function createData($product) {

        $dbCommand = 'INSERT INTO products(name, sku, price, attribute, value, unit) VALUES(:name, :sku, :price, :attribute, :value, :unit)';
        $statement = $this->pdo->prepare($dbCommand);  
        $statement->bindValue(':name', $product->getNames());
        $statement->bindValue(':sku', $product->getSkus());
        $statement->bindValue(':price', $product->getPrices());
        $statement->bindValue(':attribute', $product->getAttributes());
        $statement->bindValue(':value', $product->getValues());
        $statement->bindValue(':unit', $product->getUnits());
        $statement->execute();
    }

    public function deleteData($checked) {
        $extract = sprintf("'%s'", implode("', '", $checked ) );
        $dbCommand = "DELETE FROM products WHERE sku IN ($extract)";
        $statement = $this->pdo->prepare($dbCommand);
        $statement->execute();
    }

    public function checkSKU($id) {
        $dbCommand = 'SELECT sku FROM products WHERE sku = ?;';
        $statement = $this->pdo->prepare($dbCommand);
        
        if(!$statement->execute([$id])) {
            $statement = null;
            exit();
        }
        $skuExists = false;
        if ($statement->rowCount() > 0) {
            $skuExists = true;
        }

        return $skuExists;
    }
}
