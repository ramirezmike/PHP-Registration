<?php
	
	session_start();
	session_regenerate_id();

	$connection = mysql_connect("localhost","root") or die(mysql_error());
	if (!mysql_select_db("db_users", $connection))
	{
		mysql_query("CREATE DATABASE db_users", $connection);
	}
	mysql_select_db("db_users", $connection) or die(mysql_error());

	require("functions.php");
?>
