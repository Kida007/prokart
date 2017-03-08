<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
    <link rel="stylesheet" type="text/css" href="css/star-rating.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/panel.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="wrapper" >

      <!--sidebar-->

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

            <li >
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

            <li>
              <a href="addproduct.php">
                <i class="fa fa-plus-square-o"></i>
                <p>ADD PRODUCT</p>
              </a>
            </li>

            <li class="active">
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
            </div>
            </nav>



             <div class="content container-fluid">
               <h1 class="text-center">Your Products</h1>

               <div class="row products">

               </div>

             </div>

       </div>

      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>



    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/star-rating.js"></script>
    <script src="js/star-rating-2.js"></script>
    <script src="js/cookie.js"></script>
    <script src="js/loadpproduct.js"></script>
    <script type="text/javascript" src="js/jquery.lazy.js"></script>
    <script src="js/script.js"></script>


  </body>
</html>
