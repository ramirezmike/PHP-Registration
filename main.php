<html>
<body>

<?php
$connection = mysql_connect("localhost","root");
if (!$connection)
	{
	die( mysql_error());
	}

mysql_select_db("db_users", $connection);

$loginRow=mysql_query("SELECT * FROM logininfo WHERE loginname='$_POST[loginname]'");
$nameForCheck=mysql_fetch_array($loginRow);
echo $nameForCheck['loginname'];
echo $nameForCheck['password'];
echo $_POST["loginname"];
echo $_POST["password"];

if ($nameForCheck['password'] == $_POST['password']) {

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

}

else {
	echo "Login Unsuccesful";
}
if ($_POST['loginname'] == 'admin')
{
echo "<br />";
echo "Logged in as Admin";
}
mysql_close($connection);
?>
</body>
</html>
