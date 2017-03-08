<?php
require_once('load.php') ;

  if ($_POST['function']) {

    $function = $_POST['function'] ;
    error_log("hello - ".$function);

    switch ($function) {
      case 'logout':
      $logout =   $j->logout();
      error_log("status ".$logout);
      if($logout)

      {
        $url='/Web/Login/login.php' ;
        header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $url);

    		exit ;

      }
      break;
    }

  }


  else {


  $logged = $j->checklogin() ;
  global $jdb ;

  if ($logged==false) {
      $url='http://localhost/Web/Login/addproduct.php' ;
      $url = strtok($url, '?');
      $redirect = str_replace("addproduct.php", "login.php" , $url) ;
      header("Location: $redirect?msg=login") ;
      exit;
  }

}




/*  else  {

     $cookie = $_COOKIE['Sellerlogauth'] ;

    $user = $cookie['user'] ;
    $userid =$cookie['userid'] ;

    $table = 'Seller' ;

    $sql = "SELECT * FROM $table WHERE user_name='" . $user . "'";
    error_log("sql : ".$sql)  ;

    $conn = $jdb->connect() ;
    $results = $jdb->select($sql , $conn) ;
    error_log('result :'.$result) ;

  if (!$results) {
    die('Sorry, that username does not exist! bazinga');
   }

    $results = mysql_fetch_assoc( $results ); */

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Prokart</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/panel.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>

    <tag autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>


    <div class="wrapper" >

      <div class="sidebar">
       <div class="sidebar-wrapper">
          <div class="logo">
            <a href="#"><p>ProKart</p></a>
          </div>
          <ul class="nav">
            <li>
             <a href="adminpanel.php">
               <i class="fa fa-tachometer"></i>
               <p>DASHBOARD</p>
             </a>
            </li>

            <li>
              <a href="profile.html">
                <i class="fa fa-user-o"></i>
                <p>PROFILE </p>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-truck"></i>
                <p>ORDERS</p>
              </a>
            </li>

            <li class="active">
              <a href="addprouct.php">
                <i class="fa fa-plus-square-o"></i>
                <p>ADD PRODUCT</p>
              </a>
            </li>

            <li>
              <a  href="product.php">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                <p>PRODUCTS</p>
              </a>
            </li>

            <li>
              <a href="notification.php">
                <i class="fa fa-bell-o"></i>
                <p>NOTIFICATION</p>
              </a>
            </li>
          </ul>
       </div>
    </div>


    <!-- main panel -->

    <div class="main-panel">
      <!-- using bootstrap navbar -->
      <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-2" >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand">Dashboard</a>
          </div>

         <div class="collapse navbar-collapse" id="nav-2">
              <ul class="nav navbar-nav navbar-left">

                <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-globe" id="pi"> </i>
                    <b class="caret"></b>

                   </a>
                   <ul class="dropdown-menu">
                     <li><a href="#">Notification-1</a></li>
                     <li><a href="#">Notification-2</a></li>
                     <li><a href="#">Notification-3</a></li>
                     <li><a href="#">Notification-4</a></li>
                     <li><a href="#">Notification-5</a></li>
                   </ul>
                </li>

              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li>
                  <form action="addproduct.php" method="post">
                     <button class="btn-blank"value="logout" type="submit" name="function"><a>Logout</a></button>
                </form>
                </li>
              </ul>
          </div>
        </nav>



          <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8">
                  <div class="card">
                  <form id="form" method="post" action="fl_includes/addproductcore.php">

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label>Product Name</label>
                          <input class="input-bx"type="text"  name="productName" placeholder="Eg. Lenovo K3 Power" id="productName">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Price(₹)</label>
                          <input class="input-bx"type="number" name="productPrice" placeholder="Eg. ₹16000" id="productPrice">
                        </div>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Quantity Available</label>
                          <input class="input-bx" type="number" name="productQuantity" placeholder="Eg. 120" id="productQuantity">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Category</label>
                          <select name="productCategory" class="sel">
                            <option value="Electronics">Electronics</option>
                            <option value="Homeware">HomeWare</option>
                          </select>
                        </div>
                      </div>

											<div class="col-md-4">
                        <div class="form-group">
                          <label>Sub-Category</label>
                          <input class="input-bx" type="text" name="productSubCategory" placeholder="Eg.PowerBanks" id="productSubCategory" >
                        </div>
                      </div>

                    </div>


										<div class="row">
												<div class="col-md-12">
													<div class="form-group">
															<label>Product Description</label>
															<textarea class="input-bx" type="text" name="productDetails" placeholder="All Product details (200 words max)" rows="5" id="productDetails"></textarea>
													</div>
												</div>
										</div>

										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label>Image Link</label>
													<input class="input-bx" type="text" name="productImages" placeholder="Eg: https://www.helpkart.in/images/product1.jpg" id="productImages">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<div class="form-group">
														<label>Product sale</label>
														<input class="input-bx" type="text" name="productsale" placeholder="Eg: 10%" id="productsale">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12 col-md-offset-0">
										<button class="btn btn-warning" type="submit" id="submit">Submit</button>
								    	</div>
									 </div>

                 </form>
                 </div>
                </div>
            </div>

         </div>



  </div>

  </div>
</div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/addproduct.js"></script>
    <script src="js/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>
