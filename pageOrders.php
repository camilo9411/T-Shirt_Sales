<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-02-23      Creation of a new file: pageOrders.php using functions to create the squema
//Camilo Restrepo(1931815)    2021-03-08      Creation of container main-orders and table-container and implementation of the 
//                                            function createOrdersTable().                                           
//Camilo Restrepo(1931815)    2021-03-10      Addition of <a> tag to reference the Cheet sheet used in class.

//Declaration of constants
define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");


#Loading PHP_Common_Functions.php to access all the functions.
require_once FILE_PHP_FUNCTIONS;#use constants

#calling fuction to create the top of the page.
 createPageTop(PAGE_ORDERS_TITLE);
 createPageNavBar();
 createCookieCommandColor();
 
 if(isset($_SESSION['customerID'])){   
?>


                <div class="main-orders">
                    <h1><i><b>Purchases</b></i></h1>
                                          
<?php 
createSearchForm();
?>
                    <div id="ordersTable" class="table-container" >
                    </div>
                    
                </div><!-- Close main-orders -->


<?php

}else{
    
    echo "you are not allowed to see this!";
}
#calling fuction to create the footer of the page.
createPageFooter();
#calling fuction to create the bottom of the page.
createPageBottom(); 
  
