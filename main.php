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

		if ($_SESSION['loginname'] == '' or $_SESSION['password'] == '')
		{
			echo "Error: Blank fields";
		}

		else if ($_SESSION['loginname'] == $adminRow['loginname'])
		{
			show_admin_table($result);
		}
		else if ($rownumbers )
		{
			echo "Login found<br /";
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
				if ($row['loginname'] == $_SESSION['loginname'] && $row['password'] == myHash($_SESSION['password'])) 
				{
					echo "<td>" . $row['password'] . "</td>";	
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
		}

	}

	else 
	{
		echo "Login Unsuccesful";
	}

	mysql_close($connection);

	require("footer.php");
?>
