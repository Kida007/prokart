<?php  

  if($_GET['productSubCategory']||$_GET['productSeller']) {

      $query = "" ; 

      if ($_GET['productSubCategory']) {
              $productSubCategory = $_GET['productSubCategory']  ;  
              $query="SELECT productId , productName , productImages , productPrice , productsale , productavgrating from products where productSubCategory = '" . $productSubCategory  ."'"; 

            }
            else {
              $productSeller = $_GET['productSeller'] ; 
              $query="SELECT productId , productName , productImages , productPrice , productsale , productavgrating from products where productSeller = '" . $productSeller  ."'";               
            }


  		// MYSQL Details  
  		$dbname = "Flipkart" ; 
  		$host  = "flipkart.c1nb8pzitscg.us-east-1.rds.amazonaws.com"   ;
  		$username = "piyush"  ;
  		$password = "piyush123" ; 

  		//query  
  	



        $products = array() ;
  		//connect to database

  		$conn  = mysql_connect($host , $username , $password) ;



  		if ($conn) {

  			// selecting database 
  			mysql_select_db($dbname, $conn) ; 

  			// result 
  			$result =  mysql_query($query , $conn) ; 


  			// if the result have morethan 0 rows

  			if (mysql_num_rows($result)) {

  				while ($product = mysql_fetch_assoc($result)) { //selecting each product    
            array_push($products, $product);
  				}  


  			}

  			// Json Output 

  			header('Content-type : application/json') ; 
  			echo json_encode(array('products'=>$products)) ;  



  		 } 

  		 else{
  		 	echo "MYSQL connection Fail";
  		 }
  }


  else {

  	echo "Their is an serious Error";
  }



?>