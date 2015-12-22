<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
	
	<title>Середовище Дистанційоного Навчання</title>
	<meta charset="utf-8">
	<link href = "css/main.css" rel="stylesheet" type="text/css">
</head>


<body>
<div id="page">
	
	<?php 
	
	if ($_GET['nav']) 
		$page = $_GET['nav'];	
	else  
	{
		if ($_GET['sidebar'])
			$page = $_GET['sidebar'];
		else
			$page = "index";	
	}
		
	?>	
	<?php 
		
		include 'blocks/header.php'; 
		//include 'blocks/logged_in.php';
		include 'blocks/db.php'; 
		include 'blocks/script.php';
	?>

	<div id="middle_global">
		<div id="global_content">
		<?php
			
			if ($_GET['nav'] or $_GET['sidebar'])  
				include 'blocks/'.$page.'.php'; 
			
		?>
		</div>
		<div id="global_sidebar">
			<?php include 'blocks/sidebar.php'; ?>
		</div>
	<div>
	
	<div id="grow1">
		<?php include 'blocks/footer.php'; ?> 
	</div>
</div>
</div>
</div>
</body>



</html>
