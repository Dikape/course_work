<?php session_start();
?>

<html>

<head>
<title>Login</title>
</head>

<body>
	<p id="nav_name">Вхід в систему</p>
	<div id="content_writing_style">
		Для входу  в систему введіть свій Login та пароль вказаний при реєстрації. <br><br>
		<form method="post">
			Логін :<br> <input type="text" class="textbox1" name="login" value = "<?php echo $_POST['login'] ?>" > <br><br>
			Пароль :<br> <input type="password" class="textbox1" name="password" value = "<?php echo $_POST['password'] ?>" ><br><br>
				<input type="submit" name= "submit" value="Увійти" id="login_button">
		</form>
		<?php
			$charrus=mysql_query("set names 'cp1251'");			
			if ($_SESSION['in']==1)
			{
				echo "Ви увійшли в систему!<br>";
				echo '<a href="index.php?sidebar=profile"><br>Перейти у свій профіль.</a>';	
			}
			if ($_POST['submit'] and $_SESSION['in']!=1)
			{
				$login = $_POST['login'];
				$password = $_POST['password'];
				$query = mysql_query("SELECT * FROM users WHERE login = '$login' AND password = '$password'");
				
				$row = mysql_fetch_array($query);
				$numb_rows = mysql_num_rows($query);
				
				if ($numb_rows !=0)
				{	
					
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['login'] = $row['login'];
					$_SESSION['user_log_in'] = $row['type'];
					$_SESSION['in'] = 1;
					
					echo "Ви увійшли в систему!<br>";
					
					echo '<a href="index.php?sidebar=profile"><br>Перейти у свій профіль.</a>';	

					echo '<script type="text/javascript">
           				window.location = "index.php?sidebar=profile"
        			</script>';
										
				}
				else
					echo "<br>Логін або пароль були введені неправильно.";
				
			}
			
			
		?>









	</div>





</body>

<html>