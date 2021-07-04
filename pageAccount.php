<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-23      Creation of a new file: pageAccount.php using functions to create the squema


//Declaration of constants
define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");


#Loading PHP_Common_Functions.php to access all the functions.
require_once FILE_PHP_FUNCTIONS;#use constants

#calling fuction to create the top of the page.
 createPageTop(PAGE_ACCOUNT_TILE);
 createPageNavBar();

?>
                <div class="main-account"> 
                    <h1><i><b>Account Information</b></i></h1>
                    <div class="form-container">
<?php 
 createUpdateForm();
?>
                    </div><!-- Close form-container -->
                </div><!-- Close main-buying -->
<?php
#calling fuction to create the footer of the page.
createPageFooter();
#calling fuction to create the bottom of the page.
createPageBottom();


