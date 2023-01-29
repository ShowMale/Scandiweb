<?php

require_once 'private/ProductsValidator.php';
require_once 'private/ProductsController.php';

// Backend Validation

$errors = [];

if(isset($_POST['button-save'])) {

    $validation = new ProductsValidator($_POST);

    if ( $_POST['productType'] === 'dvd' ) {
        $errors = $validation->validateDvdForm();
    }
        
    if ( $_POST['productType'] === 'furniture' ) {
        $errors = $validation->validateFurnitureForm();
    }

    if ( $_POST['productType'] === 'book' ) {
        $errors = $validation->validateBookForm();
    }

    if ( empty($_POST['productType']) ) {
        $errors['productType'] = "Please, choose type of a product";
    }

    if ( empty($errors) ) {
        ProductsController::create($_POST);
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="css/add.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400&display=swap" rel="stylesheet">
        
    <script src="https://kit.fontawesome.com/09d622c225.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>

        <h4><a class="text-decoration-none text-dark" href="index.php">Product Add</a></h4>
        <hr>

    </header>

    <main>

        <p>All fields marked with * are required</p>

        <form action="<?=$_SERVER['PHP_SELF'];?>" id="product_form" name="product_form" method="POST">
        
            <label for="sku">SKU *</label>
            <br>

            <input autofocus name="sku" required type="text" id="sku" 
            minlength="2" maxlength="20" 
            size="20" autocomplete="off"
            value="<?=($_POST['sku']) ?? ''?>">
            <span class="check"></span>
            <br>

            <div class="error"><?=$errors['sku'] ?? ''?></div>
            
            <br>
            <label for="name">Name *</label>
            <br>

            <input name="name" required type="text" id="name" 
            minlength="2" 
            maxlength="20" 
            size="20" autocomplete="off"
            value="<?=($_POST['name']) ?? ''?>">
            <span class="check"></span>
            <br>

            <div class="error"><?=$errors['name'] ?? ''?></div>

            <br>
            <label for="price">Price ($) *</label>
            <br>

            <input name="price" required type="text" id="price"
            minlength="1" 
            maxlength="10" 
            autocomplete="off"
            value="<?=($_POST['price']) ?? ''?>">
            <span class="check"></span>
            <br>

            <div class="error"><?=$errors['price'] ?? ''?></div>
            <br>

            <label for="productType">Type of product *</label>
            <br>

            <div class="select">
                <select name="productType" required id="productType" onchange="addFunction()">
                    <option value="">- select a type -</option>
                    <option value="dvd">DVD</option>
                    <option value="furniture">Furniture</option>
                    <option value="book">Book</option>
                </select>
                <span class="focus"></span>
            </div>

            <!-- Backend validation error messages -->

            <div class="error"><?= $errors['productType'] ?? ''?></div>
            <div class="error"><?= $errors['size'] ?? ''?></div>
            <div class="error"><?= $errors['height'] ?? ''?></div>
            <div class="error"><?= $errors['width'] ?? ''?></div>
            <div class="error"><?= $errors['length'] ?? ''?></div>
            <div class="error"><?= $errors['weight'] ?? ''?></div>

            <!-- Generating content depending on products' type -->

            <div id="genContent"></div>

            <script>
                const dvd = `
                <br>
                <label for="size">Size (MB) *</label>
                <br>

                <input name="size" required 
                type="number" id="size" 
                min="1" max="1000000000" 
                autocomplete="off"
                value="<?=($_POST['size']) ?? ''?>">
                <span class="check"></span>
                <br>
                <span id="description">Please, provide size.</span>
                <br>`;

                const furniture = `
                <br>
                <label for="height">Height (cm) *</label>
                <br>

                <input name="height" required 
                type="number" id="height"
                min="1" max="100000" 
                autocomplete="off"
                value="<?=($_POST['height']) ?? ''?>">
                <span class="check"></span>
                <br><br>
                <label for="width">Width (cm) *</label>
                <br>

                <input name="width" required 
                type="number" id="width" 
                min="1" max="100000" 
                autocomplete="off"
                value="<?=($_POST['width']) ?? '' ?>">
                <span class="check"></span>
                <br><br>
                
                <label for="length">Length (cm) *</label>
                <br>

                <input name="length" required 
                type="number" id="length" 
                min="1" max="100000" 
                autocomplete="off"
                value="<?=($_POST['length']) ?? ''?>">
                <span class="check"></span>
                <br>
                <span id="description">Please, provide dimensions.</span>
                <br>`;

                const book = `
                <br>
                <label for="weight">Weight (kg) *</label>
                <br>

                <input name="weight" required
                type="text" id="weight" 
                minlength="1" maxlength="10" 
                autocomplete="off"
                value="<?=($_POST['weight']) ?? ''?>">
                <span class="check"></span>
                <br>
                <span id="description">Please, provide weight.</span>
                <br>`;


                // This function generates new inputs

                function addFunction() {
                    let x = document.getElementById("productType").value;
                    if (x === "dvd") {
                        $("#genContent").html(dvd);
                    }
                    else if (x === "furniture") {
                        $("#genContent").html(furniture);
                    }
                    else if (x === "book") {
                        $("#genContent").html(book);
                    }
                    // to delete the field
                    else {
                        $("#genContent").html('');
                    }
                }
                        
            </script>

        </form>

        <br>

        <input name="button-save" id="button-save" type="submit" value="Save" form="product_form" class="btn btn-primary">
        <input name="button-cancel" id="button-cancel" type="button" value="Cancel" class="btn btn-secondary" onclick="location.href='index.php'"/>

    </main>

    <footer>

        <hr>
        <div class="row mt-3 text-center">
            <h6>Scandiweb Test assignment</h6>
        </div>

    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="private/validation.js"></script>
</body>

</html>