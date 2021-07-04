<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-22      Creation of the class customers and the constructor.

require_once "collection.php";
require_once "customer.php";

class customers extends collection{
    
    function __construct()
    {
        global $connection;
        
        $SQLQuery = "CALL customers_select_all();";
        
        $PDOStatement = $connection ->prepare($SQLQuery);
        $PDOStatement->execute();
        
        while($row = $PDOStatement->fetch())
        {
            $customer = new customer($row["customerID"],$row["c_firstname"],$row["c_lastname"],
                                $row["c_city"],$row["c_postalcode"],$row["c_username"],$row["c_userpassword"],
                                $row["c_address"],$row["c_province"]);           
            $this->add($row["customerID"],$customer);
        }
    }
    
   
}
