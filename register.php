<?php
	require("header.php");
?>

<html>
	<body>

		<a href="index.php">Index</a></br>

<?php

	$tables=mysql_query("SHOW TABLES IN db_users");
	echo($tablerows[pass]);
	while ($rows=mysql_fetch_array($tables))
	{
		echo $row['loginname'];
	}

	$sql = "CREATE TABLE IF NOT EXISTS logininfo
		(
		userID INT(3) NOT NULL AUTO_INCREMENT,
		loginname varchar(15) NOT NULL,
		password varchar(128) NOT NULL,
		PRIMARY KEY (userID),
		UNIQUE KEY (loginname)
		)";

	mysql_query($sql,$connection);

	if ($_POST[registername] == '' || $_POST[registerpassword] == '')
	{
		echo "Registration Unsuccessful<br />";
	}
	else
	{
		$password = myHash($_POST[registerpassword]);
		$sql="INSERT INTO logininfo (loginname, password) VALUES ('$_POST[registername]','$password')";
			
		if (!mysql_query($sql,$connection)) 
		{
			die('Error: ' . mysql_error());
		}

		else 
		{
			echo "Registration Successful<br />";
		}
	}
	mysql_close($connection);
?>
	</body>
</html>
