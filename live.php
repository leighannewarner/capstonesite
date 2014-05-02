<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8"/>
  <head>
  
    <title>ITCD Capstone Festival</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- BOOTSTRAP -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
    <!-- END BOOTSTRAP -->
    
    <script src="js/dynamicschedule.js"></script>
    <link rel="stylesheet" media="only screen and (max-width: 768px)" href="css/mobile.css" />
    <link href="//fonts.googleapis.com/css?family=Carrois+Gothic:400" rel="stylesheet" type="text/css">
    <?php include 'scripts/structure.php'; ?>
    
    <!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<!-- END FAVICON -->
    
  </head>
  
  <body>

  	<div class="container">
  	
  		<div class="row" id="header">
  			<?php navigation("live", ""); ?>
  		</div>
		
		<div id="projects">
			<div class="row sub-content">
				<?php sub_content_upnext(); ?>
			</div>
	
			<div class="row content">
				<?php live_content(); ?>
			</div>
		</div>
			
  	</div>
  	
  </body>
  
</html>