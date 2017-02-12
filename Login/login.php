<?php

require_once('load.php') ;
if ($_GET['action']=='logout') {

	$loggedout = $j->logout();
	}

	$logged = $j->login('adminpanel.php') ;

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body>


<!--<div style="width: 960px; background: #fff; border: 1px solid #e4e4e4; padding: 20px; margin: 10px auto;">
			<?php if ( $logged == 'invalid' ) : ?>
				<p style="background: #e49a9a; border: 1px solid #c05555; padding: 7px 10px;">
					The username password combination you entered is incorrect. Please try again.
				</p>
			<?php endif; ?>
			<?php if ( $_GET['reg'] == 'true' ) : ?>
				<p style="background: #fef1b5; border: 1px solid #eedc82; padding: 7px 10px;">
					Your registration was successful, please login below.
				</p>
			<?php endif; ?>
			<?php if ( $_GET['action'] == 'logout' ) : ?>
				<?php if ( $loggedout == true ) : ?>
					<p style="background: #fef1b5; border: 1px solid #eedc82; padding: 7px 10px;">
						You have been successfully logged out.
					</p>
				<?php else: ?>
					<p style="background: #e49a9a; border: 1px solid #c05555; padding: 7px 10px;">
						There was a problem logging you out.
					</p>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( $_GET['msg'] == 'login' ) : ?>
				<p style="background: #e49a9a; border: 1px solid #c05555; padding: 7px 10px;">
						You must log in to view this content. Please log in below.
					</p>
			<?php endif; ?>
	</div>-->



	<div class="container">

		<img src="images/admin.png">
		<form action="<?php echo $_SERVER['PHP_SELF'] ;?> " method="post" >

			<h3>Flipkart Seller Login</h3>

			<div class="form-input">
				<input class="inputbox"  type="text" name="subname" placeholder="UserName"/> <br> <br>
			</div>

			<div class="form-input">
				<input class="inputbox" type="password" name="subpass" placeholder="Password"/><br> <br>
			</div>

			<div>
				<input class="inputbox1" type="submit" name="LOGIN"> <br><br>
			</div>

		</form>
	</div>

</body>
</html>
