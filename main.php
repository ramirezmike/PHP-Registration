<html>
<body>

<?php
$connection = mysql_connect("localhost","root");
if (!$connection)
	{
	die( mysql_error());
	}

mysql_select_db("db_users", $connection);

mysql_query("DELETE FROM logininfo WHERE loginname='$_POST[deleteuser]'");

$loginRow=mysql_query("SELECT * FROM logininfo WHERE loginname='$_POST[loginname]'");
$nameForCheck=mysql_fetch_array($loginRow);

if ($nameForCheck['password'] == $_POST['password']) {

$result = mysql_query('SELECT * FROM logininfo',$connection); 
$rownumbers = mysql_num_rows($result);

if ($_POST['loginname'] == '' or $_POST['password'] == '')
{
	echo "Error: Blank fields";
}
else if ($rownumbers )
	{
	echo "Login found";
	echo "$rownumbers Rows\n";
	echo '<div id="table" style="float:left;">';
	echo "<table border='1'>
	<tr>
	<th>LoginName</th>
	<th>Password</th>
	</tr>";
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
echo "<form action='main.php' method='post'>";
echo "Delete User Name<br />";
echo "<input type='text' name='deleteuser' /><br />";
echo "<input type='submit' value='Delete' />";
echo "</form>";
}
mysql_close($connection);
?>
</body>
</html>
