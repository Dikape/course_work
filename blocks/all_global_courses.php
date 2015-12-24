<html>
<head>
	<title></title>
</head>
<body>
<p id="nav_name">Всі доступні курси</p>
<div id="content_writing_style">
<!--<script>
	function toggle(el) {
	   el.style.display = (el.style.display == 'none') ? '' : 'none'
	}
</script>-->
	<div id="courses_list">
	<?php 
	$charrus=mysql_query("set names 'cp1251'");
	
	
	$query_get_teacher_course= mysql_query("SELECT distinct subjects.name as 'cours_name', subjects.id, users.name, users.surname FROM subjects
	
	left JOIN users ON subjects.teacher = users.id 
	");
	
	$user_now = $_SESSION['user_id'];
	$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
	$row_inform_user = mysql_fetch_array($query_user_inform);
	
	if ($row_inform_user['type'] == 1)
	{

		while ($row_teacher_course = mysql_fetch_array($query_get_teacher_course))
		{
			$teacher_sub = $row_teacher_course['id'];
			
			$query_ger_registe_on_course = mysql_query("SELECT count(*) as total from user_subject 
			WHERE id_subject = '$teacher_sub'");
			$data = mysql_fetch_assoc($query_ger_registe_on_course);

			$query_entered_course = mysql_query("SELECT id_subject FROM user_subject 
				where id_user='$user_now' and id_subject='$teacher_sub'");



			echo '<div id="curr_course_output">';
			echo '<p id="curr_course_name"><a href="index.php?sidebar=current_course&course_id='.$row_teacher_course['id'].'">'.$row_teacher_course['cours_name'].'</a><br></p>';
			echo "<p id='curr_course_inform'>Викладач, який веде курс : ".$row_teacher_course['name']." ".$row_teacher_course['surname'];echo "<br>";
			echo "Людей зареєстрованих на курсі : ".$data['total']; echo "<br>";
			

			$number_of_rows = mysql_num_rows($query_entered_course);

			if ($number_of_rows >= 1) {
              
			echo '<button class="out_course_button" id="out_course2">
				<a href = "index.php?sidebar=all_global_courses&out_new_course='.$row_teacher_course['id'].'" id="lol">
					<p id="edit_button_text">Відписатися</p></a>
				</button>';
              }
              else
              {
               echo '<button class="enter_course_button" id="enter_course1">
				<a href = "index.php?sidebar=all_global_courses&enter_new_course='.$row_teacher_course['id'].'" id="lol">
					<p id="edit_button_text">Вступити</p></a>
				</button>';
              }
			
			echo '</div>';
		}
	}
	else
	{
		if ($row_inform_user['type'] == 2)
		echo "Викладач не може переглядати інформацію про інші курси. ";
	}



	?>


	</div>
	


	<?php 
	if ($_GET['sidebar'] == "all_global_courses")  
    {
      if ($_GET['enter_new_course']) 
      {
      	$enter_course_user_id = $_SESSION['user_id'];
      	$enter_course_id = $_GET['enter_new_course'];
        $query_insert = mysql_query("INSERT INTO user_subject(id_user, id_subject) VALUES ('$enter_course_user_id', '$enter_course_id')");
        echo '<script type="text/javascript">
    	window.location = "index.php?sidebar=my_courses"
	    </script>';
      }
	  if ($_GET['out_new_course'])
	  {
		$out_course_user_id = $_SESSION['user_id'];
      	$out_subject_id = $_GET['out_new_course'];
		$query_out_of_course = mysql_query("DELETE FROM user_subject WHERE id_user='$out_course_user_id' and id_subject='$out_subject_id' ");
		echo '<script type="text/javascript">
    	window.location = "index.php?sidebar=my_courses"
	    </script>';
	  
	  }
    }


	?>




</div>



</body>
</html>