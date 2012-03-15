<?php
function myHash($input)
{
	return hash('sha512', $input);
}

function logout()
{
	session_destroy();
}

function register($name,$pass,$connection)
{
	if ($name == '' || $pass == '')
	{
		echo "Error: Blank fields";
	}
	else
	{
		$hashpass = myHash($pass);
		$sql="INSERT INTO logininfo (loginname, password) VALUES ('$name','$hashpass')";
		mysql_query($sql,$connection) or die(mysql_error());
		echo "Registration Successful<br />";
	}
}
?>
