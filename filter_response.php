<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-24      Creation of the filter response file to create the table that will have
//                                            only the purchases happened on the filter date or later for one user.
//Camilo Restrepo(1931815)    2021-04-24      Adition of the conditional to delete a row in the table if button delete is triggered


   //Declaration of constants
   define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
   define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");
   
   
   #Loading PHP_Common_Functions.php to access all the functions.
   require_once FILE_PHP_FUNCTIONS;#use constants
   
   //Reading the cookie of current_search_date used in orther to keep the current search
   //even though the page is reloaded.
   $_SESSION['current_search_date'] = htmlspecialchars($_POST['filter_date']);
   
   //Check if the delete button of any row in the tables has been triggered
   if(isset($_POST['delete'])){
   
       //if any delete button has been triggered the $_POST['delete'] contains the purshase id
       //that needs to be deleted from the database.
       
       //we load the purchase object using the current using the purchaseID passed by $_POST['delete']
       $purchaseID = htmlspecialchars($_POST['delete']);       
       $purchaseToBeDelete = new Purchase();   
       $purchaseToBeDelete->load($purchaseID);
       
       //We use the method delete built in the object to delete it from the database
       $purchaseToBeDelete->delete();
       
       //We destroy $_POST['delete'] in order to avoid deleting the same purchase twice
       unset($_POST['delete']);
       
   }
   
   //call of the table creation which is going to be the response needed.
   createOrdersTable();
