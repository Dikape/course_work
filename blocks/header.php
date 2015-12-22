<?php session_start();  ?>
<html>
<head>
    <meta charset="utf-8">
</head>

<body>
      
	<!-- MAIN_CONTAINER -->
		<div id="main_container">
        	<!-- FRAME -->
				<div id="frame">
                   	<!-- BEGIN HEADER -->
						<div id="top">
                        	<div id="logo">
								<div id="pad_logo">
									<a href="index.php?sidebar=main_page"><font id="fontlogo">Середовище Дистанційного Навчання</font></a>
								</div>
							</div>
                            <div id="topmenu">
                                <div id="nav">
                                    <ul id="menu"> 
                                        <!--<li class="current"><a class="active" href="index.html">Головна сторінка</a></li>-->
                                        
                                        
                                        <li><a href="index.php?nav=register">Реєстрація</a></li>  
                                        <?php 
                                            if ($_SESSION['user_log_in'] != 0) 
                                                echo '<li ><a href="index.php?nav=logout">Вихід</a></li>';
                                            else
                                                echo '<li ><a href="index.php?nav=login">Вхід</a></li>';
                                        ?>   
                                        <li class="last"><a href="index.php?nav=about">Про сайт</a></li>                                                                           
                                        
                                    </ul>
                                     
                                </div>

                            </div>                            							
						</div>
                             
					<!-- END OF HEADER -->           
                </div>
                <!-- END OF FRAME -->
        </div>
        <!-- END OF MAIN_CONTAINER -->
</body>
</html>