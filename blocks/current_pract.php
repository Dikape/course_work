<html>
<head>
	<title></title>
</head>
<body>

<?php
	$charrus=mysql_query("set names 'cp1251'");
	if($_GET['id_pract'])
		$current_pract = $_GET['id_pract']; 

	$query_get_pract_name = mysql_query("SELECT * FROM tasks WHERE id = '$current_pract'");
	$row_pract_name = mysql_fetch_array($query_get_pract_name);
	$current_pract_name = $row_pract_name['name'];
?>
<p id="nav_name"><?php echo $current_pract_name; ?></p>
<div id="content_writing_style">
	<?php 
	$user_in = $_SESSION['user_id'];
	$user_now = $_SESSION['user_id'];
	$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
	$row_inform_user = mysql_fetch_array($query_user_inform);

	$studnt_id = $_GET['id_student'];
	$m_mark = $_POST['pract_mark'];

	$q_get_mark = mysql_query("SELECT mark FROM mark_task WHERE id_task='$current_pract' and id_user='$studnt_id'");
	$row_get_mark = mysql_fetch_array($q_get_mark);
	
	$student_get_mark = mysql_query("SELECT mark FROM mark_task WHERE id_task='$current_pract' and id_user='$user_in'");
	$student_get_mark = mysql_fetch_array($student_get_mark);
	$stud_mark = $student_get_mark['mark'];
	echo '<div id="pract_task_descr">';
	echo '<font id="pract_title">����� �������� :</font><br><font id="pract_content">'.$row_pract_name['description'].'</font><br>';
	echo '<font id="pract_title">���� ����� : </font><font id="pract_content">'.$row_pract_name['date'].'</font><br>';
	echo '<font id="pract_title">����������� ������ : </font><font id="pract_content">'.$row_pract_name['max_mark'].'</font><br>';
	if ($row_inform_user['type'] == 1)
		echo '<font id="pract_title">���� ������ : </font><font id="pract_content">'.$stud_mark.'</font><br>';
	if ($row_inform_user['type'] == 2)
	{
		if ($row_get_mark['mark'] >= 1)
		{
			$marc = $row_get_mark['mark'];
			echo  '<font id="pract_title">�� ��������� ������ : </font>'.$marc.'';
			echo '<form method="post">';
				echo '<font id="pract_title">��������� ���� ������ : </font><input type="text" class="mark_field" name="pract_mark" value = "" >';
				echo '	<input type="submit" name= "update_put_mark" value="���������" id="mark_button">';
			echo '</form>';
		}
		else 
		{
			echo '<form method="post">';
				echo '<font id="pract_title">��������� ������ : </font><input type="text" class="mark_field" name="pract_mark" value = "" >';
				echo '	<input type="submit" name= "put_mark" value="���������" id="mark_button">';
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
		$m_mark = $_POST['pract_mark'];
		$quey_insert_mark = mysql_query("INSERT INTO mark_task(id_task, id_user, mark) 
			VALUES ('$current_pract', '$studnt_id', '$m_mark')");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_pract&id_pract='.$current_pract.'&id_student='.$studnt_id.'"
        	</script>';
	}

	if ($_POST['update_put_mark'])
	{
		$studnt_id = $_GET['id_student'];
		$_new_mark = $_POST['pract_mark'];
		$quey_insert_mark = mysql_query("UPDATE mark_task set mark='$_new_mark'
			WHERE id_user='$studnt_id' and id_task='$current_pract'");
		echo '<script type="text/javascript">
           		window.location = "index.php?sidebar=current_pract&id_pract='.$current_pract.'&id_student='.$studnt_id.'"
        	</script>';

	}

		?>
		

</div>

</body>
</html>