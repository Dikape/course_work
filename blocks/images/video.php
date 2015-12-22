<html>
<head>
	<title></title>
</head>
<body>

<p id="nav_name">Мої відеозаписи</p>
<div id="content_writing_style">
	<div id="video_list">
		<div class="video_player">
      <?php
        //$query = mysql_query("SELECT * FROM movies ");
        $charrus=mysql_query("set names 'cp1251'");
        $user_watch_video = $_SESSION['user_id'];
        $query = mysql_query("select distinct link, movies.name, author, movies.id from movies
              left join users_movies on movies.id = users_movies.id_video
              left join users on users.id = users_movies.id_user
              where users.id = '$user_watch_video'");
        $numb_rows = mysql_num_rows($query);
        if ($numb_rows >= 1) 
        {
          while ($row = mysql_fetch_array($query))
          {
            $vid_id = $row['id'];

            //echo "<li><a href=row['Link'] ".$row['Name']."</a></li>";
            echo '<iframe title="YouTube video player" width="501" height="346" src="'.$row['link'].'" frameborder="0" allowfullscreen></iframe>';
             echo '<div id="video_description">';
            echo "Назва : ".$row['name']; echo "<br>";
            echo "Додав : ".$row['author']; echo "<br><br>";
            echo '</div>';
            echo '<button id="add_video_button">
                  <a href = "index.php?sidebar=video&delete_video='.$vid_id.'">Видалити</a>
                  </button>';
          }
        }
        else echo "Наразі у вас немає відеозаписів.";
        
        if ($_GET['sidebar'] == "video")
        {
            if ($_GET['delete_video'])
            {
                $delete_videos = $_GET['delete_video'];
                $people = $_SESSION['user_id'];
                
                $delete_video_query = mysql_query("DELETE FROM users_movies WHERE id_video='$delete_videos' and id_user='$people'");
                //echo '<script type="text/javascript">
                  //   window.location = "index.php?sidebar=video"
                    //  </script>';
            }

        }
      
      ?>
			
      <!--<a onclick="toggle(hidden_content)" id="just_pointer">Ссылочка</a>
      <div id="hidden_content" style="display: none;">Вот он я</div>
      <input type="button" value="Проверить" onclick="isEmail()"></p>-->
                <script>
                function toggle(el) {
                   el.style.display = (el.style.display == 'none') ? '' : 'none'
                }
                </script>

		  </div>
	</div>
	<div id="video_menu">
		<div class="gadget"> 
      <div class="clr"></div>
        <ul class="ex_menu">
      		<p id="title_video">Відеозаписи</p>
      	  
          <!---             ПУНКТ МЕНЮ 2  -->
          <li><a onclick="toggle(hidden_content2)" id="just_pointer">Завантажити новий відеозапис</a><br />
            Завантажити новий відеозапис з сайта YouTube</li>
            <div id="hidden_content2" style="display: none;">
              <form method="post">
                <p id="text_video_menu">Введіть назву відеозаписа :<br></p>
                <input type="text" class="video_search" name="video_name_2" value = "" ><br><br>
                <p id="text_video_menu">Введіть посилання YouTube :<br></p>
                <input type="text" class="video_search" name="youtube_link_2" value = "" ><br>                      
                <input type="submit" value="Додати" name="submit2" id="submit_button2">
              </form>
            </div>
          <li><a onclick="toggle(hidden_content3)" id="just_pointer">Завантажити новий відеозапис</a><br />
            Завантажити новий відеозапис з свого комп'ютера</li>
            <div id="hidden_content3" style="display: none;">Поки-що недоступно</div>
          <li><a href="index.php?sidebar=all_videos" id="just_pointer">Всі відеозаписи</a><br />
            Відеозаписи всіх користувачів</li>
             <div id="hidden_content1" style="display: none;">Поки-що недоступно</div>
          <form method="post">
          <li><a onclick="toggle(hidden_content4)" id="just_pointer">Пошук відеозапису</a><br />
            Знаходження відеозапису через всіх користувачів</li>
            <div id="hidden_content4" style="display: none;">
            <form action="index.php?sidebar=profile" method = "post">  
              <p id="text_video_menu">Введіть назву відеозапису або частини назви :<br></p>
              <input type="text" class="video_search" name="video_name" value = "<?php echo $_POST['video_name'] ?>" ><br>
              <input type="submit" value="Пошук" name="submit4" id="submit_button2">
              <!--<button id="submit_button2">
                <?php
                //$video_name_3 =  $_POST['video_name'];
                //echo '<a href = "index.php?sidebar=search_video&searched_video='.$video_name_3.'">'; 
                ?>
                  Пошук</a>
              </button>-->
            </form>  
            </div> 
          </form>
      </ul>
    </div>
  </div>
  <?php
    if ($_POST['submit2'])
    {
      if ($_POST['youtube_link_2'])
      {   
        $user_watch = $_SESSION['user_id'];
        $link = $_POST['youtube_link_2'];
        list($some_adress, $video)=explode('v=', $link);
        $const_adress = "http://www.youtube.com/embed/";
        $insert_adress = $const_adress.$video;
        $user_id = $_SESSION['user_id'];
        if ($_POST['video_name_2'])
          $video_name = $_POST['video_name_2'];
        else
          $video_name = "No Name";
        $query = mysql_query("SELECT * FROM users WHERE id = '$user_id'");
        $row = mysql_fetch_array($query);
        $author_video = $row['login'];
        $query_insert = mysql_query("INSERT INTO movies(name, author, link) VALUES ('$video_name', '$author_video', '$insert_adress')");
        $query_get_id = mysql_query("SELECT * FROM movies where link = '$insert_adress'");
        $row_id = mysql_fetch_array($query_get_id);
        $id_video = $row_id['id'];
        $query_insert = mysql_query("INSERT INTO users_movies(id_user, id_video) VALUES ('$user_watch', '$id_video')");
        echo '<script type="text/javascript">
           window.location = "index.php?sidebar=video"
        </script>';
      }
    }  
    if ($_POST['submit4'])
    {
      $searched_video = $_POST['video_name'];
      /*$s='вебмастерс';
$s=iconv("Windows-1251","UTF-8", $s);
$s=urlencode($s);
echo($s);
echo "<br>";
$v = urldecode($s);
echo $v;
$charrus=mysql_query("set names 'cp1251'");echo "<br>";
echo  iconv('utf-8', 'cp1251',urldecode($_SERVER['HTTP_REFERER']));*/
      echo '<script type="text/javascript">
         window.location = "index.php?sidebar=search_video&search_video='.urlencode($searched_video).'"
        </script>';

    }
  ?>

</div>
  <?php 




  ?>



</body>
</html>