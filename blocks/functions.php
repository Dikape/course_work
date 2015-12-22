<?php

include 'blocks/db.php';




function check_log($login)
{
	$error = false;
	$query = mysql_query("SELECT * FROM users WHERE login = '$login'");
	$row = mysql_fetch_array($query);
	$numb_rows = mysql_num_rows($query);
	if ($numb_rows != 0) {echo "Користувач з таким логіном вже існує.<br>"; $error=true;}
	if($error==false)
		return true;
}
function check_nsm($name, $surname, $login)		
{
	$error = false;
	if($name == null){ echo  "Поле Ім'я має бути заповненим.<br>"; $error=true;}
	$query = mysql_query("SELECT * FROM users WHERE login = '$login'");
	$row = mysql_fetch_array($query);
	$numb_rows = mysql_num_rows($query);
	if ($numb_rows != 0) {echo "Користувач з таким логіном вже існує.<br>";}
	if($surname == null){ echo  "Поле Прізвище має бути заповненим.<br>";$error=true;}
	if($login == null){ echo  "Поле Login має бути заповненим.<br>";$error=true;}
	if($error==false)
		return true;

}

function pass($l_password, $r_password)
{
	if ($l_password==null or $r_password==null)
		echo "";
	else 
	{
		if (strlen($l_password) < 6)
			echo "";
		else 
		{
			if ($l_password != $r_password)
				echo "";
			else return true;
		}
	}
}

function my_mail($my_mail)
{
	if (filter_var($my_mail, FILTER_VALIDATE_EMAIL))
		return true;
	else
		echo "";
}

function nsm($name, $surname, $login)		//check name, surname, mail
{
	$error = false;
	if($name == null){ echo  ""; $error=true;}
	if($surname == null){ echo  "";$error=true;}
	if($login == null){ echo  "";$error=true;}
	$query = mysql_query("SELECT * FROM users WHERE login = '$login'");
	$row = mysql_fetch_array($query);
	$numb_rows = mysql_num_rows($query);
	if ($numb_rows != 0) {echo ""; $error=true;}
	if($error==false)
		return true;


	
}






?>








