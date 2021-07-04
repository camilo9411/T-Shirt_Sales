<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-02-23      Creation of a new file: index.php using functions to create the squema
//Camilo Restrepo(1931815)    2021-03-01      Addition of class .main-index and changed the creations to the adds for
//                                            just the HOME page.
//Camilo Restrepo(1931815)    2021-03-05      Addition the of the logo, and description paragraph in the conteiner main-index. 
//Camilo Restrepo(1931815)    2021-04-26      Addition the of the cheetcheat button.                                             

   //Declaration of constants
   define("FOLDER_PHP_FUNCTIONS","PHP_Common_Functions/");
   define("FILE_PHP_FUNCTIONS",FOLDER_PHP_FUNCTIONS."PHPfunctions.php");
   
   
   #Loading PHP_Common_Functions.php to access all the functions.
   require_once FILE_PHP_FUNCTIONS;#use constants

   #calling fuction to create the top of the page.
    createPageTop(PAGE_HOME_TITLE);
    createPageNavBar();
    
?>
                    <div class="main-index"> 
                        <img  src="<?php echo FILE_IMAGES_NAVBAR_LOGO ?>" alt="logo"/>
                        <br/><br/>
                        <p>
                            This is a T-shirt store design for programmers! All the design are inspired for programmers. 
                            Thousand of funny designs and what its better... Incredible low prices all year long!
                            What are you waiting to get yours?
                        </p>
                        <a target="_blank" class="button" href="<?php echo FILE_DATA_CHEETSHEAT;?>">Cheat Sheet</a>
                    </div><!-- Close of main-index -->
<?php createSideBar(); ?>
<?php
    #calling fuction to create the footer of the page.
    createPageFooter();
    #calling fuction to create the bottom of the page.
    createPageBottom();

