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
	if($_SESSION['loggedin'])
	{
		if ($_SESSION['admin'])
		{
			show_admin_table($connection);
		}
		else
		{ 
			show_table($connection);
		}
	}

	else 
	{
		echo "Unsuccessful login";
	}

	mysql_close($connection);

	require("footer.php");
?>
