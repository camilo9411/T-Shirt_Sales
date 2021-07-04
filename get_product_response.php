<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-24      Creation of the get product response file to retrieve the product values of the
//                                            product selected on the combobox in the buy form.

   //header for json type.
   header("Content-Type: application/json; charset=UTF-8");
   //Declaration of constants
   define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
   define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");
   
   
   #Loading PHP_Common_Functions.php to access all the functions.
   require_once FILE_PHP_FUNCTIONS;#use constants
   
    //Confirms that a product has been selected on the combobox
    if(isset($_POST['getProduct'])){

        //gets the product id
        $productID = htmlspecialchars($_POST['getProduct']);
        //creates a new object product
        $currProduct = new product();
        //load the values of the product that has the product id
        $currProduct->load($productID);

        //declaration of an array
        $myArr = array();

        //Setting the needed properties
        $myArr['price'] = $currProduct->getProductPrice();
        $myArr['description'] = $currProduct->getProductDescription();

        //Encoding the properties in json and sending them to the javascript funtction
        $productJSON = json_encode($myArr);
        echo $productJSON;
    }

