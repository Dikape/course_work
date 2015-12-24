<html>
<head>
	<title></title>
</head>
<body>
<?php
$charrus=mysql_query("set names 'cp1251'");
if ($_GET['id_course'])
{
	$iii = $_GET['id_course'];

	$query_get_course_name = mysql_query("SELECT * FROM subjects WHERE id='$iii'");
	$row_get_course_name = mysql_fetch_array($query_get_course_name);
	$ccc_name = $row_get_course_name['name'];
}
?>
<p id="nav_name">Журнал оцінок  <?php if($ccc_name)  echo '( '.$ccc_name.' )'; ?> <p>
<div id="content_writing_style">
	<?php 
	if ($_GET['id_course'])
	{
		$id_c = $_GET['id_course'];

		$query_get_course_pract = mysql_query("SELECT tasks.id,  tasks.name, tasks.max_mark from tasks WHERE id_subject='$id_c' and type=1");
		$query_get_course_laba = mysql_query("SELECT tasks.id,  tasks.name, tasks.max_mark from tasks WHERE id_subject='$id_c' and type=2");

		$query_get_maximum_pract = mysql_query("SELECT sum(max_mark) as 'total' FROM tasks WHERE id_subject='$id_c' and type=1 GROUP BY id_subject");
		$row_maximum_pract = mysql_fetch_array($query_get_maximum_pract);
		$maximum_pract = $row_maximum_pract['total'];
		


		$query_get_maximum_laba = mysql_query("SELECT sum(max_mark) as 'total' FROM tasks WHERE id_subject='$id_c' and type=2 GROUP BY id_subject");
		$row_maximum_laba = mysql_fetch_array($query_get_maximum_laba);
		$maximum_laba = $row_maximum_laba['total'];
		


		$my_maximum_pract = 0;
		$my_maximum_laba = 0;



		echo '<div id="video_list">';
		echo '<div class="CSSTableGenerator" >';
        echo  '<table><tr><td>Назва завдання</td><td>Максимальна оцінка</td><td>Ваша оцінка</td></tr>';
        if ($query_get_course_pract)
        {
	        while ($row_get_course_pract = mysql_fetch_array($query_get_course_pract))
	        {
	        	$pract = $row_get_course_pract['id'];
	        	
	        	$user_in = $_SESSION['user_id'];
	        	$query_get_my_mark = mysql_query("SELECT * FROM mark_task WHERE id_user='$user_in' and id_task='$pract'");
	        	if ($query_get_my_mark)
	        		$row_my_mark = mysql_fetch_array($query_get_my_mark);

	                echo '<tr><td >'.$row_get_course_pract['name'].'</td><td>'.$row_get_course_pract['max_mark'].'                       </td>
		                        <td>'.$row_my_mark['mark'].'</td></tr>';
                $cur_maximum_pract = $row_my_mark['mark'];
                $my_maximum_pract += $cur_maximum_pract;
	        }
	    }

	    if ($query_get_course_laba)
        {
	        while ($row_get_course_laba = mysql_fetch_array($query_get_course_laba))
	        {
	        	$labaratorna = $row_get_course_laba['id'];
	        	
	        	$user_in = $_SESSION['user_id'];
	        	$query_get_my_mark = mysql_query("SELECT * FROM mark_task WHERE id_user='$user_in' and id_task='$labaratorna'");
	        	if ($query_get_my_mark)
	        		$row_my_mark = mysql_fetch_array($query_get_my_mark);

	                echo '<tr><td >'.$row_get_course_laba['name'].'</td><td>'.$row_get_course_laba['max_mark'].'                       </td>
		                        <td>'.$row_my_mark['mark'].'</td></tr>';
             	$cur_maximum_laba = $row_my_mark['mark'];
                $my_maximum_laba += $cur_maximum_laba;
	        }
	    }
	    $maximum_total = $maximum_pract + $maximum_laba;
	    $my_maximum_total = $my_maximum_pract + $my_maximum_laba;
	    echo '<tr><td colspan="2">Максимальна можлива сума балів : </td><td>'.$maximum_total.'</td><tr>';
	    echo '<tr><td colspan="2">Ваша сума балів : </td><td>'.$my_maximum_total.'</td><tr>';


        echo '</table>
        </div>';
        echo '</div>';
            


	

	}
	else
	{ 	
		echo '<div id="video_list">';
		
		if ($_SESSION['user_id'] == 0)
			echo '<font id="just_error">У вас не має можливості переглядати журнал оцінок!!!</font>'; 
		else
			echo "Оберіть курс, щоб подивитись оцінки по ньому.";
		echo '</div>';
	}


	?>
		<div id="video_menu">
		<div class="gadget"> 
      	<div class="clr"></div>
        <ul class="ex_menu">
      		<p id="title_video">Обрати курс</p>
      	<?php 
      	$charrus=mysql_query("set names 'cp1251'");
      	$user_in = $_SESSION['user_id'];
      	$query_get_users_course = mysql_query("SELECT * from subjects 
      		LEFT JOIN user_subject ON  user_subject.id_subject = subjects.id
      		WHERE id_user = '$user_in'");
      	if ($query_get_users_course)
      	{
			while ($row_get_users_course = mysql_fetch_array($query_get_users_course))
			{
				echo '<li><a href="index.php?sidebar=journal&id_course='.$row_get_users_course['id_subject'].'" id="just_pointer">'.$row_get_users_course['name'].'</a><br />';
			}
      	}
      	else echo "Ви не є учасником курсів.";
      	


		

      	?>  
          
          
      	</ul>
    </div>
  </div>



</div>



</body>
</html>