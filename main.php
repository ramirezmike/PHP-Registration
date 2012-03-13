<html>
<body>

<?php
$connection = mysql_connect("localhost","root");
if (!$connection)
	{
	die( mysql_error());
	}
if (!mysql_select_db("db_users", $connection))
	{
	mysql_query("CREATE DATABASE db_users", $connection);
	echo "Database created";
	}
else
	{
	echo  mysql_error();
	}
mysql_select_db("db_users", $connection);
$tables=mysql_query("SHOW TABLES IN db_users");
echo($tablerows[pass]);
while ($rows=mysql_fetch_array($tables)){
	echo $row['loginname'];
}
	$sql = "CREATE TABLE IF NOT EXISTS logininfo
(
loginname varchar(15),
password varchar(15)
)";
mysql_query($sql,$connection);


$sql="INSERT INTO logininfo (loginname, password) VALUES ('$_POST[registername]','$_POST[registerpassword]')";

if (!mysql_query($sql,$connection))
	{
	die('Error: ' . mysql_error());
	}
$result = mysql_query('SELECT * FROM logininfo',$connection); 
$rownumbers = mysql_num_rows($result);
if ($rownumbers > 50)
	{
	echo "Login found";
	echo "$rownumbers Rows\n";
	}
else
	{
	echo "Login not found";
	}

mysql_close($connection);
?>
</body>
</html>
