<html>
<head>
	<title></title>
</head>
<body>
<?php 

	$charrus=mysql_query("set names 'cp1251'");
	$user_now = $_SESSION['user_id'];
	$query_user_inform = mysql_query("SELECT * FROM users WHERE id='$user_now'");
	$row_inform_user = mysql_fetch_array($query_user_inform);
?>
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
          <li><a onclick="toggle(hidden_content2)" id="just_pointer">Новий ASasAaaSкурс</a><br />
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
                <input type="submit" value="Створити" name="delete_some_course" id="submit_button2">
              </form>
            </div>
          <li><a onclick="toggle(hidden_content1)" id="just_pointer">Редагування курсу</a><br />
            Зміна назви курсу або його викладача.</li>
             <div id="hidden_content1" style="display: none;">Поки-що недоступно</div>
          <form method="post">
          <li><a href="index.php?sidebar=all_global_courses">Всі курси</a><br />
            Всі доступні курси </li>
            
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
          
          <li><a href="#">Всі курси</a><br />
            Всі доступні курси </li>






      <?php } ?>

    </div>
  </div>

</div>














</body>
</html>