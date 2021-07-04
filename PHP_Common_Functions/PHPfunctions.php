<?php
//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-02-23      Creation of new file: PHPfunctions.php
//                                            Creation of functions: createPageTop, createPageNavBar, CreatePageFooter, CreatePageBottom
//                                            Creation de constants: PAGE_HOME_TITLE, PAGE_BUYING_TITLE, FOLDER_IMAGES, FILE_IMAGES_LOGO
//                                                                   FILE_INDEX, FILE_PAGE_ORDERS, FILE_PAGE_ORDERS, FILE_PAGE_BUYING
//Camilo Restrepo(1931815)    2021-02-26      Creation of constants: FOLDER_CSS, FILE_CSS_STYLE; Modification of functions: createPageTop
//                                                                   (Addition of div with class container to wrap all the content).
//                                                                   createPageNavBar(addition of classes: header, header-menu, menu-button)
//                                                                   creation of the function: createpageSideBar()
//Camilo Restrepo(1931815)    2021-03-01      Addition the logos tho the header and tab website(editing createPageTop() and  createPageNavBar().
//                                            Creation and implementation of the function selectCurrentPage() to be used in header-menu. Creation
//                                            and implementation of function displayAdvertisment() to display random advertismen on the HOME page.
//                                            Creation of constants:FILE_IMAGES_NAVBAR_LOGO.
//                                            Aditions for css classes to the html in order to style the website.
//Camilo Restrepo(1931815)    2021-03-05      Adition of headers on the function createPageTop() function.
//Camilo Restrepo(1931815)    2021-03-06      Creation of the function createBuyingForm() where I configured the output of the form in the browser     
//                                            creating the variables needed for doing the data verification on the user's input.
//Camilo Restrepo(1931815)    2021-03-07      Finished the user's data entry verification when the user submits the form on the function createBuyingForm()
//                                            adding featur of saving in a txt file each sale as a json in each line of the file(purchases.txt)
//                                            Creation of function to read de txt file purchases.txt (readData()) using json_decode to retrive the object from
//                                            the json string and save all purchases in a array making possible to reach the data form any page.
//Camilo Restrepo(1931815)    2021-03-08      Creating of the function createOrdersTable() to create a table with the data already read with the function readData() 
//                                            in the file purchases.txt. Creation of the function for commands through the url readUrlPrintCommand() and 
//                                            readUrlColorCommand().
//Camilo Restrepo(1931815)    2021-03-09      Creation of the function getCurrentTime() to retrive the proper time for writing in the log_erros.txt, Set of the
//                                            php functions set_error_handler("manageError") set_exception_handler("manageException") defininig the functions 
//                                            manageError() and manageException().
//Camilo Restrepo(1931815)    2021-03-12      Modification error handling deleting  getCurrentTime() because it was not needed.                                      
//          
//Camilo Restrepo(1931815)    2021-04-23      Implementantion of the login form to log users. Creation of functions createLoginForm, createLogoutForm, LoginValidation and logout 
//Camilo Restrepo(1931815)    2021-04-24      Implementation of the forms for register and update an user. Creation of function creationUpdateForm and creationRegistrationForm.
//Camilo Restrepo(1931815)    2021-04-25      Constants update for new requirements. Creation of constants for JavaScript files location.
//Camilo Restrepo(1931815)    2021-04-25      Addition of constant for the advertisment images and suggested on previous feedback.
//Camilo Restrepo(1931815)    2021-05-01      Additions of new constants and update of functions implemented on the forms and the combobox.
//Camilo Restrepo(1931815)    2021-05-01      Modification of the function to resive the command=color trough the url.

//Declaration of constants
//Pages titles:
define("PAGE_HOME_TITLE","HOME");
define("PAGE_BUYING_TITLE","BUYING");
define("PAGE_ORDERS_TITLE","ORDERS");
define("PAGE_REGISTER_TITLE","REGISTER");
define("PAGE_ACCOUNT_TILE","ACCOUNT");
//Folders and files:
define("FOLDER_IMAGES","Images/");
define("FILE_IMAGES_LOGO",FOLDER_IMAGES . "logo.ico");
define("FILE_IMAGES_NAVBAR_LOGO",FOLDER_IMAGES . "img_logo_navbar.png");
define("FOLDER_CSS","CSS/");
define("FILE_CSS_STYLE",FOLDER_CSS . "style.css");
define("FILE_INDEX","index.php");
define("FOLDER_DATA","Data/");
define("FILE_DATA_SALES",FOLDER_DATA . "purchases.txt");
define("FILE_DATA_CHEETSHEAT",FOLDER_DATA."CheatSheet.txt");
define("FOLDER_ERRORS","Errors/");
define("FILE_ERRORS_LOGFILE",FOLDER_ERRORS . "log_errors.txt");
define("FILE_PAGE_ORDERS", "pageOrders.php");
define("FILE_PAGE_BUYING", "pageBuying.php");
define("FILE_PAGE_REGISTER", "pageRegister.php");
define("FILE_PAGE_ACCOUNT", "pageAccount.php");
define("FOLDER_JS","JavaScript/");
define("FILE_JS_SCRIPT", FOLDER_JS . "JS_functions.js");
        
