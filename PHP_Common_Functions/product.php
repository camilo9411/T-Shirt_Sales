<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-23      Creation of the class custumer.php
//Camilo Restrepo(1931815)    2021-04-25      Addition of setters and getters for privete fields.
//Camilo Restrepo(1931815)    2021-04-27      creation functions load, save and delete.
//Camilo Restrepo(1931815)    2021-04-28      Update of setters and getters.

//Class delcaration
class product {
    
    //private fields
    private $productID = "";
    private $p_code = "";
    private $p_description = "";
    private $p_price ="";
    private $p_cost = "";
    private $p_date_creation="";

    //constructor
    function __construct($productID="", $p_code="", $p_description = "", $p_price="", $p_cost = "", $p_date_creation="")
    {
        $this->productID = $productID;
        $this->setProductCode($p_code);
        $this->setProductDescription($p_description);
        $this->setProductPrice($p_price);
        $this->setProductCost($p_cost);
        $this->p_date_creation = $p_date_creation;
    }
    
    //Setters
    public function setProductCode($productCode){
        
        if($productCode == ""){
            
            return "This field cannot be empty. Please type a product code.";     
        }else{
            if(mb_strlen($productCode)>MAX_LENGTH_PRODUCTCODE){
                return "The product code cannot contain more than " 
                            . MAX_LENGTH_PRODUCTCODE . " characters";
            }else{
                if($productCode[0] != CONSTANT_LETTER_PRODUCTCODE &&  $productCode[0] != strtoupper(CONSTANT_LETTER_PRODUCTCODE)){
                   return "The product code must start with " . CONSTANT_LETTER_PRODUCTCODE .".";
                }else{
                    $this->p_code = $productCode;
                    return null;
                }
            }
        }
    }
    
    public function setProductDescription($description){
        
        if($description==""){
            
            return "This field cannot be empty.";
            
        }else{
            
            if(mb_strlen($description) > MAX_LENGTH_COMMENT){
                 return "The description cannot contain more than " 
                        . MAX_LENGTH_DESCRIPTION . " characters"; 
            }else{
                $this->p_description = $description;
                return null;
            }
        }

    }
    
    public function setProductPrice($price){
        
        if(!(is_numeric($price)) || $price == ""){
            
            if($price == ""){
                return "This field cannot be empty. Please enter a price.";
            }else{
                return "Incorrect input. Enter a decimal value(Ex. 699.99). ";
            } 
        }else{
            $price = round($price,2);
            if(floatval($price) < MIN_VALUE_PRICE || floatval($price) > MAX_VALUE_PRICE){
                
                return "The price must be between 0 and 9999.99 CAD";  
            }else{
                $this->p_price = $price;
                return null;
            }
        }
    }
    
    public function setProductCost($cost){
        
        if(!(is_numeric($cost)) || $cost == ""){
            
            if($cost == ""){
                return "This field cannot be empty. Please enter a price.";
            }else{
                return "Incorrect input. Enter a decimal value(Ex. 699.99). ";
            } 
        }else{
            $cost = round($cost,2);
            if(floatval($cost) < MIN_VALUE_PRICE || floatval($cost) > MAX_VALUE_PRICE){
                
                return "The price must be between 0 and 9999.99 CAD";  
            }else{
                $this->p_cost = $cost;
                return null;
            }
        }
    }
    
    //Getters
    public function getProductID()
    {
        return $this->productID;
    }
    
    public function getCode()
    {
        return $this->p_code;
    }
    
    public function getProductPrice(){
        return $this->p_price;
    }
    
    public function getProductDescription(){
        
        return $this->p_description;
    }
    
    public function getProductDateCreation(){
        
        return $this->p_date_creation;
    }
    
     //This function loads a product base on an existing productID
    public function load($productID){
        
        global $connection;
        
        $SQLQuery = "call products_select_one(:ProductID)";
        
        $PDOStatement = $connection->prepare($SQLQuery);
        $PDOStatement ->bindParam(":ProductID", $productID);
        $PDOStatement ->execute();
        
        if($row = $PDOStatement->fetch()){
            
            $this->productID = $row['productID'];
            $this->p_code = $row['p_code'];
            $this->p_description = $row['p_description'];
            $this->p_price = $row['p_price'];
            $this->p_cost = $row['p_cost'];
            $this->p_date_creation = $row['p_date_creation'];
            
            return true;
            
        }else
        {
            return false;
        }
        
    }
    
    //This function saves, updating a product or creatins a newone on the database.
    function save()
    {
        global $connection;
        
        if($this->customerID == "")
        {
            $SQLQuery = "call products_insert(:p_code, :p_description, :p_price, :p_cost)";
        
            $PDOStatement = $connection->prepare($SQLQuery);
            $PDOStatement ->bindParam(":p_code", $this->p_code);
            $PDOStatement ->bindParam(":p_description", $this->p_description);
            $PDOStatement ->bindParam(":p_price", $this->p_price);
            $PDOStatement ->bindParam(":p_cost", $this->p_cost);


            $PDOStatement ->execute();
            
        }else{
            
            $SQLQuery = "call products_update(:productID, :p_code, :p_description, :p_price, :p_cost)";
        
            $PDOStatement = $connection->prepare($SQLQuery);
            $PDOStatement ->bindParam(":productID", $this->productID);
            $PDOStatement ->bindParam(":p_code", $this->p_code);
            $PDOStatement ->bindParam(":p_description", $this->p_description);
            $PDOStatement ->bindParam(":p_price", $this->p_price);
            $PDOStatement ->bindParam(":p_cost", $this->p_cost);

            $PDOStatement ->execute();
        }
         
    }
    
    //Delete the row on the database for the corresponding primarykey.
    function delete(){
        
        global $connection;
        
        $SQLQuery = "call products_delete(:productID)";
        
        $PDOStatement = $connection->prepare($SQLQuery);
        $PDOStatement ->bindParam(":productID", $this->productID);
        $PDOStatement ->execute();

    }
    
}
