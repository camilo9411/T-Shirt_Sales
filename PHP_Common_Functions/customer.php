<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-22      Creation of the class custumer.php and the constructor.
//Camilo Restrepo(1931815)    2021-04-23      Creation of the class methods load, save and delete.


class customer {

    private $customerID = "";
    private $c_firstname = "";
    private $c_lastname = "";
    private $c_address ="";
    private $c_city = "";
    private $c_province = "";
    private $c_postalcode = "";
    private $c_username = "";
    private $c_userpassword = "";
    private $c_date_creation = "";
    private $c_date_modification="";
    
    
    function __construct($c_firstname="", $c_lastname="", $c_address="",$c_city="",$c_province="",
            $c_postalcode="",$c_username="",$c_userpassword="")
    {
        $this->setFirstname($c_firstname);
        $this->setLastname($c_lastname);
        $this->setAddress($c_address);
        $this->setCity($c_city);
        $this->setProvince($c_province);
        $this->setPostalCode($c_postalcode);
        $this->setUsername($c_username);
        $this->setUserPassword($c_userpassword);

    }


    //Getters
    public function getFirstname()
    {
        return $this->c_firstname;
    }
    
    public function getLastname()
    {
        return $this->c_lastname;
    }
    
    public function getAddress()
    {
        return $this->c_address;
    }
    
    public function getCity()
    {
        return $this->c_city;
    }
    
    public function getProvince()
    {
        return $this->c_province;
    }
    
    public function getPostalCode()
    {
        return $this->c_postalcode;
    }
    
    public function getUsername()
    {
        return $this->c_username;
    }
    
    public function getUserPassword()
    {
        return $this->c_userpassword;
    }
    
    public function getDateCreation()
    {
        return $this->c_date_creation;
    }
    
    
    public function getDateModification()
    {
        return $this->c_date_modification;
    }
    
    //Setters
    public function setFirstname($c_fname)
    {
        if($c_fname == "")
        { 
            return "This field cannot be empty. Please enter name.";
            
        }else{
            if(mb_strlen($c_fname) > MAX_LENGTH_FIRSTNAME){
                return "The firstname cannot contain more than " 
                            . MAX_LENGTH_FIRSTNAME . " characters";
            }else {
                $this->c_firstname = $c_fname;
                return null;
            }
            
        }
    }
    
    public function setLastname($c_lname)
    {
        if($c_lname == "")
        { 
            return "This field cannot be empty. Please enter lastname.";
            
        }else{
            if(mb_strlen($c_lname)>MAX_LENGTH_LASTNAME){
                return "The lastname cannot contain more than " 
                            . MAX_LENGTH_LASTNAME . " characters";
            }else{
                $this->c_lastname = $c_lname;
                return null;
            }
        }
    }
    
    public function setAddress($c_address)
    {

        if($c_address == ""){
            
            return "This field cannot be empty. Please enter address.";

        }else{
            
        if(mb_strlen($c_address)>MAX_LENGTH_ADDRESS){
                return "The address cannot contain more than " 
                            . MAX_LENGTH_ADDRESS . " characters";
            }else{
                $this->c_address = $c_address;
                return null;
            }
        
        }
    }

    
    public function setCity($c_city)
    {
        if($c_city == ""){ 
            return "This field cannot be empty. Please enter city.";
            
        }else{
            if(mb_strlen($c_city)>MAX_LENGTH_CITY){
                return "The city cannot contain more than " 
                            . MAX_LENGTH_CITY . " characters";
            }else{
                $this->c_city = $c_city;
                return null;
            }
        }
    }
    
    public function setProvince($c_province)
    {
        if($c_province == ""){
            
            return "This field cannot be empty. Please enter province.";

        }else{
            
            if(mb_strlen($c_province)>MAX_LENGTH_PROVINCE){
                return "The province cannot contain more than " 
                            . MAX_LENGTH_PROVINCE . " characters";
            }else{
                $this->c_province = $c_province;
                return null;
            }
        }


        
    }
    
    public function setPostalCode($c_postalcode)
    {
        
        if($c_postalcode == ""){
            
            return "This field cannot be empty. Please enter postalcode.";

        }else{
            
            if(mb_strlen($c_postalcode)>MAX_LENGTH_POSTAL_CODE){
                return "The postal code cannot contain more than " 
                        . MAX_LENGTH_POSTAL_CODE . " characters";
            }else{
                $this->c_postalcode = $c_postalcode;
                return null;
            }
        }        

    }
    
