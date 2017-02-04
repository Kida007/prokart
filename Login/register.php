<?php  

require_once('load.php') ; 
$j->register('login.php');


?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>

<h2>REGISTER NOW</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  >


	<input type="text" name="sname" placeholder="Full Name"/> <br> <br>
	<input type="text" name="user_name" placeholder="User Name"/> <br> <br>
	<input type="password" name="user_password" placeholder="Password"/> <br> <br> 
	<input type="number" name="phone" placeholder="Phone Number"/><br><br>
	<input type="email" name="email" placeholder="Email Address"> <br><br> 
	<input type="submit" name="Register">

	
</form>

</body>
</html>