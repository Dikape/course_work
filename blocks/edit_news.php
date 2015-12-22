<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p id="nav_name"> Редагування новини<p>
<div id="content_writing_style">
<?php 
$charrus=mysql_query("set names 'cp1251'");

$ne_id = $_GET['edit_news'];
$edit_news_query = mysql_query("SELECT * FROM news WHERE id='$ne_id'");
$row_edit_news_query = mysql_fetch_array($edit_news_query);
$news_title_last = $row_edit_news_query['title'];
$news_title_content = $row_edit_news_query['content'];
$news_title_picture = $row_edit_news_query['picture'];
$news_title_video = $row_edit_news_query['video'];

echo '<form method="post" enctype="multipart/form-data">
  		<font id="pract_title">Заголовок новини :</font><br> <input type="text" class="news_title" name="news_title" value = "'.$news_title_last.'" > <br><br>
		<font id="pract_title">Контент новини : </font><br>
		<textarea id="news_area" name="news_content" class="ggrtgrtes" rows="8" cols="40" >'.$news_title_content.'</textarea><br>
		<br><font id="pract_title">Прикріпити зображення : </font><input type="file" name="filename" id="avatar_button1" ><br><br>
		<font id="pract_title">Прикріпити відеозапис (необхідно ввести посилання YouTube) :</font><br> <input type="text" class="news_title" name="youtube_link_2" value = "'.$news_title_video.'" > <br><br>
		<input type="submit" value="Підтвердити" name="my_edit_news" id="submit_button">
</form>';
if ($_POST['my_edit_news'])
{
	$new_news_content = $_POST['news_content'];
	$new_news_title = $_POST['news_title'];
	$new_news_video = $_POST['youtube_link_2'];
	$new_news_pics = $_POST['filename'];


	$link = $_POST['youtube_link_2'];
	$insert_adress = $_POST['youtube_link_2'];
	if ($insert_adress == $news_title_video)
	{
		$insert_adress = $_POST['youtube_link_2'];
	}
	else
	{
		$link = $_POST['youtube_link_2'];
			list($some_adress, $video)=explode('v=', $link);
		$const_adress = "http://www.youtube.com/embed/";
		$insert_adress = $const_adress.$video;
	}

	if ($new_news_content)	$query = mysql_query("UPDATE news SET content = '$new_news_content' WHERE id='$ne_id'");
	if ($new_news_title)	$query = mysql_query("UPDATE news SET title = '$new_news_title' WHERE id='$ne_id'");
	if ($new_news_video)	$query = mysql_query("UPDATE news SET video = '$insert_adress' WHERE id='$ne_id'");
	


	if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
	    {
	    	$fule_name = $_FILES['filename']['name'];
	    	$part_name = explode(".", $fule_name);
	    	$expansion = $part_name[1];
		    $filename = $fule_name;
		    $pic_adress = $filename;
		    $_FILES['userfile']['tmp_name'] = $row['id'];		 
	    	move_uploaded_file($_FILES["filename"]["tmp_name"], "Z:/home/localhost/www/documents/news/".$filename);
	    	$query = mysql_query("UPDATE news SET picture = '$fule_name' WHERE id='$ne_id'");
	    } 

		echo '<script type="text/javascript">
           window.location = "index.php?sidebar=main_page"
        </script>';
}

?>
</div>

</body>
</html>