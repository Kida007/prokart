<?php  

  if($_GET['productSubCategory']) {

  		$productSubCategory = $_GET['productSubCategory']  ;  

  		// MYSQL Details  
  		$dbname = "Flipkart" ; 
  		$host  = "flipkart.c1nb8pzitscg.us-east-1.rds.amazonaws.com"   ;
  		$username = "piyush"  ;
  		$password = "piyush123" ; 

  		//query 
  		$query = "SELECT productId , productName , productImages , productPrice , productsale , productavgrating from products where productSubCategory = '" . $productSubCategory  ."'"; 

  		//var_dump($query) ; 





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
  					$products = array ('product'=>$product) ;   
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