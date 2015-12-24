<html>
<head>
	<title></title>
</head>
<body>


<p id="nav_name">Добавити нове завдання</p>
<div id="content_writing_style">
	
	Для того, щоб добавити нове завдання спочатку виберіть тип завдання, яке ви хоче добавити.
	Наразі ви можете добавити 3 типи завдань : <br>
	1) Завдання "Практична робота". <br>
	2) Завдання "Лабараторна робота".<br>
	
	<p id="task_type_title">"Практична робота"</p>
	<p id="task_type_dexcription">Це такий, тип завдання, де студент отримує текстову умову , та здає виконане завдання викладачу очно. </p>


	<br><p id="task_type_title">"Лабараторна робота"</p>н
	<p id="task_type_dexcription">Це такий, тип завдання, де студент отримує текстову умову , та здає виконане завдання викладачу у вигляді звіту. </p>

	

	<br><p id="treuityuei">Оберіть тип завдання, яке ви б хотіли добавити на курс : </p>
		<form method="post">
			<select name="type" size="1" id="type_add_task">
				<option value="pract">Практична робота</option>
				<option value="laba">Лабараторна робота</option>
				
			</select>
			<br><br><input type="submit" value="Далі" name="next_button" id="next_button">
		</form>


	<?php 
		$charrus=mysql_query("set names 'cp1251'");
		if($_POST['next_button']) 
		{
			if ($_GET['id_course'])
				$some_id = $_GET['id_course'];
			if ($_POST['type'] == "pract")
				$type = 1;
			if ($_POST['type'] == "laba")
				$type = 2;
			
			
			echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=add_current_task&type='.$type.'&course_id='.$some_id.'"
        	</script>';

		}
	?>

</div>




</body>
</html>