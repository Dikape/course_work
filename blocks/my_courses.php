<html>
<head>
	<title></title>
</head>
<body>
<script>
	function toggle(el) {
	   el.style.display = (el.style.display == 'none') ? '' : 'none'
	}
</script>
<p id="nav_name">�� �����</p>
<div id="content_writing_style">
	<div id="courses_list">
	<?php 
	$charrus=mysql_query("set names 'cp1251'");
	$user_now = $_SESSION['user_id'];
	$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
	$row_inform_user = mysql_fetch_array($query_user_inform);
	



	if ($row_inform_user['type'] == 1)
	{ 
		$student_id = $row_inform_user['id'];
		
		$query_get_arr_course = mysql_query("SELECT id_subject FROM user_subject 
			WHERE id_user = '$student_id'");
		$rows = array();
		while($row = mysql_fetch_array($query_get_arr_course))
		{
		    $rows[] = $row['id_subject'];
		}		
		$join_rows = join(',',$rows);
		
		$query_get_student_course= mysql_query("SELECT distinct subjects.name as 'cours_name', subjects.id, users.name, users.surname, user_subject.id_user FROM subjects	
			LEFT JOIN users ON subjects.teacher = users.id
			LEFT JOIN user_subject ON user_subject.id_user = users.id
			WHERE subjects.id IN ($join_rows)");
		echo "������ ����� ����� : ";
		if ($query_get_student_course)
		{
			
			while ($row_student_course = mysql_fetch_array($query_get_student_course))
			{	
				//print ($row_student_course['id']);
				$sub_id = $row_student_course['id'];
				$query_ger_registe_on_course = mysql_query("SELECT count(*) as total from user_subject
				WHERE id_subject = '$sub_id'");
				$data = mysql_fetch_assoc($query_ger_registe_on_course);
				echo '<div id="curr_course_output">';
				echo '<p id="curr_course_name"><a href="index.php?sidebar=current_course&course_id='.$row_student_course['id'].'">'.$row_student_course['cours_name'].'</a><br></p>';
				echo "<p id='curr_course_inform'>��������, ���� ���� ���� : ".$row_student_course['name']." ".$row_student_course['surname'];echo "<br>";
				echo "����� ������������� �� ���� : ".$data['total']; echo "<br>";
			
				echo '</div>';
			}
		}
		else 
			echo '�� �� � ���������, ������� �����.'; 
	}
	else if ($row_inform_user['type'] == 2) 
	{
		
		$teacher_id = $row_inform_user['id'];
		echo "������ ����� ����� : ";
		$query_get_teacher_course= mysql_query("SELECT subjects.name as 'cours_name', subjects.id,  users.name, users.surname FROM subjects
			LEFT JOIN users ON subjects.teacher = users.id
			WHERE subjects.teacher = '$teacher_id'");
		
		
		if ($query_get_teacher_course) 
		{
			while ($row_teacher_course = mysql_fetch_array($query_get_teacher_course))
			{
				$sub_id = $row_teacher_course['id'];
				$query_ger_registe_on_course = mysql_query("SELECT count(*) as total from user_subject 
				WHERE id_subject = '$sub_id'");
				$data = mysql_fetch_assoc($query_ger_registe_on_course);
				echo '<div id="curr_course_output">';
				echo '<p id="curr_course_name"><a href="index.php?sidebar=current_course&course_id='.$row_teacher_course['id'].'">'.$row_teacher_course['cours_name'].'</a><br></p>';
				echo "<p id='curr_course_inform'>��������, ���� ���� ���� : ".$row_teacher_course['name']." ".$row_teacher_course['surname'];echo "<br>";
				echo "����� ������������� �� ���� : ".$data['total']; echo "<br>";
				echo '<button id="news_button_lol">
				<a href = "index.php?sidebar=my_courses&delete_course='.$sub_id.'">��������</a>
				</button>';
				echo '</div>';
				
			}

			if ($_GET['delete_course'])
			{
					$delete_id = $_GET['delete_course'];
					$delete_news_query = mysql_query("DELETE  FROM subjects WHERE id='$delete_id'");
					echo '<script>window.location.href = "index.php?sidebar=my_courses";</script>';	
				}
							
			
			
			
		}
		else 
			echo "����� �� �� �������� ������ �����";
	}
	?>

	</div>



	<div id="courses_menu">
		<div class="gadget"> 
      <div class="clr"></div>
        <ul class="ex_menu">
        	<?php 

        		if ($row_inform_user['type'] == 2) 
				{
					
        	?>
      		<p id="title_video">�����</p>
      	  
          <!---             ����� ���� 2  -->
          <li><a onclick="toggle(hidden_content2)" id="just_pointer">����� ����</a><br />
            ��������� ������ �����</li>
            <div id="hidden_content2" style="display: none;">
              <form method="post">
                <p id="text_video_menu">������ ����� ������ ����� :<br></p>
                <input type="text" class="video_search" name="new_course_name" value = "" ><br>
                <input type="submit" value="��������" name="submit_new_course" id="submit_button2">
              </form>
            </div>        
		</ul>
      <?php } 
      else if ($row_inform_user['type'] == 1)
      {
      ?>
      <p id="title_video">�����</p>
      	  
          <!---             ����� ���� 2  -->
          
          
         <li><a href="index.php?sidebar=all_global_courses">��������/³���������</a><br />
            ����� ��������� ������ ����������� �����
			³��������� �� ��������� �����</li>
      <?php } 
      ?>

    </div>
  </div>
  <?php if ($row_inform_user['type'] == 0)
      	echo '<font id="just_error">� ��� �� �� ��������� ����������� �����.</font>'; ?>
</div>










	<?php 

	if ($_POST['submit_new_course'])
	{
		$new_course_n = $_POST['new_course_name'];
		if ($_POST['new_course_name'])
		{
			$query_new_course = mysql_query("INSERT INTO subjects(name, teacher) VALUES ('$new_course_n', '$user_now')");
			echo '<script>window.location.href = "index.php?sidebar=my_courses";</script>';	
		}

	}
	if ($_POST['delete_some_course'])
	{
		if (/*$_POST['delete_course_password'] and*/ $_POST['delete_course_name'])
		{
			$dd_password = $_POST['delete_course_password'];
			$nn_name = $_POST['delete_course_name'];
			//$query_delete_some_course = mysql_query("DELETE FROM subjects WHERE id='$dd_password' and name='$nn_name'");
			$query_delete_some_course = mysql_query("DELETE FROM subjects WHERE name='$nn_name'");
			echo '<script>window.location.href = "index.php?sidebar=my_courses";</script>';	
		}
	}




	?>



</div>




</body>

</html>