<?php 
	session_start(); 
	session_regenerate_id();
?>
<html>
	<body>

		<a href="index.php">Index</a></br>

<?php

	function myHash($input) 
{
		return hash('sha512', $input);
}

	$connection = mysql_connect("localhost","root");
		if (!$connection)
		{
				die( mysql_error());
		}
	mysql_select_db("db_users", $connection);

	$adminRow=mysql_fetch_array(mysql_query("SELECT * FROM logininfo WHERE userID=1"));
	$loginRow=mysql_query("SELECT * FROM logininfo WHERE loginname='$_SESSION[loginname]'");
	$nameForCheck=mysql_fetch_array($loginRow);

	if (!$_POST[deleteuser] == 1) 
	{
		mysql_query("DELETE FROM logininfo WHERE userID='$_POST[deleteuser]'");
	}

	if ($nameForCheck['password'] == myHash($_SESSION['password'])) 
	{
		$result = mysql_query('SELECT * FROM logininfo',$connection); 
		$rownumbers = mysql_num_rows($result);
		if ($_SESSION['loginname'] == '' or $_SESSION['password'] == '')
		{
			echo "Error: Blank fields";
		}
		else if ($_SESSION['loginname'] == $adminRow['loginname'])
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
				if ($row['password'] == myHash($_SESSION['password'])) 
				{
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

	else 
	{
		echo "Login Unsuccesful";
	}

	mysql_close($connection);
?>
	</body>
</html>
