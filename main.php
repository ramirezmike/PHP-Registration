<?php
require("header.php");
?>

<html>
	<body>

		<a href="index.php">Index</a></br>

<?php
	if(isset($_POST['Delete']))
	{
		delete($_POST['deleteuser']);
	}

	$adminRow=mysql_fetch_array(mysql_query("SELECT * FROM logininfo WHERE userID=1"));
	$loginRow=mysql_query("SELECT * FROM logininfo WHERE loginname='$_SESSION[loginname]'");
	$nameForCheck=mysql_fetch_array($loginRow);


	if ($nameForCheck['password'] == myHash($_SESSION['password'])) 
	{
		$result = mysql_query('SELECT * FROM logininfo',$connection); 
		$rownumbers = mysql_num_rows($result);

		if ($_SESSION['loginname'] == $adminRow['loginname'])
		{
			$_SESSION['loggedin'] = 1;
			show_admin_table($result);
		}
		else if ($rownumbers )
		{
			$_SESSION['loggedin'] = 1;
			show_table($result);
		}

	}

	else 
	{
		echo "Unsuccessful login";
	}

	mysql_close($connection);

	require("footer.php");
?>
