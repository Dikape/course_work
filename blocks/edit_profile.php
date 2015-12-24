<?php session_start();?>

<html>
<head>
<title>Edit profile</title>
</head>



<body>
	<p id="nav_name">Редагувати профіль</p>
	<div id="content_writing_style">
		Для зміни будь-яких даних напишіть необхідні дані в відповідному полі,всі інші поля залишіть пустими .<br>
		
		<div id="get_avatar">
			<br>
			<div class="fileUpload btn btn-primary">
				<form method="post" enctype="multipart/form-data">
		      		
		      		

		      		<br><br>Нове ім'я :<br> <input type="text" class="textbox1" name="user_name" value = "<?php echo $_POST['user_name'] ?>" > <br><br>
					Нове прізвище :<br> <input type="text" class="textbox1" name="surname" value = "<?php echo $_POST['surname'] ?>" > <br><br>
					Новий E-mail :<br> <input type="text" class="textbox1" name="mail" value = "<?php echo $_POST['mail'] ?>" ><br><br>
					Новий Login :<br> <input type="text" class="textbox1" name="login" value = "<?php echo $_POST['login'] ?>" > <br><br>
					
					Для зміни паролю до вашого акаунта, введіть свій поточний пароль, та пароль на який ви хочете його замінити.<br><br>


					Поточний пароль :<br> <input type="password" class="textbox1" name="c_password" value = "<?php echo $_POST['c_password'] ?>" ><br><br>
					Новий пароль :<br> <input type="password" class="textbox1" name="l_password" value = "<?php echo $_POST['l_password'] ?>" ><br><br>
					Підтвердити пароль :<br> <input type="password" class="textbox1" name="r_password" value = "<?php echo $_POST['r_password'] ?>" ><br><br>
					<input type="submit" value="Підтвердити" name="submit" id="submit_button">

		      	</form>
	      	</div>
			<div id="register_field_right1">
	      	<?php
			
			//$row_inform_user = mysql_fetch_array;
			
			$user_now = $_SESSION['user_id'];
			$query_pass = mysql_query("SELEcT * FROM users WHERE id = '$user_now'");
			$row_pass = mysql_fetch_array($query_pass);
			include 'Blocks/functions.php';
		
			
	      	if ($_POST['submit'] )
	      	{
	      		$charrus=mysql_query("set names 'cp1251'");
	      		$name = $_POST['user_name'];
				$surname = $_POST['surname'];
				$mail = $_POST['mail'];
				$login = $_POST['login'];
				$c_password = $_POST['c_password'];
				$l_password = $_POST['l_password'];
				$r_password = $_POST['r_password'];
				
				



				$checking_pass = pass($l_password, $r_password);
				$checking_nsm = check_log($login);
				$checking_mail = my_mail($mail);


				$user_id  = $_SESSION['user_id'];
				if ($name)	$query = mysql_query("UPDATE users SET name = '$name' WHERE id='$user_id'");
				if ($surname)	$query = mysql_query("UPDATE users SET surname = '$surname' WHERE id='$user_id'");
				if ($mail)	
				{
					//if($cheking_mail == true)
						$query = mysql_query("UPDATE users SET mail = '$mail' WHERE id='$user_id'");
					//else echo"Такий mail невірний";
				}
				if ($login)
				{
					if ($checking_nsm == true)
						$query = mysql_query("UPDATE users SET login = '$login' WHERE id='$user_id'");
					
				}
				if($c_password or ($l_password and $r_password))
				{
					if ($c_password == $row_pass['password'])
						{	
							if ($checking_pass == true)
								
									$query = mysql_query("UPDATE users SET password = '$l_password' WHERE id='$user_id'");
							else 
								echo "Невірний новий пароль";
						}
					else
						echo"Невірний поточний пароль"; 
				}
			};

	      		
			
	      	?>
			</div>
		</div>
		<br>

		




	</div>	
</body>
</html>