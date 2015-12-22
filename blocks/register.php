<html>
<head>
<title>Registration</title>
</head>

<body>

<div id="register_form">
<p id="nav_name">Реєстрація</p>
	<div id="register_field_left">
		<form method="post">
			Ім'я (обов'язково) :<br> <input type="text" class="textbox1" name="user_name" value = "<?php echo $_POST['user_name'] ?>" > <br><br>
			Прізвище (обов'язково) :<br> <input type="text" class="textbox1" name="surname" value = "<?php echo $_POST['surname'] ?>" > <br><br>
			E-mail :<br> <input type="text" class="textbox1" name="mail" value = "<?php echo $_POST['mail'] ?>" ><br><br>
			Посада :<br> 
			<select name="position" size="1" class="textbox2">
				<option value="student">Студент</option>
				<option value="teacher">Викладач</option>
			</select>
			<br><br>
			Login :<br> <input type="text" class="textbox1" name="login" value = "<?php echo $_POST['login'] ?>" > <br><br>
			
			Пароль :<br> <input type="password" class="textbox1" name="l_password" value = "<?php echo $_POST['l_password'] ?>" ><br><br>
			Підтвердження пароля :<br> <input type="password" class="textbox1" name="r_password" value = "<?php echo $_POST['r_password'] ?>" ><br><br>
			<input type="submit" value="Підтвердити" name="submit" id="submit_button">
		</form>
		<?php 
			include 'Blocks/db.php';
			include 'Blocks/functions.php';
			$charrus=mysql_query("set names 'cp1251'");
			$name = $_POST['user_name'];
			$surname = $_POST['surname'];
			$mail = $_POST['mail'];
			$login = $_POST['login'];
			$l_password = $_POST['l_password'];
			$r_password = $_POST['r_password'];

			if ($_POST['position'] == "student")
			{
				$position = "Студент";
				$type = 1;
			}
			else
			{
				$position = "Викладач";
				$type = 2;
			}
			


			$checking_pass = pass($l_password, $r_password);
			$checking_nsm = nsm($name, $surname, $login);
			$checking_mail = my_mail($mail);

			if ($checking_pass == true and $checking_nsm == true and $checking_mail==true)		
			{
				echo "Вітаємо ви були зареєстровані на сайті!";
				$query = mysql_query("INSERT INTO users(login, mail, name, surname, password, position, type) VALUES ('$login', '$mail', '$name', '$surname', '$l_password', '$position', '$type' )");
			
			};
			
			
					
		?>
	</div>
	<div id="register_field_right">
		<?php
			if ($_POST['submit'])
			{
				if ($checking_pass == false or $checking_nsm == false or $checking_mail==false)
				{
					echo '<p id="register_error_title">Вииникли помилки при реєстрації</p>';						
					echo '<p id="register_error">';
					$checking_pass = pass($l_password, $r_password);
					$checking_nsm = check_nsm($name, $surname, $login);
					$checking_mail = my_mail($mail);
					if ($checking_pass == false)
					{
						echo "Поля з паролем мають бути заповненні.<br>";
						echo "Пароль має містити щонайменше 6 символів.<br>";
						echo "Паролі не співпадають.<br>";
						
					}
				
						
					if ($checking_mail == false)
						echo "Не правильно вказано E-mail.<br>";
					echo '</p>';
				}
				
			}
		?>
	
	</div>
	</div>
</body>
</html>