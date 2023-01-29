<?php
require_once 'dbc.php';
require_once 'ProductsController.php';
require_once 'model/product.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {

    if ( isset($_POST['delete']) && isset($_POST['checkbox']) ) {
        $checked = $_POST['checkbox'];
        ProductsController::delete($checked);
    }
    
    header('Location: ../index.php');

}
