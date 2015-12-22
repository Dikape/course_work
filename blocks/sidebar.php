	<html>
<head>
</head>

<body>

<div class="sidebar">
        
        <div class="gadget">
          <h2 class="star">Головне меню</h2>
          <div class="clr"></div>
          <ul class="sb_menu">
          	<li><a href="index.php?sidebar=main_page">Головна сторінка</a></li>
            <li><a href="index.php?sidebar=my_courses">Мої курси</a></li>
            <li><a href="index.php?sidebar=journal">Журнал оцінок</a></li>
            <li><a href="index.php?sidebar=profile">Мій профіль</a></li>
            
          </ul>
        </div>

        <?php
        if ($_SESSION['user_log_in'] == 2)
        {
           echo 
          '<div class="gadget">
            <h2 class="star">Меню викладача</h2>
            <div class="clr"></div>
              <ul class="ex_menu">
             
                  <li><a href="index.php?sidebar=write_news">Написати новину</a><br />
                    Добавлення новини по курсу</li>
                  
              </ul>
            </div>
          </div>';
        }
        else
        {
          if ($_SESSION['user_log_in'] == 1)
          {
            echo 
            '<div class="gadget">
              <h2 class="star">Меню студента</h2>
              <div class="clr"></div>
                <ul class="ex_menu">
                  
                  
                </ul>
              </div>
            </div>';
          }
          else 
          {
            echo 
            '<div class="gadget">
              <h2 class="star"> </h2>
              <div class="clr"></div>
                
              </div>
            </div>';
          }
        }

        ?>
        


</body>

</html>