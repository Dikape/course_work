<html>
<head>
	<title></title>
</head>
<body>


<p id="nav_name">Додати матеріали до курсу</p>
<div id="register_field_left">
	<form method="post" enctype="multipart/form-data">
		Назва матеріалу :</p><input type="text" class="textbox1" name="task_laba_name" value = "" > <br><br>
		Опис матеріалу : <br>
		<textarea id="textarea1" name="task_laba_description" class="ggrtgrt" rows="8" cols="50"></textarea><br>
		Прикріпити файл: <input name="filename" type="file" ><br><br>
		<input type="submit" value="Підтвердити" name="add_new_resource" id="submit_button">	
		</form>
	</form>
</div>

	<?php 
	$charrus=mysql_query("set names 'cp1251'");
	if ($_POST['add_new_resource'])
	{
		
		$my_description = $_POST['task_laba_description'];
		$my_name = $_POST['task_laba_name'];
		$cur_id = $_GET['id_course'];
		
		if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {
	    	$fule_name = $_FILES['filename']['name'];
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
	    	
		    $filename = $fule_name;
		    $_FILES['userfile']['tmp_name'] = $row['id'];
		   
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/resources/".$filename);
	    } 
		$query_insert_pract = mysql_query("INSERT INTO resource(description, name, id_subject, file) 
			VALUES ('$my_description', '$my_name', '$cur_id', '$fule_name')");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_course&course_id='.$cur_id.'"
        	</script>';
	}

	?>


</body>
</html>