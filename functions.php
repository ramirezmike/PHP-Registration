<?php
function myHash($input)
{
	return hash('sha512', $input);
}

function login($connection)
{
	$adminRow=mysql_fetch_array(mysql_query("SELECT * FROM logininfo WHERE userID=1"));
	$loginRow=mysql_query("SELECT * FROM logininfo WHERE loginname='$_SESSION[loginname]'");
	$nameForCheck=mysql_fetch_array($loginRow);


	if ($nameForCheck['password'] == myHash($_SESSION['password']))
	{
		  $result = mysql_query('SELECT * FROM logininfo',$connection);
		  $rownumbers = mysql_num_rows($result);

		  if ($_SESSION['loginname'] == $adminRow['loginname'])
		  {
			  $_SESSION['loggedin'] = 1;
			  $_SESSION['admin'] = 1;
			  #show_admin_table($result);
			  return 1;
		  }
		  else if ($rownumbers )
		  {
			  $_SESSION['loggedin'] = 1;
			  #show_table($result);
			  return 1;
		  }

	}
	return 0;
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
