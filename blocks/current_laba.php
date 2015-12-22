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





	if ($row_inform_user['type'] == 1)
	{
		if ($_GET['id_laba'])
			$id_labaice = $_GET['id_laba'];
		$query_get_teach_id = mysql_query("SELECT teacher FROM subjects
			LEFT JOIN tasks ON tasks.id_subject = subjects.id
			WHERE tasks.id='$id_labaice'");
		$some_teach_id = mysql_fetch_array($query_get_teach_id);
		$tt_id = $some_teach_id['teacher'];
	/// або де user.id = викладачу поточного курсу
		$query_get_laba_reply = mysql_query("SELECT laba_reply.reply as 'reply', laba_reply.datetime as 'datetime', users.name as 'name', users.surname as 'surname', users.avatar as 'avatar'
		 FROM laba_reply LEFT JOIN users ON laba_reply.id_user = users.id 
		 WHERE id_laba='$current_laba' and (users.id = '$user_in' or (users.id = '$tt_id' and laba_reply.id_to_user = '$user_in')) 
		 ORDER by datetime ");
		if ($query_get_laba_reply)
		{
			while ($row_get_laba_reply = mysql_fetch_array($query_get_laba_reply))
			{
				echo '<div id="pract_reply_block">';
				echo '<div id="pract_reply_block_avatar">';
				echo '<img src="images/avatar/'.$row_get_laba_reply['avatar'].'.jpg"  alt="" id="comment_avatar" >';
				echo '</div>';
				echo '<div id="pract_reply_block_message">'; echo '<font id="name_surname_comment">';
				echo $row_get_laba_reply['name']." ".$row_get_laba_reply['surname']."<br>"; echo '</font>'; echo '<font id="reply_comment">';
				echo $row_get_laba_reply['reply']; echo '</font><br>';  echo '<font id="reply_datetime">';
				echo $row_get_laba_reply['datetime']; echo '</font>';
				echo '</div>';
				echo '</div>';
			}
		}
		
	}
	if ($row_inform_user['type'] == 2)
	{

		if ($_GET['id_student'])
			$stud_id = $_GET['id_student'];
	/// або де user.id = викладачу поточного курсу
		$query_get_laba_reply = mysql_query("SELECT laba_reply.reply as 'reply', laba_reply.datetime as 'datetime', users.name as 'name', users.surname as 'surname', users.avatar as 'avatar'
		 FROM laba_reply LEFT JOIN users ON laba_reply.id_user = users.id 
		 WHERE id_laba='$current_laba' and ((users.id = '$user_in' and laba_reply.id_to_user = '$stud_id') or users.id = '$stud_id')
		 
		 ORDER by datetime");
		if ($query_get_laba_reply)
		{
			while ($row_get_laba_reply = mysql_fetch_array($query_get_laba_reply))
			{
				echo '<div id="pract_reply_block">';
				echo '<div id="pract_reply_block_avatar">';
				echo '<img src="images/avatar/'.$row_get_laba_reply['avatar'].'.jpg"  alt="" id="comment_avatar" >';
				echo '</div>';
				echo '<div id="pract_reply_block_message">'; echo '<font id="name_surname_comment">';
				echo $row_get_laba_reply['name']." ".$row_get_laba_reply['surname']."<br>"; echo '</font>'; echo '<font id="reply_comment">';
				echo $row_get_laba_reply['reply']; echo '</font><br>';  echo '<font id="reply_datetime">';
				echo $row_get_laba_reply['datetime']; echo '</font>';
				echo '</div>';
				echo '</div>';
			}
		}
		
	}
		?>



	<?php 
	if ($_POST['laba_reply_submit'])
	{
		if ($_GET['id_student'])
			$njgr = $_GET['id_student'];
		else $njgr = 0;
		$user_in = $_SESSION['user_id'];
		$my_laba_reply = $_POST['task_laba_description'];
		$today = date("Y-m-d H:i:s");
		$mysql_query_insert_laba_reply = mysql_query("INSERT INTO laba_reply(id_user, id_laba, reply, datetime, id_to_user) 
			VALUES ('$user_in', '$current_laba', '$my_laba_reply', '$today', '$njgr')");
		$studnt_id = $_GET['id_student'];
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_laba&id_laba='.$current_laba.'&id_student='.$studnt_id.'"
        	</script>';

	}

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
			WHERE id_laba='$labka_id' and id_user='$user_id'");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_laba&id_laba='.$current_laba.'&id_student='.$studnt_id.'"
        	</script>';
	}

	?>

</div>




</body>
</html>