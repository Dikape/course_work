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

<?php 
	$charrus=mysql_query("set names 'cp1251'");
	if($_GET['course_id'])
		$current_course = $_GET['course_id']; 
	$query_get_course_name = mysql_query("SELECT name FROM subjects WHERE id = '$current_course'");
	$row_course_name = mysql_fetch_array($query_get_course_name);
	$current_course_name = $row_course_name['name'];
?>
<p id="nav_name"><?php echo $current_course_name; ?></p>
<div id="content_writing_style">
	<div id="video_list">
	<?php 
		$user_now = $_SESSION['user_id'];
		$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
		$row_inform_user = mysql_fetch_array($query_user_inform);

		if ($row_inform_user['type'] == 1)
		{
			 
        $query_get_pract_task = mysql_query("SELECT * from tasks WHERE id_subject = '$current_course' and type=1");
        $number_pract_task = mysql_num_rows($query_get_pract_task);
        if ($number_pract_task>=1)
          echo '<p id="ttt">Список практичних завдань : <br></p>';
        while ($row_pract_task = mysql_fetch_array($query_get_pract_task))
        {
          echo '<div id="curr_pract_output">';  echo '<font id="qaza">';
          $some_var = $row_pract_task['id'];
            echo '<a href="index.php?sidebar=current_pract&id_pract='.$some_var.'">';
            echo $row_pract_task['name']; echo "</a><br>"; echo '</font>';
            echo '<font id="qaze">';
            echo "Опис завдання : "; echo '</font>'; echo '<font id="qaz">'; echo $row_pract_task['description']; echo '</font>'; echo "<br>";
            echo '</p>'; echo '<font id="qaze">';
            echo "Максимальна оцінка : "; echo '</font>'; echo '<font id="qaz">'; echo $row_pract_task['max_mark'];  echo '</font>'; echo "<br>";
            echo '<font id="qaze">';
            echo "Дата здачі : "; echo '</font>'; echo '<font id="qaz">'; echo $row_pract_task['date'];  echo '</font>'; echo "<br>";
            echo '</div>';
            
        }
       
        $query_get_laba_task = mysql_query("SELECT * from tasks WHERE id_subject = '$current_course' and type=2");
        $number_laba_task = mysql_num_rows($query_get_laba_task);
        if ($number_laba_task>=1)
           echo '<p id="ttt">Список лабараторних завдань : <br></p>';
         if ($number_laba_task <=0 and $number_pract_task <=0)
          echo "Наразі на даному курсі, немає ніяких завдань.";
        while ($row_laba_task = mysql_fetch_array($query_get_laba_task))
        {
          echo '<div id="curr_pract_output">';  echo '<font id="qaza">';
          $some_var = $row_laba_task['id'];
             echo '<a href="index.php?sidebar=current_laba&id_laba='.$some_var.'">';
            echo $row_laba_task['name']; echo "</a><br>"; echo '</font>';
            echo '<font id="qaze">';
            echo "Опис завдання : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['description']; echo '</font>'; echo "<br>";
            echo '</p>'; echo '<font id="qaze">';
            echo "Максимальна оцінка : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['max_mark'];  echo '</font>'; echo "<br>";
            echo '<font id="qaze">';
            echo "Дата здачі : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['date'];  echo '</font>'; echo "<br>";
            if ($row_laba_task['laba'])
            {
              echo '<font id="qaze">';
              $name_file2 = $row_laba_task['laba'];

              echo "Прикріплений файл : "; echo '</font>'; echo '<font id="qaz">'; 
              echo '<a href="/documents/teacher_labs/'.$name_file2.'"'.$row_laba_task['laba'].'</a>';
              //echo '<a href="Z:/home/localhost/www/documents/teacher_labs/'.$name_file2.'">';
              echo $row_laba_task['laba'];echo '</a>';  echo '</font>'; echo "<br>";
            }
            echo '</div>';
            

        }
		echo '<p id="ttt">Матеріали курсу : <br></p>';
				$query_get_laba_task = mysql_query("SELECT * from resource WHERE id_subject = '$current_course'");
				if ($query_get_laba_task)
				{
					while ($row_laba_task = mysql_fetch_array($query_get_laba_task))
					{
					  $some_var = $row_laba_task['id'];
					  echo '<div id="curr_pract_output">';  echo '<font id="qaza">';
					  echo '<a >';
						echo $row_laba_task['name'];  echo "</a><br>"; echo '</font>';
						echo '<font id="qaze">';
						echo "Опис матеріалу : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['description']; echo '</font>'; echo "<br>";
						echo '</p>'; echo '<font id="qaze">';
						
						if ($row_laba_task['file'])
						{
						  echo '<font id="qaze">';
						  $name_file2 = $row_laba_task['file'];

						  echo "Прикріплений файл : "; echo '</font>'; echo '<font id="qaz">'; 
						  echo '<a href="/documents/resources/'.$name_file2.'"'.$row_laba_task['file'].'</a>';
						  //echo '<a href="Z:/home/localhost/www/documents/resources/'.$name_file2.'">';
						  echo $row_laba_task['file'];echo '</a>';  echo '</font>'; echo "<br>";
						}
						echo '</div>';
					}
				}
		
		}
		else 
		{
			if ($row_inform_user['type'] == 2)
			{
				echo '<p id="ttt">Список практичних завдань : <br></p>';
				$query_get_pract_task = mysql_query("SELECT * from tasks WHERE id_subject = '$current_course' and type=1");
				if ($query_get_pract_task)
				{
					while ($row_pract_task = mysql_fetch_array($query_get_pract_task))
					{
						$some_var = $row_pract_task['id'];
						echo '<div id="curr_pract_output">';  echo '<font id="qaza">';
						echo '<a href="index.php?sidebar=assess_student&id_pract='.$some_var.'&id_course='.$current_course.'">';
						echo $row_pract_task['name']; echo "</a><br>"; echo '</font>';
						echo '<font id="qaze">';
						echo "Опис завдання : "; echo '</font>'; echo '<font id="qaz">'; echo $row_pract_task['description']; echo '</font>'; echo "<br>";
						echo '</p>'; echo '<font id="qaze">';
						echo "Максимальна оцінка : "; echo '</font>'; echo '<font id="qaz">'; echo $row_pract_task['max_mark'];  echo '</font>'; echo "<br>";
						echo '<font id="qaze">';
						echo "Дата здачі : "; echo '</font>'; echo '<font id="qaz">'; echo $row_pract_task['date'];  echo '</font>'; echo "<br>";
						echo '</div>';
						
					}
				}



				echo '<p id="ttt">Список лабараторних завдань : <br></p>';
				$query_get_laba_task = mysql_query("SELECT * from tasks WHERE id_subject = '$current_course' and type=2");
				if ($query_get_laba_task)
				{
					while ($row_laba_task = mysql_fetch_array($query_get_laba_task))
					{
					  $some_var = $row_laba_task['id'];
					  echo '<div id="curr_pract_output">';  echo '<font id="qaza">';
					  echo '<a href="index.php?sidebar=assess_student&id_laba='.$some_var.'&id_course='.$current_course.'">';
						echo $row_laba_task['name'];  echo "</a><br>"; echo '</font>';
						echo '<font id="qaze">';
						echo "Опис завдання : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['description']; echo '</font>'; echo "<br>";
						echo '</p>'; echo '<font id="qaze">';
						echo "Максимальна оцінка : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['max_mark'];  echo '</font>'; echo "<br>";
						echo '<font id="qaze">';
						echo "Дата здачі : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['date'];  echo '</font>'; echo "<br>";
						if ($row_laba_task['file'])
						{
						  echo '<font id="qaze">';
						  $name_file2 = $row_laba_task['file'];

						  echo "Прикріплений файл : "; echo '</font>'; echo '<font id="qaze">'; 
						  echo '<a href="/documents/teacher_labs/'.$name_file2.'"'.$row_laba_task['file'].'</a>';
						  //echo '<a href="Z:/home/localhost/www/documents/teacher_labs/'.$name_file2.'">';
						  echo $row_laba_task['file'];echo '</a>';  echo '</font>'; echo "<br>";
						}
						echo '</div>';
					}
				}
				
				
				echo '<p id="ttt">Матеріали курсу : <br></p>';
				$query_get_laba_task = mysql_query("SELECT * from resource WHERE id_subject = '$current_course'");
				if ($query_get_laba_task)
				{
					while ($row_laba_task = mysql_fetch_array($query_get_laba_task))
					{
					  $some_var = $row_laba_task['id'];
					  echo '<div id="curr_pract_output">';  echo '<font id="qaza">';
					  echo '<a >';
						echo $row_laba_task['name'];  echo "</a><br>"; echo '</font>';
						echo '<font id="qaze">';
						echo "Опис матеріалу : "; echo '</font>'; echo '<font id="qaz">'; echo $row_laba_task['description']; echo '</font>'; echo "<br>";
						echo '</p>'; echo '<font id="qaze">';
						
						if ($row_laba_task['file'])
						{
						  echo '<font id="qaze">';
						  $name_file2 = $row_laba_task['file'];

						  echo "Прикріплений файл : "; echo '</font>'; echo '<font id="qaz">'; 
						  echo '<a href="/documents/resources/'.$name_file2.'"'.$row_laba_task['file'].'</a>';
						  //echo '<a href="Z:/home/localhost/www/documents/resources/'.$name_file2.'">';
						  echo $row_laba_task['file'];echo '</a>';  echo '</font>'; echo "<br>";
						}
						echo '</div>';
					}
				}
			}
			
		}
		
	?>
	</div>




	<?php 
	if ($row_inform_user['type'] == 2)
	{

	?>
	<div id="video_menu">
		<div class="gadget"> 
      <div class="clr"></div>
        <ul class="ex_menu">
        	<p id="title_video">Управління курсом</p>
          <li><a " id="just_pointer">Оцінити студента</a><br />
            Щоб оцінити студента натисніть на завдання</li>    
          
<p id="title_video">Редагування курсу</p>
      	  
          <!---             ПУНКТ МЕНЮ 2  -->
          <?php 
          	if($_GET['course_id'])
			$current_add_task = $_GET['course_id']; 
			echo '<li><a href="index.php?sidebar=add_course_task&id_course='.$current_add_task.'" id="just_pointer">Додати нове завдання</a><br />';
          ?>
          
            Можливість додати нове завдання</li>
           
            <?php 
			echo '<li><a href="index.php?sidebar=add_course_resource&id_course='.$current_add_task.'" id="just_pointer">Додати нові матеріали</a><br />';
			?><!--<li><a onclick="toggle(hidden_content2)" id="just_pointer">Добавити нові матеріали</a><br />-->
            Можливість додати новий матеріал по курсу</li>
           
          <li><a onclick="toggle(hidden_content3)" id="just_pointer">Видалити завдання</a><br />
            Можливіть видалення певного завдання</li>
            <div id="hidden_content3" style="display: none;">
              <form method="post">
                <p id="text_video_menu">Введіть назву завдання :<br></p>
                <input type="text" class="video_search" name="task_name_2" value = "" ><br><br>
                
                <input type="submit" value="Видалити" name="task_delete_2" id="submit_button2">
              </form>
              
            </div>
            
      </ul>
    </div>
  </div>
  <?php 
	}
  ?>

</div>


<?php 
if ($_POST['task_delete_2'])
{
   
 
      $del_element = $_POST['task_name_2'];
      echo $del_element;
      $query_delete_pract = mysql_query("DELETE  FROM tasks WHERE name='$del_element'"); echo "";
      $query_delete_task_2 = mysql_query("DELETE  FROM tasks WHERE name='$del_element'");
      $ccc_id = $_GET['course_id'];
      echo '<script type="text/javascript">
           window.location = "index.php?sidebar=current_course&course_id='.$ccc_id.'"
        </script>';

}
?>








</body>
</html>