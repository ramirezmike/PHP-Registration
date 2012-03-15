<?php
function myHash($input)
{
	return hash('sha512', $input);
}

function logout()
{
	session_destroy();
}
?>
