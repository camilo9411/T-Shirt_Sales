<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-22      Creation of the class customers and the constructor.

require_once "collection.php";
require_once "purchase.php";

class purchases extends collection{
    
    function __construct()
    {
        global $connection;
        
        $SQLQuery = "CALL purchases_select_all();";
        
        $PDOStatement = $connection ->prepare($SQLQuery);
        $PDOStatement->execute();
        
        while($row = $PDOStatement->fetch())
        {
            $purchase = new purchase($row["purchaseID"],$row["productID"],$row["customerID"],
                                $row["p_quantity"],$row["p_price"],$row["p_comments"],$row["p_subtotal"],
                                $row["p_subtotal"],$row["p_taxes_amount"], $row["p_grand_total"]);           
            $this->add($row["purchaseID"],$purchase);
        }
    }
    
   
}