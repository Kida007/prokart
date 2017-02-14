<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);



if($_POST['productSubCategory']||$_POST['productSeller']) {

  error_log("###############################################################");



  $datastring ;
   $query = "" ;

   if ($_GET['productSubCategory']) {
           $productSubCategory = $_POST['productSubCategory']  ;
           $query="SELECT productId , productName , productImages , productPrice , productsale , productQuantity , productavgrating from products where productSubCategory = '" . $productSubCategory  ."'";

         }
         else {
           $productSeller = $_POST['productSeller'] ;
           $query="SELECT productId , productName , productImages , productPrice , productsale , productQuantity , productavgrating from products where productSeller = '" . $productSeller  ."'";
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

       while ($product = mysql_fetch_assoc($result)) {
                  //selecting each product
         array_push($products, $product) ;
        $datastring= $datastring.'<div class="col-md-4">
          <div class="card">
            <p class="productname">'.$product['productName'].'</p>
            <p class="productavail text-success">In Stock</p>
            <img class="img-responsive productimage lazy" data-src="'.$product['productImages'].'"/>
            <div class="pricem">
              <p class="price"> ₹'.$product['productPrice'].'</p>
              <p class="discount text-muted">'.$product['productsale'].' % off</p>
              <div class="rating"></div>
            </div>
          </div>
        </div>' ;
       }
       echo $datastring;


     }

     // Json Output

     //header('Content-type : application/json') ;
     //echo json_encode(array('products'=>$products)) ;


    }

    else{
     echo "MYSQL connection Fail";
    }

}


else {

  echo "Their is an serious Error";
}

 ?>
