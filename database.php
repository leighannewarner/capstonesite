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
    <?php include 'scripts/dbconfig.php'; ?>
    
    <!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<!-- END FAVICON -->
    
  </head>
  
  <body>

  	<div class="container">
  	
  		<div class="row" id="header">
		
				<div id="projects">
					<div class="row sub-content">
				
					</div>
	
					<div class="row content">
					Refreshing the database! <br />
						<?php
							require "scripts/dbconfig.php";
						
							if ( !$mysqli->query("DROP TABLE IF EXISTS projects") ||
								!$mysqli->query("CREATE TABLE IF NOT EXISTS `projects` (
												  `id` int(11) NOT NULL AUTO_INCREMENT,
												  `title` varchar(255) DEFAULT NULL,
												  `major` varchar(255) DEFAULT NULL,
												  `pres_group` int(11) DEFAULT NULL,
												  `poster_room` int(11) DEFAULT NULL,
												  `description` text,
												  `pic1` tinytext NOT NULL,
												  `pic2` tinytext NOT NULL,
												  `rating` decimal(11,0) NOT NULL DEFAULT '0',
												  `url` tinytext NOT NULL,
												  PRIMARY KEY (`id`)
												) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ") ) {
								echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
							} else {
								echo "Refreshed projects table.<br />";
							}
							
							if ( !$mysqli->query("DROP TABLE IF EXISTS students") ||
								!$mysqli->query("CREATE TABLE IF NOT EXISTS `students` (
												  `id` int(11) NOT NULL AUTO_INCREMENT,
												  `project_id` int(11) DEFAULT NULL,
												  `last_name` varchar(255) DEFAULT NULL,
												  `first_name` varchar(255) DEFAULT NULL,
												  `major` tinytext NOT NULL,
												  `concentration` tinytext NOT NULL,
												  `email` tinytext NOT NULL,
												  `resume` tinytext NOT NULL,
												  `linkedin` tinytext NOT NULL,
												  `portfolio` tinytext NOT NULL,
												  `github` tinytext NOT NULL,
												  `jobdes` tinytext NOT NULL,
												  `jobloc` tinytext NOT NULL,
												  `profile_image` tinytext NOT NULL,
												  PRIMARY KEY (`id`)
												) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ") ) {
								echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
							} else {
								echo "Refreshed students table.<br />";
							}
							
							echo "Going through files.<br />";

							
							$filename = "content/";
							
							ini_set('auto_detect_line_endings',TRUE);
							$file = $filename . "project_info.txt";
							$handle = fopen($file,"r");

							//loop through the csv file and insert into database
							$row = 1;
							if ($handle !== FALSE) {
								while (($data = fgetcsv($handle, 100000, "\t", '"', "\r")) !== FALSE) {
									$project_title = $mysqli->real_escape_string($data[1]);
									$project_major = $mysqli->real_escape_string($data[2]);
									$project_descr = $mysqli->real_escape_string($data[3]);
									$project_descr = htmlentities($project_descr, ENT_QUOTES, "ISO-8859-1");
									$project_descr = mb_convert_encoding($project_descr, "UTF-8", "ISO-8859-1");
									$project_descr = str_replace('\r', "<br />", $project_descr);
									$project_descr = str_replace('&Otilde;', "&#39;", $project_descr);
									$project_descr = str_replace('&Ograve;', "&quot;", $project_descr);
									$project_descr = str_replace('&Oacute;', "&quot;", $project_descr);
									$project_descr = str_replace('&yen;', "&#8226;", $project_descr);
									$project_url = $mysqli->real_escape_string($data[4]);
									$project_pres = $mysqli->real_escape_string($data[5]);
									$project_room = $mysqli->real_escape_string($data[6]);
									$project_pic1 = $mysqli->real_escape_string($data[7]);
									$project_pic2 = $mysqli->real_escape_string($data[8]);
									$project_rating = 0;
																												
									if ( !$mysqli->query("INSERT INTO projects(`title`, `major`, `description`, `pres_group`, `poster_room`, `pic1`, `pic2`, `url`, `rating`) 
												VALUES ( '" . $project_title . "', '" . $project_major . "', '" . $project_descr . "', '" . $project_pres . "', '" . $project_room . "', '" . $project_pic1 . "', '" . $project_pic2 . "', '" . $project_url . "', '" . $project_rating . "')") ) {
										echo "Insert for " . $project_title . " failed because: " . $mysqli->error . ". <br />";
									} else {
										echo "Added " . $project_title . ".<br />";
									}
								}
							} else {
								echo "Couldn't open projects file at " . $file;
							}
							
							fclose($handle);
							echo "<br />";
							
							ini_set('auto_detect_line_endings',TRUE);
							$file = $filename . "student_info.txt";
							$handle = fopen($file,"r");

							//loop through the csv file and insert into database
							$row = 1;
							if ($handle !== FALSE) {
								while (($data = fgetcsv($handle, 100000, "\t", '"', "\r")) !== FALSE) {
									
									$student_id = $mysqli->real_escape_string($data[0]);
									$student_last = $mysqli->real_escape_string($data[1]);
									$student_first = $mysqli->real_escape_string($data[2]);
									$student_major = $mysqli->real_escape_string($data[3]);
									$student_conc = $mysqli->real_escape_string($data[4]);
									$student_email = $mysqli->real_escape_string($data[5]);
									$student_resume = $mysqli->real_escape_string($data[6]);
									$student_linkedin = $mysqli->real_escape_string($data[7]);
									$student_portfolio = $mysqli->real_escape_string($data[8]);
									$student_github = $mysqli->real_escape_string($data[9]);
									$student_job_desc = $mysqli->real_escape_string($data[10]);
									$student_job_loc = $mysqli->real_escape_string($data[11]);
									$student_pic = $mysqli->real_escape_string($data[12]);
														
									if ( !$mysqli->query("INSERT INTO students(`project_id`, `last_name`, `first_name`, `major`, `concentration`, `email`, `resume`, `linkedin`, `portfolio`, `github`, `jobdes`, `jobloc`, `profile_image`) 
												VALUES ( '" . $student_id . "', '" . $student_last . "', '" . $student_first . "', '" . $student_major . "', '" . $student_conc . "', '" . $student_email. "', '" . $student_resume . "', '" . $student_linkedin . "', '" . $student_portfolio . "', '" . $student_github . "', '" . $student_job_desc .  "', '" . $student_job_loc . "', '" . $student_pic . "')") ) {
										echo "Insert for " . $student_last . " failed because: " . $mysqli->error . ". <br />";
									} else {
										echo "Added " . $student_last . ".<br />";
									}
								}
								fclose($handle);
							} else {
								echo "Couldn't open students file.";
							}
						?>
				Refreshed the database!
				</div>
			</div>
			
		</div>
			
  	</div>
  	
  </body>
  
</html>