//Constants for validation:
define("MAX_LENGTH_PRODUCTCODE",12);
define("MAX_LENGTH_FIRSTNAME",20);
define("MAX_LENGTH_LASTNAME",20);
define("MAX_LENGTH_ADDRESS",25);
define("MAX_LENGTH_CITY",25);
define("MAX_LENGTH_PROVINCE",25);
define("MAX_LENGTH_POSTAL_CODE",7);
define("MAX_LENGTH_USERNAME",12);
define("MAX_LENGTH_USERPASSWORD",255);
define("MAX_LENGTH_COMMENT",200);
define("MIN_VALUE_PRICE",0);
define("MAX_VALUE_PRICE",10000);
define("MAX_LENGTH_UUID",36);
define("MIN_VALUE_QUANTITY",0);
define("MAX_VALUE_QUANTITY",999);
define("TAXES_RATE",15.20/100);
define("ROUND_DECIMAL_NUMBERS",2);
define("SUBTOTAL_LOWEST_LIMIT",100.00);
define("SUBTOTAL_MIDDLE_LIMIT",999.99);
define("SUBTOTAL_HIGHEST_LIMIT",1000.00);
define("CONSTANT_LETTER_PRODUCTCODE","p");
define("MAX_LENGTH_DESCRIPTION",100);
//Classes Names:
define("CLASS_CSS_CONTAINER","conteiner");
//Advertisment names
define("ADVERTISMENT_PICTURE_1",FOLDER_IMAGES . "add2.png");
define("ADVERTISMENT_PICTURE_2",FOLDER_IMAGES . "add3.png");
define("ADVERTISMENT_PICTURE_3",FOLDER_IMAGES . "add4.png");
define("ADVERTISMENT_PICTURE_4",FOLDER_IMAGES . "add5.png");
define("ADVERTISMENT_PICTURE_SPECIAL",FOLDER_IMAGES . "add1.png");

//Database Information
define("DATABASE_NAME", "database-1931815");
define("DATABASE_HOST", "localhost");
define("DATABASE_USERNAME", "user-1931815");
define("DATABASE_PASSWORD", "1931815");



//Global variable to turn on(true) and turn of(false) the display of erros on the screen
//if is false, in the case of and error a generic error message will show in the screen
//if is true, in the case of an error the technicl error message will show on screen.
$debug = false;
//setErrorAndExceptionHandeler();//Set of error and exception handeler.

//call of classes
require_once 'customers.php';
require_once 'purchases.php';
require_once 'products.php';


