<?php

require_once "collection.php";
require_once "product.php";

class products extends collection{
    
    function __construct()
    {
        global $connection;
        
        $SQLQuery = "CALL products_select_all();";
        
        $PDOStatement = $connection ->prepare($SQLQuery);
        $PDOStatement->execute();
        
        while($row = $PDOStatement->fetch())
        {
            $product = new product($row["productID"],$row["p_code"],$row["p_description"],
                                $row["p_price"],$row["p_cost"],$row["p_date_creation"]);           
            $this->add($row["productID"],$product);
        }
    }
}
