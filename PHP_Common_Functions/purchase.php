<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-23      Creation of the class purchase.php
//Camilo Restrepo(1931815)    2021-04-24      Addition of setters and getters for privete fields.
//Camilo Restrepo(1931815)    2021-04-25      creation functions load, save and delete.
//Camilo Restrepo(1931815)    2021-04-25      Update of setters and getters.

//Class delcaration
class purchase {
        
    //private fields
    private $purchaseID = "";
    private $productID = "";
    private $customerID = "";
    private $p_quantity = "";
    private $p_price ="";
    private $p_comments = "";
    private $p_subtotal = "";
    private $p_taxes_amount = "";
    private $p_grand_total ="";
    private $p_date_creation = "";
    

    //constructor
    function __construct($productID="", $customerID="", $p_quantity = "", $p_price="", $p_comments = "",
            $p_subtotal="",$p_taxes_amount="",$p_grand_total="")
    {
        $this->setProductID($productID);
        $this->setCustomerID($customerID);
        $this->setQuantity($p_quantity);
        $this->setPrice($p_price);
        $this->setComments($p_comments);
        $this->p_subtotal = $p_subtotal;
        $this->p_taxes_amount = $p_taxes_amount;
        $this->p_grand_total = $p_grand_total;
    
    }
    
    //Setters
    public function setCustomerID($customerID){
        
        if($customerID == "")
        { 
            return "This field cannot be empty.";
            
        }else{
            if(mb_strlen($customerID) > MAX_LENGTH_UUID){
                return "The firstname cannot contain more than " 
                            . MAX_LENGTH_UUID . " characters";
            }else {
                $this->customerID = $customerID;
                return null;
            }
            
        }
        
    }
    
    public function setProductID($productID){
        
        if($productID == "")
        { 
            return "This field cannot be empty";
            
        }else{
            if(mb_strlen($productID) > MAX_LENGTH_UUID){
                return "The firstname cannot contain more than " 
                            . MAX_LENGTH_UUID . " characters";
            }else {
                $this->productID = $productID;
                return null;
            }
            
        }
    }
    
    public function setQuantity($quantity){
        
        if(!(is_numeric($quantity)) || $quantity == ""){
            if($quantity == ""){
               return "This field cannot be empty. Please enter a quantity.";
            }else{
                return "Invalid input. Enter a number.";
            }
        }else{
            if((int)$quantity != (float)$quantity){

              return "Invalid input. Enter a integer.";

            }else{
                if($quantity < MIN_VALUE_QUANTITY || $quantity > MAX_VALUE_QUANTITY){

                    return "The quantity must be between 0 and 99.";
                }else{
                    $this->p_quantity = $quantity;
                    return null;
                }
            } 
        }
    }
    
    public function setPrice($price){
        
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

    public function setComments($comments){
        
        if(mb_strlen($comments) > MAX_LENGTH_COMMENT){
             return "The comments cannot contain more than " 
                    . MAX_LENGTH_COMMENT . " characters"; 
        }else{
            $this->p_comments = $comments;
            return null;
        }

    }
    
    
    //Getters
    public function getCustomerID(){
        
        $this->customerID;
    }
    
    public function getProductID(){
        
        $this->productID;
    }
    
    public function getQuantity(){
        
        $this->p_quantity;
    }
    
    public function getPrice(){
        
        $this->p_price;
    }
    
    public function getComments(){
        
        $this->p_comments;
    }
    
    public function getSubtotal(){
        
        $this->p_subtotal;
    }
    
    public function getTaxesAmount(){
        
        $this->p_taxes_amount;
    }
    
    public function getGrandTotal(){
        
        $this->p_grand_total;
    }
    

    
    //This function loads a purchases base on an existing purchaseID
    public function load($purchaseID){
        
        global $connection;
        
        $SQLQuery = "call purchases_select_one(:purchaseID)";
        
        $PDOStatement = $connection->prepare($SQLQuery);
        $PDOStatement ->bindParam(":purchaseID", $purchaseID);
        $PDOStatement ->execute();
        
        if($row = $PDOStatement->fetch()){
            
            $this->purchaseID = $row['purchaseID'];
            $this->productID = $row['productID'];
            $this->customerID = $row['customerID'];
            $this->p_quantity = $row['p_quantity'];
            $this->p_price = $row['p_price'];
            $this->p_comments= $row['p_comments'];
            $this->p_subtotal= $row['p_subtotal'];
            $this->p_taxes_amount= $row['p_taxes_amount'];
            $this->p_grand_total = $row['p_grand_total'];
            $this->p_date_creation= $row['p_date_creation'];
            
            return true;
            
        }else
        {
            return false;
        }
    }
    
    //Saves funtion does an update for already created purchases and Insert for new purchases.
    public function save(){
        
        global $connection;
        
        if($this->purchaseID == "")
        {
            $SQLQuery = "call purchases_insert(:productID, :customerID, :p_quantity, :p_price, :p_comments, :p_subtotal,"
                    . " :p_taxes_amount, :p_grand_total)";
            
            
            $PDOStatement = $connection->prepare($SQLQuery);
            $PDOStatement ->bindParam(":productID", $this->productID);
            $PDOStatement ->bindParam(":customerID", $this->customerID);
            $PDOStatement ->bindParam(":p_quantity", $this->p_quantity);
            $PDOStatement ->bindParam(":p_price", $this->p_price);
            $PDOStatement ->bindParam(":p_comments", $this->p_comments);
            $PDOStatement ->bindParam(":p_subtotal", $this->p_subtotal);
            $PDOStatement ->bindParam(":p_taxes_amount", $this->p_taxes_amount);       
            $PDOStatement ->bindParam(":p_grand_total", $this->p_grand_total);
   
            $PDOStatement ->execute();
            
        }else{
            
            $SQLQuery = "call purchases_update(:productID, :customerID, :p_quantity, :p_price, :p_comments, :p_subtotal,"
                        . " :p_taxes_amount, :p_grand_total, :p_date_modification)";
            
            
            $PDOStatement = $connection->prepare($SQLQuery);
            $PDOStatement ->bindParam(":productID", $this->productID);
            $PDOStatement ->bindParam(":customerID", $this->customerID);
            $PDOStatement ->bindParam(":p_quantity", $this->p_quantity);
            $PDOStatement ->bindParam(":p_price", $this->p_price);
            $PDOStatement ->bindParam(":p_comments", $this->p_comments);
            
            $subtotal = round((float) $this->p_quantity *(float) $this->p_price,2);
            $taxes = round($subtotal*TAXES_RATE,2);
            $total = round($subtotal + (float)$taxes,2);
            
            $PDOStatement ->bindParam(":p_subtotal", $subtotal);
            $PDOStatement ->bindParam(":p_taxes_amount", $taxes);       
            $PDOStatement ->bindParam(":p_grand_total", $total);
   
            $PDOStatement ->execute();
        }
        
    }
    
    //Delete the row on the database for the corresponding primarykey.
    public function delete(){
        
        global $connection;
        
        $SQLQuery = "call purchases_delete(:purchaseID)";         
            
        $PDOStatement = $connection->prepare($SQLQuery);

        $PDOStatement->bindParam(":purchaseID", $this->purchaseID);

        $PDOStatement ->execute();
        
    }
    
    
    

}
