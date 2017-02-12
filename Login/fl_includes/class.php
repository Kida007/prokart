<?php




	// THIS IS MAIN CLASS   , ALL MAJOR OPERATION ARE CARRIED OUT HERE (LOGIN LOGOUT REGISTER) ARE CALLED FROM THIS CLASS .

	class seller {

		// function register for creating a operating registeration .... :)
		// All the functions in seller class are passed with redirect link


		function register($redirect){

			global $jdb  ;

			// To check the form  submission is coming from our script. yes im pro xD



			// Full Url of the the original / our Registration Page ;
			$current = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;

			// Full url of the page the form was submitted from :
			$referrer = $_SERVER['HTTP_REFERER'] ;


			// Check is the post is empty or contains some array :

			if (!empty($_POST)) {



				if ($referrer == $current) {

					require_once('db.php') ;


				$table = "Seller"  ;

				// fields
				$fields = array('sname', 'user_name' , 'user_password' ,  'phone' , 'email' )  ;

				// clean the post array from any dangerous character or to prevent sql injection

				$values = $jdb->clean($_POST) ;

				// Getting seperate values from the post .


				$sname =              $values['sname'] ;
				$user_name =          $values['user_name'] ;
				$user_password =  	  $values['user_password'] ;
				$phone =              $values['phone']  ;
				$email =              $values['email'] ;

				// creating an 128 bit 	nonce which is unique for every user using md5 algorithm (message digest)
				$nonce = md5('registeration-seller-' . $user_name . NONCE_SALT) ;


				// the above nonce + sitekey is used to create a secured hashed password  .
				// hashing password

				$user_password = $jdb->hash_passwd($user_password, $nonce) ;

				//recompile values
				$values = array('sname'=>$sname , 'user_name'=>$user_name , 'user_password'=>$user_password , 'phone'=>$phone , 'email'=>$email ) ;

				 $conn = $jdb->connect() ;

				$result = $jdb->insert($conn , $table , $fields  , $values) ;

				if ($result == TRUE) {

					// Redirecting
					$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;

					// string the redirecting url in redirect
					// "login.php" ===> "http://www.flipkart.com/login.php"  where   "http://www.flipkart.com/register.php" ==> "http://www.flipkart.com/login.php"
					$redirect  = str_replace('register.php', $redirect, $url) ;

					header("Location: $redirect?reg=true") ;
					exit ;
				    }


        		}


        		else {
        			die('Your form submissiondid not come from your/original page') ;
        		}

			 }

		}





		function login($redirect) {
			global $jdb ;

			if (!empty($_POST)) {

				error_log("login-User :".$_POST['subname']);
				// Prerventing any sql Injection :)
				$values = $jdb->clean($_POST) ;

				// getting seperate values from

				$subname = $values['subname'] ;
				$subpass = $values['subpass'] ;


				$table = 'Seller'  ;

				$conn  =  $jdb->connect() ;
				$query = "SELECT * FROM $table WHERE user_name='".$subname. "'" ;

				$result = $jdb->select($query , $conn) ;
				error_log("login-result : ".$result) ;
				if (!$result) {
					die("The username doesnot exist") ;

				}

				$result = mysql_fetch_assoc($result) ;

				$storedname = $result['user_name'] ;
				$storedpass = $result['user_password'] ;

// creating an 128 bit 	nonce which is unique for every user using md5 algorithm (message digest)

				$nonce = md5('registeration-seller-' . $storedname . NONCE_SALT) ;

				$subpass = $jdb->hash_passwd($subpass , $nonce) ;

				if ($subpass == $storedpass) {

					// user is authentic
					// rehashing the password to store in a cookie for a session

					session_start();
					error_log("login-True_user");
					$auth_nonce =  md5('cookie-' . $subname . USER_SALT) ;
					$userid =  $jdb->hash_passwd($subpass ,$auth_nonce);

				// Creating a cookie
				// cookie will expire as soon as the browser is terminated
				$_SESSION['user'] = $subname;
				$_SESSION['userid']=$userid ;

				setcookie('Sellerlogauth[user]' , $subname , 0 , '' , '' , '' , true ) ;
				setcookie('Hello' , $subname , 0 , '' , '' , '' , true ) ;
				setcookie('Sellerlogauth[userid]' , $userid , 0 , '' , '' , '' , true ) ;

				// finally redirecting

				$url =  'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ;
		        $url = strtok($url, '?');

				$redirect = str_replace('login.php', $redirect, $url) ;

				header("Location: $redirect") ;

				exit ;

			}

			else{

			 return 'invalid';

			}


		}

		else {

			return 'empty' ;
		}
	}


	function logout() {
			//Expire our auth coookie to log the user out

			$idout = setcookie('Sellerlogauth[userid]', '', -3600, '', '', '', true);
			$userout = setcookie('Sellerlogauth[user]', '', -3600, '', '', '', true);

			if ( $idout == true && $userout == true ) {
				return true;
			} else {
				return false;
			}
		}






	function confirmUser(){

		global $jdb ;
		$cookie = $_COOKIE['Sellerlogauth'] ;

		$user = $cookie['user'] ;
		$userid =$cookie['userid'] ;
		error_log("userid1 :  ".$userid) ;

		// Checking wheter cookie is empty or not

		if (!empty($cookie)) {

			require_once('db.php') ;

			$table = 'Seller' ;

			$sql = "SELECT * FROM $table WHERE user_name = '". $user ."'"   ;

			$conn = $jdb->connect() ;

			$result = $jdb->select($sql, $conn) ;


			if (!result) {
					return false ;
			}

			$result = mysql_fetch_assoc($result) ;


			// this is hashed once password

			$storedpass = $result['user_password'] ;



			// rehashing the passwd to match it with
			$auth_nonce =  md5('cookie-'.$user.USER_SALT) ;


			error_log("\n\n pass2=".$storedpass) ;
			error_log("\n\n  nonce2 = ".$auth_nonce) ;

			$uid = $jdb->hash_passwd($storedpass , $auth_nonce) ;


			if ($uid==$userid) {

				$result = true ;

			}
				else
				$result  = false ;

		}


		else {

		  $result = false  ;
		}

		return $result ;
	}


	function checklogin(){
		session_start();
		$cookie = $_COOKIE['Sellerlogauth'] ;
		if(isset($_SESSION['user']) && isset($_SESSION['userid'])){
			error_log("checklogin-valid_session") ;
			return true ;
		}
		else if (isset($cookie['user']) && isset($cookie['userid'])) {
				if($this->confirmUser())
				{
					error_log("checklogin-vakid-cookie") ;
					$_SESSION["user"] = $_COOKIE['user'] ;
          $_SESSION["userid"] = $_COOKIE['userid'] ;
				return true ;
			}
			else {
				header("Location : https://www.google.in");
				error_log("checklogin-unvalid_cookies");
				logout();
				return false;
			}
		}

		else
		{

			error_log("checklogin-nologin") ;
		  return false ;
	 }
	}


	}

	// class Ends here

	//Instantiate our class with an object

	$j = new Seller ;

	//error_reporting(E_ERROR | E_WARNING | E_PARSE);

  ?>
