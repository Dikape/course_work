<?php
$dblocation = 'localhost';
$dbuser = 'Thor';         
$dbpasswd = '1111';           
$dbcnx = mysql_connect($dblocation,$dbuser,$dbpasswd);
$db = 'thor';
if (!$dbcnx || !mysql_select_db($db, $dbcnx))
{
	exit(mysql_error());
}
?>