//Forcing the user to use HTTPS certificate and key are in the folder Certificate.
if(!(isset($_SERVER["HTTPS"])) || $_SERVER["HTTPS"] != "on"){
    
    header('Location: https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit(); 
}

$_SESSION['software'] = "Windows";

session_start();

$connection = new PDO( 'mysql:host=' . DATABASE_HOST .'; dbname=' . DATABASE_NAME , DATABASE_USERNAME, DATABASE_PASSWORD);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Loading my Collection objects
$myCustomersList = new customers();
$myPurchasesList = new purchases();
$myProductsList = new products();


//This function create the the top of all websites in the project, it is the first html
//to be generated on each page. It has one string argument that is the title page if it is not set
//the default title is  "Not-Defined".
function createPageTop($title = "Not-Defined")
{   
    //php headers
    //Cache headers
    header('Expires: Thu, 01 Dec 1994 14:00:00 GMT');
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    //UTF-8 header
    header('Content-Type: text/html; charset=utf-8');
    
    ?>
<!DOCTYPE html><!-- Start of the page -->
<html lang="en">
    <head>
        <meta charset="UTF-8"/><!-- Meta UTF-8 -->
        <title><?php echo $title; ?></title><!-- Set title of the page as the argument of the function -->
        <link rel="shortcut icon" href="<?php echo FILE_IMAGES_LOGO; ?>" type="image/x-icon"/> <!--Sets tap icon of the page tab -->
        <link rel="stylesheet" href="<?php echo FILE_CSS_STYLE; ?>" type="text/css"/><!-- CSS Style sheet set-->
        <script language="javascript" type="text/javascript" src="<?php echo FILE_JS_SCRIPT; ?>"></script><!--JS for the login -->
        <?php 
            if(isset($_SESSION['Registration'])){
                unset($_SESSION['Registration']);
                ?>
                <script>
                    alert('Registration is Completed!');
                </script>
                <?php
            }
        ?>
    </head>
    <body class="<?php echo readUrlPrintCommand(); ?>"><!-- It sets the body class according to the function -->
        <div class="<?php echo CLASS_CSS_CONTAINER; ?>"><!-- class Container of the page -->
<?php
}

//This function creates the header that includes the logo and the navigation bar of the page
function createPageNavBar()
{
?>
            <header class="header">
                <div class="logo">
                    <a  href="<?php echo FILE_INDEX; ?>"><img  src="<?php echo FILE_IMAGES_NAVBAR_LOGO; ?>" alt="makeShirt()-Logo"/></a>   
                </div>
                <!-- The function selectCurrentpage() gives a class current to the clicked page -->
                <div class="header-menu">
                    <a class="menu-button <?php echo selectCurrentPage(FILE_INDEX);?>" href="<?php echo FILE_INDEX; ?>">
                        <?php echo PAGE_HOME_TITLE;?></a>  
                    <a class="menu-button <?php echo selectCurrentPage(FILE_PAGE_BUYING);?>" 
                        href="<?php echo FILE_PAGE_BUYING; ?>"><?php echo PAGE_BUYING_TITLE; ?></a>
                    <a class="menu-button <?php echo selectCurrentPage(FILE_PAGE_ORDERS);?>" 
                        href="<?php echo FILE_PAGE_ORDERS?>"><?php echo PAGE_ORDERS_TITLE; ?></a>
                </div>
                <div class="loginForm">
                    <?php
                  
                        if(!isset($_SESSION['customerID'])){
    
                            createLoginForm();
                        }else{
                            
                                createLogoutForm();
                            
                        }
                    ?>
    
                </div>  
            </header>
            
<?php
            openMainContainer();
}

function openMainContainer(){
    ?>
    <div class="main"><!-- Opens the div that contains the main content of each page(the different content between pages) -->
    <?php
}

//This fucntion creates the footer of the pages
function createPageFooter()
{
?>
            </div><!-- Close div tag with class main  -->
            <footer class="footer"> 
                <div>
                    <!-- date('Y') is a php function that returns the current year -->
                    <p><i><b>Copyright &copy; Camilo Restrepo (1931815) <?php echo date("Y"); ?></b></i></p>
                </div>
            </footer>
<?php
}

//This function create the bottom of the page
function createPageBottom()
{
?>
        </div><!-- Close div tag with class Container  -->
    </body><!-- Close body tag -->
</html><!-- Close html tag -->
<?php
}

//This function create a sidebar where the adds will be storage
function createSideBar(){
?>
                    <div class="adds">
<?php 
    displayAdvertisment(); 
?>
                        <p>Get this for an incredible price...Click it!</p>
                    </div><!-- Close adds div -->
<?php
}

//This function has an array of images that are advertisment and it will randomly 
//pick one of them and display it. There is one image (advertisment)that is special 
//and will be display bigger and with a red border.
function displayAdvertisment(){

    $myAdds = array(ADVERTISMENT_PICTURE_SPECIAL,ADVERTISMENT_PICTURE_1,ADVERTISMENT_PICTURE_2,
                        ADVERTISMENT_PICTURE_3,ADVERTISMENT_PICTURE_4);//Array with adds.
    shuffle($myAdds); 

    if($myAdds[0]== ADVERTISMENT_PICTURE_SPECIAL)//selection of the special add.
    {
        
?>
                        <a target="_blank" href="https://ubuntu.com/">
                            <img class="superPromo" src="<?php echo $myAdds[0] ?> " alt="This is an add"/>
                        </a>     
<?php

    }else
    {
        
?>
                        <a target="_blank" href="https://ubuntu.com/" >
                            <img src="<?php echo $myAdds[0] ?> " alt="This is an add"/> 
                        </a>     
<?php

    }
}

//This function return the current class depending on what page is open.
function selectCurrentPage($pageName){

    $currrentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

    if($currrentPage == $pageName){
        echo "current";
    }else{
        echo "";
    }
}

//This function will create the form for the submition of the products on the pageBuying.php
//this function also validates the values inside the form according with the requierments
function createBuyingForm(){
    
    //global objects
    global $connection;
    global $myPurchasesList;
    $currentProductPrice = "";
    $currentProductDescription = "";
    
    //Error messages variables for validation
    $erroProductCode = "";
    $errorComments = "";
    $errorQuantity = "";
    
    //isset will asure that the $_POST['buy'] method has been called by clicking the
    //submiting button of the form.
    if(isset($_POST["buy"])){
        
      
        //Reading the variables sent buy the form through the $POST method.
        $productID = htmlspecialchars($_POST['productID']);
        $PurchaseComments = htmlspecialchars($_POST['comments']);
        $PurchaseQuantity = htmlspecialchars($_POST['quantity']);

        $NewPurchase = new purchase();
            

        //Validation comments
        $errorComments = $NewPurchase->setComments($PurchaseComments);
        
        //validation quantity
        $errorQuantity = $NewPurchase->setQuantity($PurchaseQuantity);

        unset($NewPurchase);
        
        $currentProduct = new product();
        if(!$currentProduct->load($productID)){
            
            //Validation product code
            $erroProductCode =  $currentProduct->setProductCode("");
        }
        
        
        //This make sure that any error has been made in the submition of the form, it means the submition was
        //successfully done.
        if($productID != "" && $errorComments == null && $errorQuantity == null && isset($_POST['buy'])){
            
            //load product selected
            $currentProductPrice =  $currentProduct->getProductPrice();
            $currentProductDescription = $currentProduct->getProductDescription();


            //Calculating Subtotal, taxes and grand total
            $price = round((float)$currentProduct->getProductPrice(),2);
            $subtotal = round((float)$PurchaseQuantity*(float)$price,2);
            $taxes = round($subtotal*TAXES_RATE,2);
            $total = round($subtotal + (float)$taxes,2);

            $NewPurchase = new purchase($productID, $_SESSION['customerID'], $PurchaseQuantity, $price, $PurchaseComments, 
                                        $subtotal, $taxes, $total);

            $NewPurchase->save();

?>
                        <div class="success" ><!<!-- This div it is shown just in the case of a successful order. -->
                            <h2> Your transaction has been submitted!</h2>
                            <p><?php echo "Confirmation #" . random_int(10000, 99999).", Subtotal = $$subtotal, Taxes = $$taxes, Total = $$total" ?></p>
                        </div>     
<?php
            //if the submition was succesful the fields on the form get cleared to
            $productID = "";
            $PurchaseComments =  "";
            $PurchaseQuantity =  "";


        }

        
    }else{
        
        //if the submition button has not been pressed you want to be sure the fields are empty.
        $productID = "";    
        $PurchaseComments =  "";
        $PurchaseQuantity =  "";   
    }
    ?>
                        <form id="SalesForm" method="POST" action="pageBuying.php">
                            <div class="form-row">
                                <div class="form-column-label">
                                <label class="required">Product Code:</label> 
                                </div>
                                <div class="form-column-input">
                                    <?php createProductComboBox($productID); ?>
                                   <span><?php echo $erroProductCode; ?></span> 
                                </div>                   
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label>Description:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" id="currProductDescription" readonly/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label>Price:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" id="currProductPrice" readonly/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Quantity:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="quantity" value="<?php echo $PurchaseQuantity ;?>"/>
                                   <span><?php echo $errorQuantity; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label>Comments:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="comments" value="<?php echo $PurchaseComments ;?>"/>
                                    <span><?php echo $errorComments; ?></span>
                                </div>
                            </div>
                            <input class="button" type="submit" name="buy" value="Buy"/>   
                        </form>
<?php
}

//This function will create a function to call all the product codes of the products in the
//database.
function createProductComboBox($selected){
    
    global $myProductsList;
    ?>
        <select name="productID" onchange="getSelectedProduct(this.value);">
            <option value=""></option>
    <?php    
    foreach ($myProductsList->items as $product){
        
        if($selected != $product->getProductID()){
            ?>
                <option value="<?php echo $product->getProductID(); ?>"><?php echo $product->getCode(); ?></option>
            <?php
        }else{
            ?>
                <option selected="selected" value="<?php echo $product->getProductID(); ?>"><?php echo $product->getCode(); ?></option>
           <?php
        }
    }
    ?>
        </select>
    <?php
}

//This function will read the purchases text file and it will return and array of
//arrays with all the data of the purchases.
function readData(){
    
    if(file_exists(FILE_DATA_SALES)){

        $fileHandle = fopen(FILE_DATA_SALES, "r") or die("cannot open the file");
        $data = (array)null;
        $counter = 0;
        while(!feof($fileHandle))
        {
            $data[$counter] = (array)json_decode(fgets($fileHandle));
            $counter++;
        }

        fclose($fileHandle);
        
        return $data;

    }
}

//this function fill create the seach form that uses AJAX.
function createSearchForm(){

    
?>  
                    <p>Show purchases made this date or later:</p>
                      
<?php
    
    //checking if the data has been generated to save it as value if page gets reloaded
    //the user will not lose their search.
    if(isset($_SESSION['current_search_date'])){
        
        $date = $_SESSION['current_search_date'];
        ?> 
                <input type="date" id="filter_date" value="<?php echo $date; ?>"/>    
                
                
        <?php
        
    }else{
        
        $date =  date("Y-m-d");
        ?> 
                <input type="date" id="filter_date" value="<?php echo $date; ?>"/>    
                
        <?php
        
    }
    
    ?>  
                    <button class="button" onclick="filter_by_date();">Search</button>
    <?php
    
}

//This function will create the table with the data of the text file purchases 
//using the function readData to get the data.
function createOrdersTable(){
    
    global $connection;
    
?>
                        <table>
                            <tr>
                                <th>Delete</th>
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>First Name</th>
                                <th>Lastname</th>
                                <th>City</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Taxes</th>
                                <th>Total</th>
                                <th>Comments</th>
                                <th>Date of purchase</th>
                            </tr>
<?php
            $mysqlQuery = 'CALL filter_by_date(:custumerID, :filter_date);';
            
            #prepared SQL and bind parameters
            $PDOStatement = $connection ->prepare($mysqlQuery);
            
            $userID = htmlspecialchars($_SESSION["customerID"]);
            $filterdatestr = htmlspecialchars($_POST['filter_date']);
            $filter_date = date($filterdatestr);

            $PDOStatement->bindParam(':custumerID', $userID);
            $PDOStatement->bindParam(':filter_date', $filter_date);
            $PDOStatement->execute();
            
            while($row = $PDOStatement->fetch())
            {
                
        
?>
                            <tr>
                                <td><button id="<?php echo $row["purchaseID"];?>" onclick="delete_row(this.id);">Delete</button></td>
                                <td><?php echo $row["p_code"];?></td>
                                <td><?php echo $row["p_description"];?></td>
                                <td><?php echo $row["c_firstname"];?></td>
                                <td><?php echo $row["c_lastname"];?></td>
                                <td><?php echo $row["c_city"];?></td>
                                <td><?php echo $row["p_price"];?></td>
                                <td><?php echo $row["p_quantity"];?></td>
                                <td class="<?php echo readUrlColorCommand($row["p_subtotal"]); ?>"><?php echo "$".$row["p_subtotal"]; ?></td>
                                <td><?php echo "$".$row["p_taxes_amount"];?></td>   
                                <td><?php echo "$".$row["p_grand_total"];?></td>
                                <td><?php echo $row["p_comments"];?></td>
                                <td><?php echo $row["p_date_creation"];?></td>
                            </tr>
<?php

                        }
            //close of the connection and PDO object
            $PDOStatement->closeCursor();
            $PDOStatement = null;   
            $connection = null;
            
?>
                        </table>
<?php
}

//this function create a cookie when the command=color is sent thorugh the
//url
function createCookieCommandColor(){
    
    if(isset($_GET['command'])){
        
        $command = $_GET['command'];
        if($command=="color"){
            
            $_SESSION['color'] = "color";
        }
        
    }else{
        
        unset($_SESSION['color']);
    }
}
//This function will read a variable through the url. The variable name is command.
//The function expects the value color. it will return a class depending of the $value
//the class is associated to a color.
function readUrlColorCommand($value){
    
    if(isset($_SESSION['color'])){
        
        if((float)$value < SUBTOTAL_LOWEST_LIMIT){
            return "red";
        }else if((float)$value >= SUBTOTAL_LOWEST_LIMIT && (float)$value <= SUBTOTAL_MIDDLE_LIMIT){
            return "lightOrange";
        }else if((float)$value >= SUBTOTAL_HIGHEST_LIMIT){
            return "green";
        }else{
            return "";
        }
            
        }else{
            return "";
        }
}

//This function will read a variable through the url. The variable name is command.
//The function expects the value print. it will return the class print that has an 
//specific style as required(white back ground and opacity of 0.3).
function readUrlPrintCommand(){
    
    if(isset($_GET['command'])){
        
        $command = htmlspecialchars($_GET['command']);
        if($command == "print"){
            
            return "print";
        }else{
            
            return "";
        }    
    }else{
        return "";
    } 
}

//This function will handle the errors that may occur during the excecution of the pages.
function manageError($errorNumber,$errorMessage, $errorFile, $errorLine){
    
    global $debug;
    $today = (new DateTime())->format('Y-m-d H:i:s:u');
    echo  "<p class=\"error\">There is a problem with our website... We are currently working on fixing it! "
           . "Sorry for the inconvenients.</p><br/>";
    
    $error = "-Error ocurrred in the file $errorFile at line $errorLine:" .
                "Error number $errorNumber: $errorMessage, Time: " . $today; 
    
    file_put_contents(FILE_ERRORS_LOGFILE, $error . "\r\n" , FILE_APPEND) or die("cannot open the file");
    //add to a log file
    if($debug==true)
    {
        echo $error;
    
    }
    die();
}

//This function will handle the exceptions that may occur during the excecution of the pages.
function manageException($errorObject){

    global $debug;
    $today = (new DateTime())->format('Y-m-d H:i:s:u');
    echo "<p class=\"error\">There is a problem with our website... We are currently working on fixing it! "
          . "Sorry for the inconvenients.</p><br/>";

    $exception = "-Error ocurrred in the file: $errorObject->getFile() at line: $errorObject->getLine. " .
            "Error number: $errorObject->getNumber(): $errorObject->getMessage() time: " . $today;

    file_put_contents(FILE_ERRORS_LOGFILE, $exception . "\r\n" , FILE_APPEND) or die("cannot open the file");

    if($debug==true)
    {
        echo $exception; 
    }
    die();
}

//This function set the set_error_handler and set_exception_handler of the php pages
function setErrorAndExceptionHandeler()
{
    
    set_error_handler("manageError");
    set_exception_handler("manageException");

}
//This function logout the user when the user press the logout button.
function logout($currentpage)
{
    if(isset($_POST['logout']))
    {
        unset($_SESSION['customerID']);
        unset($_SESSION['c_firstname']);
        unset($_SESSION['c_lastname']);
        unset($_SESSION['current_search_date']);
        unset($_POST['login']);
        unset($_POST['logout']);
        header('location: ' . $currentpage);   
        die();
    }
}

//this function validates the login information entered by the user.
function loginValidation()
{
    global $connection;
    $currrent = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    
    logout($currrent);
    
    if(isset($_SESSION['customerID']) && !isset($_SESSION['c_firstname']))
    {
        
            $mysqlQuery = 'CALL customers_select_one(:custumerID);';
            
            #prepared SQL and bind parameters
            $PDOStatement = $connection ->prepare($mysqlQuery);
            
            $userID = htmlspecialchars($_SESSION["customerID"]);

            $PDOStatement->bindParam(':custumerID', $userID);
            $PDOStatement->execute();
            
            if($row = $PDOStatement->fetch())
            {
                
                $_SESSION['c_firstname'] = $row["c_firstname"];
                $_SESSION['c_lastname'] = $row["c_lastname"];
                header('location: ' . $currrent);        
                die();
            }
            
            $PDOStatement->closeCursor();
            $PDOStatement= null;   
            $connection = null;
        
        
    }else{
        
        if(isset($_POST["login"]))
        {
            
            
            $mysqlQuery = 'CALL login(:c_username);';
            
            #prepared SQL and bind parameters
            $PDOStatement = $connection ->prepare($mysqlQuery);
            
            $username =  htmlspecialchars($_POST["username"]);
            $userPassword = htmlspecialchars($_POST["password"]);
            $hash_password="";

            $PDOStatement->bindParam(':c_username', $username);
            
            $PDOStatement->execute();
            if($row = $PDOStatement->fetch())
            {

                $hash_password = $row["c_userpassword"];
                
                if(password_verify($userPassword, $hash_password))
                    {
                        $_SESSION['customerID'] = $row["customerID"];
                        header('location:' . $currrent);        
                        die();
                    }
            }
            
            $PDOStatement->closeCursor();
            $PDOStatement= null;   
            $connection = null;
        }
    }


}

//This function creates the login function
function createLoginForm()
{   
        //retrieve the current page.
        $currrent = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        loginValidation();
            
        
        ?>
        <div class="login">
            <form name="login" action="<?php echo $currrent; ?>" method="POST">
                <p><label for="username">UserName:</label><input type="username" name = "username"></p>
                <p><label for="password">Password:</label><input type="password" name="password"></p>
                <input class="buttonLog" type="submit" value="Login" name="login" />
                Need a user account? <a class="menu-button" href="<?php echo FILE_PAGE_REGISTER;?>">Register</a>
            </form>
        </div>    
        <?php
    
}

//creates the logour form.
function createLogoutForm()
{
     loginValidation();
     $currrent = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    ?>
        <div class="logout">
            <a class="menu-button" href="<?php echo FILE_PAGE_ACCOUNT;?>">Welcome <?php echo $_SESSION['c_firstname'] . " " . $_SESSION['c_lastname'];?></a>          
            <form action="<?php echo FILE_INDEX; ?>" method="POST">
                <input class="buttonLog" type="submit" name="logout" value="Logout" /><!-- comment -->
            </form>
        </div> 
    <?php 
        
}

//this function creates the registration form and it does the validation of
//the information entered by the user.
function createRegistrationForm(){
    
    global $myCustomersList;
    
    //Error messages variables for validation
    $errorFirstname = null;
    $errorLastname = null;
    $errorAddress = null;
    $errorCity = null;
    $errorProvince=null;
    $errorPostalCode = null;
    $errorUsername = null;
    $errorUserpassword = null;
    
    if(isset($_POST["cancel"])){
         
         header('location: '.FILE_INDEX);
         die();
    }
    
    //isset will asure that the $_POST['buy'] method has been called by clicking the
    //submiting button of the form.
    if(isset($_POST["register"])){
        
        //Reading the variables sent buy the form through the $POST method.
        $c_firstname = htmlspecialchars($_POST['c_firstname']);
        $c_lastname = htmlspecialchars($_POST['c_lastname']);
        $c_address = htmlspecialchars($_POST['c_address']);
        $c_city = htmlspecialchars($_POST['c_city']);
        $c_province = htmlspecialchars($_POST['c_province']);
        $c_postalcode = htmlspecialchars($_POST['c_postalcode']);
        $c_username = htmlspecialchars($_POST['c_username']);
        $c_userpassword =  htmlspecialchars($_POST['c_userpassword']);

        
        $New_customer = new customer();
        
        //data validation
        $errorFirstname = $New_customer->setFirstname($c_firstname);
        $errorLastname = $New_customer->setLastname($c_lastname);
        $errorAddress = $New_customer->setAddress($c_address);
        $errorCity = $New_customer->setCity($c_city);
        $errorProvince = $New_customer->setProvince($c_province);
        $errorPostalCode = $New_customer->setPostalCode($c_postalcode);
        $errorUsername = $New_customer->setUsername($c_username);
        $errorUserpassword = $New_customer->setUserPassword($c_userpassword);
        
        //This make sure that any error has been made in the submition of the form, it means the submition was
        //successfully done.
        if($errorFirstname == null && $errorLastname == null && $errorAddress == null && $errorCity ==  null && $errorProvince == null
                && $errorPostalCode == null && $errorUsername == null && $errorUserpassword == null  && isset($_POST['register'])){
            
            
            $New_customer = new customer($c_firstname, $c_lastname, $c_address, $c_city, $c_province, $c_postalcode, $c_username, $c_userpassword);
            $New_customer->save();

            header("location:index.php");
            $_SESSION['Registration'] = "completed";
            die();
            
        }

    }else{
        
        //if the submition button has not been pressed you want to be sure the fields are empty.
        $c_firstname = "";
        $c_lastname = "";
        $c_address="";
        $c_city = "";
        $c_province = "";
        $c_postalcode = ""; 
        $c_username = "";  
        $c_userpassword = "";

        
    }

    ?>
                        <form id="SalesForm" method="POST" action="<?php echo FILE_PAGE_REGISTER;?>">
                            <div class="form-row">
                                <div class="form-column-label">
                                <label class="required">First Name:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_firstname"  value="<?php echo $c_firstname ;?>"/> 
                                   <span><?php echo $errorFirstname; ?></span> 
                                </div>                   
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">LastName:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="c_lastname" value="<?php echo $c_lastname ;?>"/>
                                    <span><?php echo $errorLastname; ?></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Address:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_address" value="<?php echo $c_address ;?>"/>
                                   <span><?php echo $errorAddress; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">City:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_city" value="<?php echo $c_city ;?>"/>
                                   <span><?php echo $errorCity; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Province:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_province" value="<?php echo $c_province ;?>"/>
                                   <span><?php echo $errorProvince; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                   <label class="required">Postal Code:</label> 
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="c_postalcode" value="<?php echo $c_postalcode ;?>"/>
                                    <span><?php echo $errorPostalCode; ?></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">UserName:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="c_username" value="<?php echo $c_username ;?>"/>
                                    <span><?php echo $errorUsername; ?></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Password:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="password" name="c_userpassword" value="<?php echo $c_userpassword ;?>"/>
                                    <span><?php echo $errorUserpassword; ?></span>
                                </div> 
                            </div>
                            <input class="button buttonInline" type="submit" name="register" value="Register"/>
                            <input class="button buttonInline" type="submit" name="cancel" value="Cancel"/>
                        </form>
<?php
}


//this function creates the update form and it does the validation of
//the information entered by the user.
function createUpdateForm(){
    
    global $myCustomersList;
    
    //Error messages variables for validation
    $errorFirstname = null;
    $errorLastname = null;
    $errorAddress = null;
    $errorCity = null;
    $errorProvince=null;
    $errorPostalCode = null;
    $errorUsername = null;
    $errorUserpassword = null;
    
    if(isset($_POST["cancel"])){
         
         header('location:'.FILE_INDEX);
         die();
    }
    
    
    //isset will asure that the $_POST['buy'] method has been called by clicking the
    //submiting button of the form.
    if(isset($_POST["update"])){
        
        //Reading the variables sent buy the form through the $POST method.
        $c_firstname = htmlspecialchars($_POST['c_firstname']);
        $c_lastname = htmlspecialchars($_POST['c_lastname']);
        $c_address = htmlspecialchars($_POST['c_address']);
        $c_city = htmlspecialchars($_POST['c_city']);
        $c_province = htmlspecialchars($_POST['c_province']);
        $c_postalcode = htmlspecialchars($_POST['c_postalcode']);
        $c_username = htmlspecialchars($_POST['c_username']);
        $c_userpassword =  htmlspecialchars($_POST['c_userpassword']);

        
        $New_customer = new customer();
        $New_customer->load($_SESSION['customerID']);
        
        //data validation
        $errorFirstname = $New_customer->setFirstname($c_firstname);
        $errorLastname = $New_customer->setLastname($c_lastname);
        $errorAddress = $New_customer->setAddress($c_address);
        $errorCity = $New_customer->setCity($c_city);
        $errorProvince = $New_customer->setProvince($c_province);
        $errorPostalCode = $New_customer->setPostalCode($c_postalcode);
        $errorUsername = $New_customer->setUsername($c_username);
        $errorUserpassword = $New_customer->setUserPassword($c_userpassword);
        
        //This make sure that any error has been made in the submition of the form, it means the submition was
        //successfully done.
        if($errorFirstname == null && $errorLastname == null && $errorAddress == null && $errorCity ==  null && $errorProvince == null
                && $errorPostalCode == null && $errorUsername == null && $errorUserpassword == null  && isset($_POST['update'])){

            $date = date("Y/m/d h:i:sa");
            $New_customer->setDateModification($date);
            
            $New_customer->save();
            
            $_SESSION['c_firstname'] = $New_customer->getFirstname();
            $_SESSION['c_lastname'] = $New_customer->getLastname();

            ?>
                <script>
                    alert('Update is Completed!');
                </script>
           <?php

        }

    }else{
        
        //
        $currentCustomer = new customer();
        
        $currentCustomer->load($_SESSION['customerID']);
        
        $c_firstname = $currentCustomer->getFirstname();
        $c_lastname = $currentCustomer->getLastname(); 
        $c_address = $currentCustomer->getAddress(); 
        $c_city =  $currentCustomer->getCity();
        $c_province = $currentCustomer->getProvince();
        $c_postalcode =  $currentCustomer->getPostalCode(); 
        $c_username =  $currentCustomer->getUsername();
        $c_userpassword =  "";

        
    }

    ?>
                        <form id="SalesForm" method="POST" action="<?php echo FILE_PAGE_ACCOUNT ;?>">
                            <div class="form-row">
                                <div class="form-column-label">
                                <label class="required">First Name:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_firstname"  value="<?php echo $c_firstname ;?>"/> 
                                   <span><?php echo $errorFirstname; ?></span> 
                                </div>                   
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">LastName:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="c_lastname" value="<?php echo $c_lastname ;?>"/>
                                    <span><?php echo $errorLastname; ?></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Address:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_address" value="<?php echo $c_address ;?>"/>
                                   <span><?php echo $errorAddress; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">City:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_city" value="<?php echo $c_city ;?>"/>
                                   <span><?php echo $errorCity; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Province:</label> 
                                </div>
                                <div class="form-column-input">
                                   <input type="text" name="c_province" value="<?php echo $c_province ;?>"/>
                                   <span><?php echo $errorProvince; ?></span>
                                </div> 
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                   <label class="required">Postal Code:</label> 
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="c_postalcode" value="<?php echo $c_postalcode ;?>"/>
                                    <span><?php echo $errorPostalCode; ?></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">UserName:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="text" name="c_username" value="<?php echo $c_username ;?>"/>
                                    <span><?php echo $errorUsername; ?></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column-label">
                                    <label class="required">Password:</label>
                                </div>
                                <div class="form-column-input">
                                    <input type="password" name="c_userpassword" value="<?php echo $c_userpassword ;?>"/>
                                    <span><?php echo $errorUserpassword; ?></span>
                                </div> 
                            </div>
                            <input class="button buttonInline" type="submit" name="update" value="Update"/>
                            <input class="button buttonInline" type="submit" name="cancel" value="Cancel"/>
                        </form>
<?php
}