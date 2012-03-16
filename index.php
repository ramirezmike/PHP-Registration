<?php 
	require("header.php");

if(isset($_GET['logout']))
{
	logout();
}
if(isset($_GET['login']))
{
	echo "Login unsuccessful";
}
if (isset($_POST['login']))
{
	$_SESSION['loginname'] = $_POST['loginname'];
	$_SESSION['password'] = $_POST['password'];
	header("Location: main.php");
}
?>

<html>
	<body>

		<form action="index.php" method="post">
			Login<br />
			Name:<br /> 
			<input type = "text" name="loginname" /><br />
			Password:<br /> 
			<input type = "password" name="password" /><br />
			<input type="submit" name="login" value="Enter">
		</form>

		<form action="register.php" method="post">
			Register<br />
			Name:<br /> 
			<input type = "text" name="registername" /><br />
			Password:<br /> 
			<input type = "password" name="registerpassword" /><br />
			<input type="submit" value="Register" />
		</form>

	</body>
</html>
