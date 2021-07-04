//Revision history:
//Developer                   DATE            COMMENTS
//Camilo Restrepo(1931815)    2021-04-24      Creation of the javascript file that will containt the functions.
//Camilo Restrepo(1931815)    2021-04-25      Creation of the function filter_by_date.
//Camilo Restrepo(1931815)    2021-04-25      Creation of the function delete_row.
//Camilo Restrepo(1931815)    2021-04-26      Creation of the function getSelectedProduct.

//This function calls a the filter_response.php where the table with the user filters are loaded into a
//table
function filter_by_date()
{       
    try{
        
        //Declaration of the XMLHttpRequest object to use AJAX.
        var xhr = new XMLHttpRequest();

        var date = document.getElementById("filter_date").value;
        
        xhr.open("POST", "filter_response.php");

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


        //checking the state of the request
        xhr.onreadystatechange = function()
        {
            //Actions to be perform when the page is loaded propertly
            if(xhr.readyState == 4 && xhr.status == 200)
            {
                //Passing the respounse to a container in the html.   
                document.getElementById("ordersTable").innerHTML = xhr.responseText;
                document.getElementById("filter_date").value = date;

            }
        }

        //sending the input date
        xhr.send("filter_date=" + date);
        
    }catch(myerror){
        
        handleerror(myerror);
    }
    
}

//This function delete the row where the delete button is pressed.
function delete_row(id){
    
    try{
        
        //Declaration of the XMLHttpRequest object to use AJAX.
        var xhr = new XMLHttpRequest();

        var purchaseID = id;
        
        
        xhr.open("POST", "filter_response.php");

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


        //Actions to be perform when the page is loaded propertly
        xhr.onreadystatechange = function()
        {
                if(xhr.readyState == 4 && xhr.status == 200)
                {
                       //calls of the filter by date function to reload the data shown in 
                       //the search.
                       filter_by_date();
                }
        }
        
        //sending the purchaseID of the purchase that needs to be deleted
        xhr.send("delete=" + purchaseID);
        
    }catch(myerror){
        
        handleerror(myerror);
    }
    
}

//this function gets the productID selected on the buy form and it retrive the
//price and descriptions of the product selected in the combobox.
function getSelectedProduct(id){
    
    try{
        //Declaration of the XMLHttpRequest object to use AJAX.
        var xhr = new XMLHttpRequest();

        var productID = id;
        
        
        xhr.open("POST", "get_product_response.php");

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


        //Actions to be perform when the page is loaded propertly
        xhr.onreadystatechange = function()
        {
                if(xhr.readyState == 4 && xhr.status == 200)
                {
                       var product = JSON.parse(xhr.responseText);
                       console.log(product);
                       document.getElementById('currProductPrice').value = "$"+product.price;
                       document.getElementById('currProductDescription').value = product.description;
                       
                }
        }
        
        //sends the productID selected on the combobox.
        xhr.send("getProduct=" + productID);
        
    }catch(myerror){
        
        handleerror(myerror);
    }
    
}