<html>
<head>
	<title></title>
</head>
<body>

<?php
	$charrus=mysql_query("set names 'cp1251'");
	if($_GET['id_laba'])
		$current_laba = $_GET['id_laba']; 

	$query_get_laba_name = mysql_query("SELECT * FROM tasks WHERE id = '$current_laba'");
	$row_laba_name = mysql_fetch_array($query_get_laba_name);
	$current_laba_name = $row_laba_name['name'];
?>
<p id="nav_name"><?php echo $current_laba_name; ?></p>
<div id="content_writing_style">
	<?php 
	$user_in = $_SESSION['user_id'];
	$user_now = $_SESSION['user_id'];
	$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
	$row_inform_user = mysql_fetch_array($query_user_inform);

	$studnt_id = $_GET['id_student'];
	$m_mark = $_POST['laba_mark'];

	$q_get_mark = mysql_query("SELECT mark FROM mark_task WHERE id_task='$current_laba' and id_user='$studnt_id'");
	$row_get_mark = mysql_fetch_array($q_get_mark);
	
	$student_get_mark = mysql_query("SELECT mark FROM mark_task WHERE id_task='$current_laba' and id_user='$user_in'");
	$student_get_mark = mysql_fetch_array($student_get_mark);
	$stud_mark = $student_get_mark['mark'];
	echo '<div id="pract_task_descr">';
	echo '<font id="pract_title">Умова завдання :</font><br><font id="laba_content">'.$row_laba_name['description'].'</font><br>';
	echo '<font id="pract_title">Дата здачі : </font><font id="laba_content">'.$row_laba_name['date'].'</font><br>';
	echo '<font id="pract_title">Максимальна оцінка : </font><font id="laba_content">'.$row_laba_name['max_mark'].'</font><br>';
	if ($row_inform_user['type'] == 1)
		echo '<font id="pract_title">Ваша оцінка : </font><font id="laba_content">'.$stud_mark.'</font><br>';
	if ($row_inform_user['type'] == 1)
	{
		$labka_id = $_GET['id_laba'];
		$user_id = $_SESSION['user_id'];
		$query_get_report = mysql_query("SELECT * FROM report WHERE id_task='$labka_id' and id_user='$user_id' ");
		$number_rows_report = mysql_num_rows($query_get_report);
		$row_report = mysql_fetch_array($query_get_report);
		if ($number_rows_report >= 1) 
		{
			$name_file2 = $row_report['report'];

             
              
			echo '<font id="pract_title">Ваш звіт : </font><a href="/documents/reports/'.$name_file2.'"> '.$row_report['report'].'</a><br><br>';
			echo '<form method="post" enctype="multipart/form-data">';
			echo 'Прикріпити новий звіт: <input name="filename" type="file" >';
			echo '<input type="submit" value="Підтвердити" name="update_zvit" id="mark_button">';
			echo '</form>';
		}
		else 
		{
			echo '<form method="post" enctype="multipart/form-data">';
			echo '<font id="qaze">'; echo 'Прикріпити звіт: <input name="filename" type="file" ></font>';
			echo '<input type="submit" value="Підтвердити" name="add_zvit" id="mark_button">';
			echo '</form>';
		}
	}
	if ($row_inform_user['type'] == 2)
	{
		$labka_id = $_GET['id_laba'];
		$sts_id = $_GET['id_student'];
		$query_get_report_teacher = mysql_query("SELECT * FROM report WHERE id_task='$labka_id' and id_user='$sts_id' ");
		$number_rows_report_teacher = mysql_num_rows($query_get_report_teacher);
		$number_rows_report_teacher = mysql_fetch_array($query_get_report_teacher);
		if ($number_rows_report_teacher >= 1) 
		{
			$name_file2 = $number_rows_report_teacher['report'];
			
             
              
			echo '<font id="pract_title">Звіт студента : </font><a href="/documents/reports/'.$name_file2.'"> '.$number_rows_report_teacher['report'].'</a><br><br>';
		}

		if ($row_get_mark['mark'] >= 1)
		{
			$marc = $row_get_mark['mark'];
			echo  '<font id="pract_title">Ви поставили оцінку : </font>'.$marc.'';
			echo '<form method="post">';
				echo '<font id="pract_title">Поставити нову оцінку : </font><input type="text" class="mark_field" name="laba_mark" value = "" >';
				echo '	<input type="submit" name= "update_put_mark" value="Поставити" id="mark_button">';
			echo '</form>';
		}
		else 
		{
			echo '<form method="post">';
				echo '<font id="pract_title">Поставити оцінку : </font><input type="text" class="mark_field" name="laba_mark" value = "" >';
				echo '	<input type="submit" name= "put_mark" value="Поставити" id="mark_button">';
			echo '</form>';
		}
	}
	echo '</div>';
	?>
	<?php 
	$user_in = $_SESSION['user_id'];
	$user_now = $_SESSION['user_id'];
	$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
	$row_inform_user = mysql_fetch_array($query_user_inform);

	if ($_POST['put_mark'])
	{
		$studnt_id = $_GET['id_student'];
		$m_mark = $_POST['laba_mark'];
		$quey_insert_mark = mysql_query("INSERT INTO mark_task(id_task, id_user, mark) 
			VALUES ('$current_laba', '$studnt_id', '$m_mark')");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_laba&id_laba='.$current_laba.'&id_student='.$studnt_id.'"
        	</script>';
	}

	if ($_POST['update_put_mark'])
	{
		$studnt_id = $_GET['id_student'];
		$_new_mark = $_POST['laba_mark'];
		$quey_insert_mark = mysql_query("UPDATE mark_task set mark='$_new_mark'
			WHERE id_user='$studnt_id' and id_task='$current_laba'");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_laba&id_laba='.$current_laba.'&id_student='.$studnt_id.'"
        	</script>';

	}

		?>



	<?php 
	

	if ($_POST['add_zvit'])
	{
		if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {
	    	$fule_name = $_FILES['filename']['name'];
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
	    	//$query = mysql_query("UPDATE laba SET laba = '$fule_name' WHERE id_course='$cur_course'");
		    /*$filename = $cur_course.".".$expansion;*/
		    $filename = $fule_name;
		    $_FILES['userfile']['tmp_name'] = $row['id'];
		    //echo $_FILES['userfile']['name'];
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/reports/".$filename);
	    } 
		$labka_id = $_GET['id_laba'];
		$user_id = $_SESSION['user_id'];
		$query_insert_report = mysql_query("INSERT INTO report(report, id_task, id_user) 
			VALUES ('$fule_name', '$labka_id', '$user_id')");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_laba&id_laba='.$current_laba.'&id_student='.$studnt_id.'"
        	</script>';
	}

	if ($_POST['update_zvit'])
	{
		if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {
	    	$fule_name = $_FILES['filename']['name'];
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
	    	//$query = mysql_query("UPDATE laba SET laba = '$fule_name' WHERE id_course='$cur_course'");
		    /*$filename = $cur_course.".".$expansion;*/
		    $filename = $fule_name;
		    $_FILES['userfile']['tmp_name'] = $row['id'];
		    //echo $_FILES['userfile']['name'];
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/reports/".$filename);
	    } 
		$labka_id = $_GET['id_laba'];
		$user_id = $_SESSION['user_id'];
		$query_insert_report = mysql_query("UPDATE report set report='$fule_name' 
			WHERE id_task='$labka_id' and id_user='$user_id'");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_laba&id_laba='.$current_laba.'&id_student='.$studnt_id.'"
        	</script>';
	}

	?>

</div>




</body>
</html>