<?php

// A seller Database class  .
// THIS IS A BASIC DATABASE CLASS ALL THE DATABASE CLASS STUFF HAPPENS HERE.

class SellerDatabase  {




	// Php 4 Compatability

	function SellerDatabse (){

		return $this->__construct() ;

	}


// Php 5 onwards compatibility
//This Constructor Will automatically connect to The Datase Using tHe Connect Function , When The object of SellerDatabase class is intiated .

	function __construct(){

		 $this->connect() ;
	}

// creating a function connect for database Connection

	function connect(){

		$conn = mysql_connect(DB_HOST , DB_USER , DB_PASS) ;
		if(!$conn){
			die('could not connect to :'.mysql_error()) ;
		}

		error_log('conn- databsae: $conn') ;

		// select a database
		$database  =  mysql_select_db(DB_NAME, $conn );

		if (!$database) {
				die('Could not use database '.DB_NAME .mysql_error() );
		}
		else {
			return $conn ;
		}

	}

	// CREATING A FUNCTION FOR cleaning AN string ARRAY from any dangerous character as it put a backslash before it \

	function clean($array){

		return array_map('mysql_real_escape_string', $array);

	}



	// Nonce is different for different user , it is difficult to dehash for every single User .
	// Site key is different for every website and can be changed accordingly .
	// hash_hmac is used to create hash of the password .

	function hash_passwd($password , $nonce) {
		$secureHash  = hash_hmac('sha512', $password.$nonce, SITE_KEY) ;
		return $secureHash ;
	}



	// Creating a Insert Function
	// we use implode function to concat all the fields with     ,      and all the values  with ','

	function insert ($conn , $table , $fields , $values) {

		$fields = implode(",", $fields) ;
		$values = implode("','", $values) ;

		// insert querry
		$sql="INSERT INTO $table (id, $fields) VALUES ('', '$values')" ;
		$result =mysql_query($sql ,$conn ) ;


		if (mysql_affected_rows()>0) {
			return TRUE ;

		}

		else {
			die("Error : ".mysql_error()) ;
		}
	}



	// SELECTS DATA FROM Database  .

	function select ($sql ,$conn) {
		$result = mysql_query($sql , $conn) ;
		return $result  ;

	}

}

$jdb = new SellerDatabase ;

?>
