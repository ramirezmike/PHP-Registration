<?php
function myHash($input)
{
	return hash('sha512', $input);
}

function logout()
{
	session_destroy();
}

function register($name,$pass,$connection)
{
	if ($name == '' || $pass == '')
	{
		echo "Error: Blank fields";
	}
	else
	{
		$hashpass = myHash($pass);
		$sql="INSERT INTO logininfo (loginname, password) VALUES ('$name','$hashpass')";
		mysql_query($sql,$connection) or die(mysql_error());
		echo "Registration Successful<br />";
	}
}

function delete($user)
{
	if ($user != 1)
	{
		mysql_query("DELETE FROM logininfo WHERE userID='$user'");
	}
}

function show_admin_table($user)
{
	echo '<div id="table" style="float:left;">';
	echo "<table border='1'>
		<tr>
		<th>UserID</th>
		<th>LoginName</th>
		<th>Password</th>
		</tr>";
	while ($row = mysql_fetch_array($user))
	{
		echo "<tr>";
		echo "<td>" . $row['userID'] . "</td>";
		echo "<td>" . $row['loginname'] . "</td>";
		echo "<td>" . $row['password'] . "</td>";
		echo "</tr>";	
	}
	echo "</table>			
		</div>
		<br />
		<Logged in as Admin>
		<form action='main.php' method='post'>
		Delete by userID <br />
		<input type='text' name='deleteuser' />
		<br />
		<input type='submit' name='Delete' value='Delete' />
		</form>";
}

function show_table($user)
{
	echo "<div id='table'>
		<table border='1'>
			<tr>
			<th>UserID</th>
			<th>LoginName</th>
			<th>Password</th>
			</tr>";
	while ($row = mysql_fetch_array($user))
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
	echo "</table></div>";
}
?>
