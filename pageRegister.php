<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-23      Creation of a new file: pageRegister.php using functions to create the squema
//Camilo Restrepo(1931815)    2021-04-25      Addition of the conditional to restrict the content, for users already logged in


//Declaration of constants
define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");


#Loading PHP_Common_Functions.php to access all the functions.
require_once FILE_PHP_FUNCTIONS;#use constants

#calling fuction to create the top of the page.
 createPageTop(PAGE_REGISTER_TITLE);
 createPageNavBar();
 
 //Conditional that hide this page's content for users already logged in 
 //Only when an user is not logged in the content of this page must be shown.
  if(!isset($_SESSION['customerID'])){
?>
        <div class="main-register">
            
            <h1><i><b>Registration Form</b></i></h1>

        </div><!-- Close main-register -->
                    <div class="form-container">
<?php 
createRegistrationForm();
?>
                    </div><!-- Close form-container -->
<?php
  }else{
      //message for the user.
      echo "You already have an account";
  }
#calling fuction to create the footer of the page.
createPageFooter();
#calling fuction to create the bottom of the page.
createPageBottom(); 
  

