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
<p id="nav_name">Мої курси</p>
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
		$lol = join(',',$rows);
		
		$query_get_student_course= mysql_query("SELECT distinct subjects.name as 'cours_name', subjects.id, users.name, users.surname, user_subject.id_user FROM subjects	
			LEFT JOIN users ON subjects.teacher = users.id
			LEFT JOIN user_subject ON user_subject.id_user = users.id
			WHERE subjects.id IN ($lol)");
		echo "Список ваших курсів : ";
		if ($query_get_student_course)
		{
			
			while ($row_student_course = mysql_fetch_array($query_get_student_course))
			{
				$aqwr = $row_student_course['id'];
				$query_ger_registe_on_course = mysql_query("SELECT count(*) as total from user_subject
				WHERE id_subject = '$aqwr'");
				$data = mysql_fetch_assoc($query_ger_registe_on_course);
				echo '<div id="curr_course_output">';
				echo '<p id="curr_course_name"><a href="index.php?sidebar=current_course&course_id='.$row_student_course['id'].'">'.$row_student_course['cours_name'].'</a><br></p>';
				echo "<p id='curr_course_inform'>Викладач, який веде курс : ".$row_student_course['name']." ".$row_student_course['surname'];echo "<br>";
				echo "Людей зареєстрованих на курсі : ".$data['total']; echo "<br>";
				echo "ID курсу : ".$row_student_course['id']; echo "<br>";
				echo '</div>';
			}
		}
		else 
			echo 'Ви не є учасником, якихось курсів.'; 
	}
	else if ($row_inform_user['type'] == 2) 
	{
		
		$teacher_id = $row_inform_user['id'];
		echo "Список ваших курсів : ";
		$query_get_teacher_course= mysql_query("SELECT subjects.name as 'cours_name', subjects.id,  users.name, users.surname FROM subjects
			LEFT JOIN users ON subjects.teacher = users.id
			WHERE subjects.teacher = '$teacher_id'");
		
		
		if ($query_get_teacher_course) 
		{
			while ($row_teacher_course = mysql_fetch_array($query_get_teacher_course))
			{
				$aqwr = $row_teacher_course['id'];
				$query_ger_registe_on_course = mysql_query("SELECT count(*) as total from user_subject 
				WHERE id_subject = '$aqwr'");
				$data = mysql_fetch_assoc($query_ger_registe_on_course);
				echo '<div id="curr_course_output">';
				echo '<p id="curr_course_name"><a href="index.php?sidebar=current_course&course_id='.$row_teacher_course['id'].'">'.$row_teacher_course['cours_name'].'</a><br></p>';
				echo "<p id='curr_course_inform'>Викладач, який веде курс : ".$row_teacher_course['name']." ".$row_teacher_course['surname'];echo "<br>";
				echo "Людей зареєстрованих на курсі : ".$data['total']; echo "<br>";
				echo "ID курсу : ".$row_teacher_course['id']; echo "<br>";
				echo '</div>';
			}
		}
		else 
			echo "Наразі ви не створили ніяких курсів";
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
      		<p id="title_video">Курси</p>
      	  
          <!---             ПУНКТ МЕНЮ 2  -->
          <li><a onclick="toggle(hidden_content2)" id="just_pointer">Новий курс</a><br />
            Створення нового курсу</li>
            <div id="hidden_content2" style="display: none;">
              <form method="post">
                <p id="text_video_menu">Введіть назву нового курсу :<br></p>
                <input type="text" class="video_search" name="new_course_name" value = "" ><br>
                <input type="submit" value="Створити" name="submit_new_course" id="submit_button2">
              </form>
            </div>
          <li><a onclick="toggle(hidden_content3)" id="just_pointer">Видалити курс</a><br />
            Видалення вказаного курсу</li>
            <div id="hidden_content3" style="display: none;">
            	<form method="post">
                <p id="text_video_menu">Введіть назву курсу :<br></p>
                <input type="text" class="video_search" name="delete_course_name" value = "" ><br>
                <p id="text_video_menu">Введіть ID курсу :<br></p>
                <input type="text" class="video_search" name="delete_course_id" value = "" ><br>
                <input type="submit" value="Видалити" name="delete_some_course" id="submit_button2">
              </form>
            </div>
          <!--<li><a onclick="toggle(hidden_content1)" id="just_pointer">Редагування курсу</a><br />
            Зміна назви курсу або його викладача.</li>
             <div id="hidden_content1" style="display: none;">Поки-що недоступно</div>
          <form method="post">
          <li><a href="index.php?sidebar=all_global_courses">Всі курси</a><br />
            Всі створені курси на PGVsite</li>-->
            
          </form>
      </ul>
      <?php } 
      else if ($row_inform_user['type'] == 1)
      {
      ?>
      <p id="title_video">Курси</p>
      	  
          <!---             ПУНКТ МЕНЮ 2  -->
          <li><a onclick="toggle(hidden_content2)" id="just_pointer">Вступити до курсу</a><br />
            Стати учасником нового навчального курсу</li>
            <div id="hidden_content2" style="display: none;">
              Для того, щоб вступити до курсу, перейдіть у вкладку "Всі курси", там буде можливітсь стати учасником курсу.
            </div>
          
         <li><a href="index.php?sidebar=all_global_courses">Всі курси</a><br />
            Всі створені курси на PGVsite</li>





      <?php } 



      ?>

    </div>
  </div>
  <?php if ($row_inform_user['type'] == 0)
      	echo '<font id="just_error">У вас не має можливості переглядати курси, доки ви не увійшли під своїм користувачом !!!</font>'; ?>
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
		if ($_POST['delete_course_id'] and $_POST['delete_course_name'])
		{
			$dd_id = $_POST['delete_course_id'];
			$nn_name = $_POST['delete_course_name'];
			$query_delete_some_course = mysql_query("DELETE FROM subjects WHERE id='$dd_id' and name='$nn_name'");
			echo '<script>window.location.href = "index.php?sidebar=my_courses";</script>';	
		}
	}




	?>



</div>




</body>

</html>