<html>
<body>

<a href="index.php">Index</a></br>

<?php

function hash($input) {
	return str_rot13(base64_encode(hash('sha512', $input)));
}

function unhash($input) {
	return str_rot13(base64_decode($input));
}

$connection = mysql_connect("localhost","root");
if (!$connection)
	{
	die( mysql_error());
	}

mysql_select_db("db_users", $connection);

$adminRow=mysql_fetch_array(mysql_query("SELECT * FROM logininfo WHERE userID=1"));
if (!$_POST[deleteuser] == 1) {
mysql_query("DELETE FROM logininfo WHERE userID='$_POST[deleteuser]'");
}

$loginRow=mysql_query("SELECT * FROM logininfo WHERE loginname='$_POST[loginname]'");
$nameForCheck=mysql_fetch_array($loginRow);

if ($nameForCheck['password'] == $_POST['password']) {

$result = mysql_query('SELECT * FROM logininfo',$connection); 
$rownumbers = mysql_num_rows($result);
if ($_POST['loginname'] == '' or $_POST['password'] == '')
{
	echo "Error: Blank fields";
}
else if ($_POST['loginname'] == $adminRow['loginname'])
{

echo '<div id="table" style="float:left;">';
echo "<table border='1'>
<tr>
<th>UserID</th>
<th>LoginName</th>
<th>Password</th>
</tr>";
while ($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['userID'] . "</td>";
echo "<td>" . $row['loginname'] . "</td>";	
echo "<td>" . $row['password'] . "</td>";	
echo "</tr>";
}
echo "</table>";
echo "</div>";
echo "<br />";
echo "Logged in as Admin";
echo "<form action='main.php' method='post'>";
echo "Delete by userID <br />";
echo "<input type='text' name='deleteuser' /><br />";
echo "<input type='submit' value='Delete' />";
echo "</form>";
}
else if ($rownumbers )
	{
	echo "Login found<br /";
	echo "$rownumbers Rows\n";
	echo '<div id="table" style="float:left;">';
	echo "<table border='1'>
	<tr>
	<th>UserID</th>
	<th>LoginName</th>
	<th>Password</th>
	</tr>";
	while ($row = mysql_fetch_array($result))
	{
	echo "<tr>";
	echo "<td>" . $row['userID'] . "</td>";
	echo "<td>" . $row['loginname'] . "</td>";	
	if ($row['password'] == $_POST['password']) {
		echo "<td>" . $row['password'] . "</td>";	
	}
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
mysql_close($connection);
?>
</body>
</html>
