<?php
$page = "register"; 
include "dbconn.php";

if (isset($_POST['username'])){
	$username = stripslashes($_POST['username']);
	$username = $link->real_escape_string($username);
	$password = stripslashes($_POST['password']);
	$password = $link->real_escape_string($password);
	$confirmPassword = stripslashes($_POST['confirm_password']);
	$confirmPassword = $link->real_escape_string($confirmPassword);
	if($password != $confirmPassword){
		$_SESSION['MESSAGE'] = "Passwords do not match!";
		$_SESSION['MESSAGE_TYPE'] = "alert-warning";
	}
	else{
		$query = "INSERT into `user` (`username`, `password`) VALUES ('$username', '$password')";
		if( $link->query($query) ){
			$_SESSION['MESSAGE'] = "Successfully Registered!";
			$_SESSION['MESSAGE_TYPE'] = "alert-success";
			$_SESSION['username'] = $username;
			header("Location: index.php");
			exit();
 		}
		else{
			$_SESSION['MESSAGE'] = "Error: ".$link->error." !";
			$_SESSION['MESSAGE_TYPE'] = "alert-danger";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("header.html"); ?>
    <link rel="stylesheet" href="css/login.css">
	<title>Register - News Group</title>
</head>

<body>
	<?php include("navbar.php"); ?>
	<div class="wrapper">
		<div class="container form-signin">
			<?php include("message.php"); ?>

			<form method="post" action="register.php">
				<h2 class="form-signin-heading">Register</h2>

				<label for="id_username" class="sr-only">Username</label>
				<input type="text" name="username" id="id_username" class="form-control" maxlength="254" placeholder="Username" required autofocus>

				<label for="id_password" class="sr-only">Password</label>
				<input type="password" name="password" id="id_password" class="form-control" placeholder="Password" required>

				<label for="id_confirm_password" class="sr-only">Confirm Password</label>
				<input type="password" name="confirm_password" id="id_confirm_password" class="form-control" placeholder="Confirm Password" required>
				<div align="right"><a href="login.php">Already registered? Login here!</a></div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
			</form>
		</div>
	</div>
	<?php include("scripts.html"); ?>
</body>

</html>