<?php
	require("header.php");
?>

<html>
	<body>
<?php
	$sql = "CREATE TABLE IF NOT EXISTS logininfo
		(
		userID INT(3) NOT NULL AUTO_INCREMENT,
		loginname varchar(15) NOT NULL,
		password varchar(128) NOT NULL,
		PRIMARY KEY (userID),
		UNIQUE KEY (loginname)
		)";

	mysql_query($sql,$connection);

	register($_POST[registername],$_POST[registerpassword],$connection);
	mysql_close($connection);
?>
		<a href="index.php">Index</a></br>
	</body>
</html>