    public function setUsername($c_username)
    {
        if($c_username == ""){ 
            return "This field cannot be empty. Please enter username.";
            
        }else{
            if(mb_strlen($c_username)>MAX_LENGTH_USERNAME){
                return "The user name cannot contain more than " 
                            . MAX_LENGTH_USERNAME . " characters";
            }else{
                $this->c_username = $c_username;
                return null;
            }
        }
    }
    
    public function setUserPassword($c_userpassword)
    {
        if($c_userpassword == ""){ 
            return "This field cannot be empty. Please enter password.";
            
        }else{
            if(mb_strlen($c_userpassword)>MAX_LENGTH_USERPASSWORD){
                return "The user password cannot contain more than " 
                            . MAX_LENGTH_USERPASSWORD . " characters";
            }else{
                $password_hash = password_hash($c_userpassword,PASSWORD_DEFAULT); 
                $this->c_userpassword = $password_hash;
                return null;
            }
        }
    }
    
    public function setDateModification($date)
    {
        $this->c_date_modification = $date;
    }
    

    function load($customerID){
        
        global $connection;
        
        $SQLQuery = "call customers_select_one(:customerID)";
        
        $PDOStatement = $connection->prepare($SQLQuery);
        $PDOStatement ->bindParam(":customerID", $customerID);
        $PDOStatement ->execute();
        
        if($row = $PDOStatement->fetch()){
            
            $this->customerID = $row['customerID'];
            $this->c_firstname = $row['c_firstname'];
            $this->c_lastname = $row['c_lastname'];
            $this->c_address = $row['c_address'];
            $this->c_city = $row['c_city'];
            $this->c_province = $row['c_province'];
            $this->c_postalcode = $row['c_postalcode'];
            $this->c_username = $row['c_username'];
            $this->c_userpassword = $row['c_userpassword'];
            $this->c_date_creation = $row['c_date_creation'];
            $this->c_date_modification = $row['c_date_modification'];
            
            return true;
            
        }else
        {
            return false;
        }
    }
    
    //Saves funtion does an update for already created users and Insert for new users.
    function save()
    {
        global $connection;
        
        if($this->customerID == "")
        {
            $SQLQuery = "call customers_insert(:c_firstname, :c_lastname, :c_address, :c_city, :c_province, :c_postalcode, "
                    . ":c_username, :c_userpassword)";
        
            $PDOStatement = $connection->prepare($SQLQuery);
            $PDOStatement ->bindParam(":c_firstname", $this->c_firstname);
            $PDOStatement ->bindParam(":c_lastname", $this->c_lastname);
            $PDOStatement ->bindParam(":c_address", $this->c_address);
            $PDOStatement ->bindParam(":c_city", $this->c_city);
            $PDOStatement ->bindParam(":c_province", $this->c_province);
            $PDOStatement ->bindParam(":c_postalcode", $this->c_postalcode);
            $PDOStatement ->bindParam(":c_username", $this->c_username);       
            $PDOStatement ->bindParam(":c_userpassword", $this->c_userpassword);


            $PDOStatement ->execute();
            
        }else{
            
            $SQLQuery = "call customers_update(:customerID, :c_firstname, :c_lastname, :c_address,:c_city, :c_province, :c_postalcode,"
                    . ":c_username, :c_userpassword)";
        
            $PDOStatement = $connection->prepare($SQLQuery);
            $PDOStatement ->bindParam(":customerID", $this->customerID);
            $PDOStatement ->bindParam(":c_firstname", $this->c_firstname);
            $PDOStatement ->bindParam(":c_lastname", $this->c_lastname);
            $PDOStatement ->bindParam(":c_address", $this->c_address);
            $PDOStatement ->bindParam(":c_city", $this->c_city);
            $PDOStatement ->bindParam(":c_province", $this->c_province);
            $PDOStatement ->bindParam(":c_postalcode", $this->c_postalcode);
            $PDOStatement ->bindParam(":c_username", $this->c_username);        
            $PDOStatement ->bindParam(":c_userpassword", $this->c_userpassword);

            $PDOStatement ->execute();
        }
         
    }
    
    //Delete the row on the database for the corresponding primarykey.
    function delete(){
        
        global $connection;
        
        $SQLQuery = "call customers_delete(:customerID)";
        
        $PDOStatement = $connection->prepare($SQLQuery);
        $PDOStatement ->bindParam(":customerID", $this->customerID);
        $PDOStatement ->execute();

    }
    
    
}
