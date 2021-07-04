<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-02-23      Creation of a new file: pagebuying.php using functions to create the squema
//Camilo Restrepo(1931815)    2021-03-05      Rename of the file to pageBuying.php because it was not workin on linux.
//Camilo Restrepo(1931815)    2021-03-08      Creation of container main-buting and  form-container and implementation of the function 
//                                            createBuyingForm().
//Camilo Restrepo(1931815)    2021-03-10      Addition of <a> tag to reference the Cheet sheet used in class.

//Declaration of constants
define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");


#Loading PHP_Common_Functions.php to access all the functions.
require_once FILE_PHP_FUNCTIONS;#use constants

#calling fuction to create the top of the page.
 createPageTop(PAGE_BUYING_TITLE);
 createPageNavBar();
   
if(isset($_SESSION['customerID'])){
    
?>
                <div class="main-buying"> 
                    <h1><i><b>Sales Form</b></i></h1>
                    <div class="form-container">
<?php 
createBuyingForm(); 
?>
                    </div><!-- Close form-container -->
                </div><!-- Close main-buying -->
<?php
}else{
    
    echo "you are not allowed to see this!";
}
#calling fuction to create the footer of the page.
createPageFooter();
#calling fuction to create the bottom of the page.
createPageBottom();

