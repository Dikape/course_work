<html>

<head>
<title></title>
</head>


<body>
<p id="nav_name"> Написати новину<p>
<div id="content_writing_style">
	<form method="post" enctype="multipart/form-data">
  		<font id="pract_title">Заголовок новини :</font><br> <input type="text" class="news_title" name="news_title" value = "" > <br><br>
		<font id="pract_title">Контент новини : </font><br>
		<textarea id="news_area" name="news_content" class="ggrtgrtes" rows="8" cols="40"></textarea><br>
		<br><font id="pract_title">Прикріпити зображення : </font><input type="file" name="filename" id="avatar_button1" ><br><br>
		<font id="pract_title">Прикріпити відеозапис (необхідно ввести посилання YouTube) :</font><br> <input type="text" class="news_title" name="youtube_link_2" value = "" > <br><br>
		<input type="submit" value="Підтвердити" name="submit2" id="submit_button">
  	</form>
</div>
<?php
    if ($_POST['submit2'])
    {
    	$video_adress = "";
    	$pic_adress = "";
    	$charrus=mysql_query("set names 'cp1251'");
      	if ($_POST['youtube_link_2'])
      	{	
      	   
	        $user_watch = $_SESSION['user_id'];
	        $link = $_POST['youtube_link_2'];

	        list($some_adress, $video)=explode('v=', $link);
	        $const_adress = "http://www.youtube.com/embed/";
	        $insert_adress = $const_adress.$video;
	        $user_id = $_SESSION['user_id'];
	        $video_adress = $insert_adress;
     	}   
     	if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {
	    	$fule_name = $_FILES['filename']['name'];
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
	    	//$query = mysql_query("UPDATE laba SET laba = '$fule_name' WHERE id_course='$cur_course'");
		    /*$filename = $cur_course.".".$expansion;*/
		    $filename = $fule_name;
		    $pic_adress = $filename;
		    $_FILES['userfile']['tmp_name'] = $row['id'];
		    //echo $_FILES['userfile']['name'];
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/news/".$filename);
	    } 
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        $today = date("Y-m-d H:i:s");
        $user_in = $_SESSION['user_id'];
        $query_get_name_surname = mysql_query("SELECT name, surname FROM users WHERE id='$user_in'");
        $row_name_surname = mysql_fetch_array($query_get_name_surname);
        $n_name = $row_name_surname['name'];
        $n_surname = $row_name_surname['surname'];

        $query_insert = mysql_query("INSERT INTO news(date, surname, content, picture, video, title) 
        	VALUES ('$today','$n_surname', '$news_content', '$pic_adress', '$video_adress', '$news_title')");
        echo '<script type="text/javascript">
          window.location = "index.php?sidebar=main_page"
       </script>';
      
    }
?>


</body>

</html>