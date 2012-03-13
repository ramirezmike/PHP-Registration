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

if ($_POST[registername] == '' || $_POST[registerpassword] == '')
{
	echo "Registration Unsuccessful<br />";
}
else
{
	$sql="INSERT INTO logininfo (loginname, password) VALUES ('$_POST[registername]','$_POST[registerpassword]')";
	echo "Registration Successful<br />";
}

#mysql_query("DELETE FROM logininfo WHERE loginname=''");
#mysql_query("DELETE FROM logininfo WHERE password=''");

if (!mysql_query($sql,$connection))
	{
	die('Error: ' . mysql_error());
	}
$result = mysql_query('SELECT * FROM logininfo',$connection); 
$rownumbers = mysql_num_rows($result);

echo '<div id="table" style="float:left;">';
echo "<table border='1'>
<tr>
<th>LoginName</th>
<th>Password</th>
</tr>";
if ($rownumbers)
	{
	echo "Login found";
	echo "$rownumbers Rows\n";
	while ($row = mysql_fetch_array($result))
	{
	echo "<tr>";
	echo "<td>" . $row['loginname'] . "</td>";	
	echo "<td>" . $row['password'] . "</td>";	
	echo "</tr>";
	}
	echo "</table>";
	echo "</div>";
	}
else
	{
	echo "Login not found";
	}

mysql_close($connection);
?>
</body>
</html>
