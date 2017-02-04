<?php
if ($_POST) {

  $cookie = $_COOKIE['Sellerlogauth'] ;
  $productSeller=$cookie['user'] ;
  $productImages=$_POST['productImages'] ;
  $productName=$_POST['productName'] ;
  $productPrice=$_POST['productPrice'] ;
  $productQuantity=$_POST['productQuantity'] ;
  $productCategory=$_POST['productCategory'] ;
  $productSubCategory=$_POST['productSubCategory'] ;
  $productsale= $_POST['productsale'] ;
  $productavgrating = 0 ;
  $productDetails = $_POST['productDetails'] ;




  // MYSQL Details
    $dbname = "Flipkart" ;
    $host  = "flipkart.c1nb8pzitscg.us-east-1.rds.amazonaws.com"   ;
    $username = "piyush"  ;
    $password = "piyush123" ;



    //Querry

  $query = "insert into products ( productName , productPrice , productQuantity , productSeller, productCategory , productSubCategory , productsale , productavgrating , productDetails , productImages) VALUES ( '".$productName."','".$productPrice."','".$productQuantity."','".$productSeller."','".$productCategory."','".$productSubCategory."','".$productsale."','".$productavgrating."','".$productDetails."','".$productImages."')" ;





  $conn = mysql_connect($host, $username , $password) ;

  if ($conn) {

      mysql_select_db($dbname , $conn)  ;

      $result = mysql_query($query , $conn) ;

      if (mysql_affected_rows()>0 ){

        echo "Done";
      }

      else{
        echo "Fail";
      }

    }
}
 ?>
