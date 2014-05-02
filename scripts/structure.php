<?php
	ini_set('display_errors', 1); 
	error_reporting(E_ALL);
	
	include 'dbconfig.php';
		
	function navigation($active, $subactive="") {
		echo '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-9 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 text-left green-text">
  				<h4>School of Information Technology and Communication Design</h4>
  			</div>
  			<div class="col-lg-11 col-md-11 col-sm-11 col-xs-10 text-left">
  				<h1><span class="orange-text">Spring 2014</span> <span class="blue-text">Capstone Festival</span></h1>
  			</div>
  		</div>

  		<div class="hidden-md hidden-lg hidden-sm row" id="small-nav">		
			<div class="col-md-12">
				<a href="/warnerleigha/capstonesite/index.php"><span class="glyphicon glyphicon-home"> </span></a>
				<span class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . ucwords($active) . ' <span class="glyphicon glyphicon-chevron-down"></span></a>
				  <ul class="dropdown-menu">
					<li' . (($active == 'projects') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/index.php">Projects</a></li>
					<li' . (($active == 'schedule') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/schedule.php">Schedule</a></li>
					<li' . (($active == 'live') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/live.php">Live</a></li>
					<li' . (($active == 'map') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/map.php">Map</a></li>
					<li' . (($active == 'about') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/about.php">About</a></li>
				  </ul>
				</span>
			</div>
		</div>
  		
  		<div class="row hidden-xs" id="nav">
  			<div class="col-md-12">
  				<nav class="navbar navbar-default" role="navigation">
				  <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav">
					  	<li class="dropdown' . (($active == 'projects') ? ' active' : '') . '">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
						  <ul class="dropdown-menu">';
		project_list($active, $subactive);
		echo			  '</ul>
							</li>
							<li' . (($active == 'schedule') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/schedule.php">Schedule</a></li>
							<li' . (($active == 'live') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/live.php">Live</a></li>
							<li' . (($active == 'map') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/map.php">Map</a></li>
							<li' . (($active == 'about') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/about.php">About</a></li>
						  </ul>
						</div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>
				</div>';
	}
	
	function project_list($active, $subactive) {

		require 'dbconfig.php';
		
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$projects_res = $mysqli->query("SELECT * FROM projects ORDER BY title DESC");
		
		echo '<div class="dropdown-column dropdown-column-left">';
		
		echo	'<li' . (($subactive == 'list') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/index.php">Project List</a></li>
				<li class="divider"></li>';
		
		for ($row_no = $projects_res->num_rows - 1; $row_no >= 0; $row_no--) {
			
			$projects_res->data_seek($row_no);
			$row = $projects_res->fetch_assoc();
			if(isset($_GET["id"]))
				echo '<li' . (($_GET["id"] == '' . $row["id"] . '') ? ' class="active"' : '') . '><a href="/warnerleigha/capstonesite/project.php?id=' . $row["id"] . '">' . $row["title"] . '</a></li>';
			else {
				echo '<li><a href="/warnerleigha/capstonesite/project.php?id=' . $row["id"] . '">' . $row["title"] . '</a></li>';
			}
			
			if(floor($projects_res->num_rows/3) == $row_no) {
				echo '</div><div class="dropdown-column dropdown-column-right">';
			} else if(floor($projects_res->num_rows/3)*2 == $row_no) {
				echo '</div><div class="dropdown-column dropdown-column-center">';
			}
			
		}

		echo '</div>';
		
	}
	
	function sub_content_projects() {
		echo '<div class="col-md-12 hidden-xs hidden-sm">
					<a href="#" class="active show-grid">Grid View</a> &nbsp; <a href="#" class="show-list">List View</a> <span class="orange-text">&nbsp;|&nbsp;</span> Show: &nbsp;
					<span class="showing"><a class="active" href="#" data-group="all">All</a> &nbsp;
					<a href="#" data-group="csit">CSIT</a> &nbsp;
					<a href="#" data-group="cd">CD</a> &nbsp;
					<a href="#" data-group="inter">Interdisciplinary</a></span>
					<span class="orange-text">&nbsp;|&nbsp;</span> Sort By: &nbsp;
					<span class="sorting"><a class="active" href="#" data-group="title">Project Title</a> &nbsp;
					<a href="#" data-group="major">Major</a> &nbsp;
					<a href="#" data-group="name">Last Name</a> &nbsp;
					<a href="#" data-group="presgroup">Presentation Group</a> &nbsp;
					<a href="#" data-group="posterroom">Poster Room</a> &nbsp;</span>
				</div>
				<div class="col-md-12 hidden-md hidden-lg">
					<a href="#" class="active show-grid">Grid View</a> <a href="#" class="show-list">List View</a> <span class="orange-text">&nbsp;|&nbsp;</span>
					<span class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sorting Options <b class="caret"></b></a>
					  <ul class="dropdown-menu">
					  	<li class="showing"><a href="#" data-group="all">All</a></li>
					  	<li class="showing"><a href="#" data-group="csit">CSIT</a></li>
						<li class="showing"><a href="#" data-group="cd">CD</a></li>
						<li class="showing"><a href="#" data-group="inter">Interdisciplinary</a></li>
						<li class="divider"></li>
						<li class="sorting"><a href="#" data-group="title">Project Title</a></li>
						<li class="sorting"><a href="#" data-group="major">Major</a></li>
						<li class="sorting"><a href="#" data-group="name">Last Name</a></li>
						<li class="sorting"><a href="#" data-group="presgroup">Presentation Group</a></li>
						<li class="sorting"><a href="#" data-group="posterroom">Poster Room</a></li>
					  </ul>
					</span>
				</div>';
	}
	
	function sub_content_upnext() {
		echo '<div class="col-md-12">
					Up Next <span class="orange-text">&nbsp;|&nbsp;</span> <span id="upnext">';
		upnext_content();
		echo '</span>
				</div>';
	}
	
	function upnext_content() {
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/warnerleigha/capstonesite/content/schedule.txt";
		
		if (!file_exists($filename)) {
  			print 'File not found: . ' . $filename . ' <br/>';
		}
		
		$file = @fopen($filename, "r" );
		if( $file == false )
		{
		   echo ( "Error in opening file" );
		}
		
		$dateString = fgets($file);
		$dateObj = date_parse($dateString);
		$tempDate = mktime(0, 0, 0, $dateObj["month"], 1, 1900);
		echo '<span class="hidden upnext-date"><span class="upnext-month" style="display: none">' . $dateObj["month"] .  '</span> <span class="upnext-day">' . $dateObj["day"] . '</span>, <span class="upnext-year">' . $dateObj["year"] . '</span></span>';
		echo '<span class="upnext-nothing">Nothing is scheduled for today.</span>';
		echo '<span class="upnext-nothingelse">Nothing else is scheduled for today.</span>';
		
		while (($buffer = fgets($file)) !== false) {
			$desbuffer = fgets($file);
       		echo '<span class="upnext-content"><span class="description">' . $desbuffer . '</span> from <span class="time">' . trim($buffer) . '</span>.</span>';

			if($buffer === false) {
				fclose( $file );
				return;
			}
    	}
    	
    	echo '</span>';
    	
    	fclose( $file );
	}
	
	function projects_grid() {
		
		echo '<div class="container project-grid">
				<div class="col-md-12">
					<div id="grid" class="row-fluid">';
		generate_projects_grid();			
		echo		'</div>
				</div>
			</div>'; 
	}
	
	function generate_projects_grid() {	
		require 'dbconfig.php';
		
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$projects_res = $mysqli->query("SELECT * FROM projects ORDER BY id DESC");
	
		$currId = 0;
		$lastId = -1;
		
			
		for ($row_no = $projects_res->num_rows - 1; $row_no >= 0; $row_no--) {
			$projects_res->data_seek($row_no);
			$row = $projects_res->fetch_assoc();
		
			$students_res = $mysqli->query("SELECT * FROM students WHERE project_id=" . $row['id'] . " ORDER BY project_id DESC");

			if ($students_res->num_rows > 0) {

				for ($s_row_no = $students_res->num_rows - 1; $s_row_no >= 0; $s_row_no--) {
					$students_res->data_seek($s_row_no);
					$s_row = $students_res->fetch_assoc();
			
					$currId = $s_row["project_id"];
			
					echo '<div alt="' . $row["title"] . '" class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small';
			
					if($row["major"] == "Interdisciplinary") {
						echo ' photogrid-inter-border';
					} else if($row["major"] == "Computer Science") {
						echo ' photogrid-csit-border';
					} else if($row["major"] == "Communication Design") {
						echo ' photogrid-cd-border';
					}  
			
					if($currId == $lastId) {
						echo ' photogrid-duplicate';
					}
			
					echo '" data-groups=\'["all", "';
					
					if($row["major"] == "Interdisciplinary") {
						echo 'inter';
					} else if($row["major"] == "Computer Science") {
						echo 'csit';
					} else if($row["major"] == "Communication Design") {
						echo 'cd';
					}
			
					echo '"]\' data-title="' . $row["title"] .'" data-names="' . $s_row["last_name"] . '" data-posterroom=\'' . $row["poster_room"] . '\' data-presgroup=\'' . $row["pres_group"] . '\''; 
			
					if(file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.png' )) {
						echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.png\')" >';
					} else if (file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.jpg' )) {
						echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.jpg\')" >';
					} else if (file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.jpeg' )) {
						echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.jpeg\')" >';
					} else {
						echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.gif\')" >';
					}
			
					echo	'<a href="/warnerleigha/capstonesite/project.php?id=' . $row["id"] . '" class="photogrid-hovertext">';
			
					if($row["major"] == "Interdisciplinary") {
						echo '<span class="photogrid-label cd">CD</span> <span class="photogrid-label csit">CSIT</span>';
					} else if($row["major"] == "Computer Science") {
						echo '<span class="photogrid-label csit">CSIT</span>';
					} else if($row["major"] == "Communication Design") {
						echo '<span class="photogrid-label cd">CD</span>';
					}
					
					echo '<span class="photogrid-label photogrid-tooltip">' . $row["title"] . '</span>';
					
					echo '</a>
					</div>';
			
					$lastId = $currId;
				}
			} else {
				
					echo '<div alt="' . $row["title"] . '" class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small';
				
					if($row["major"] == "Interdisciplinary") {
						echo ' photogrid-inter-border';
					} else if($row["major"] == "Computer Science") {
						echo ' photogrid-csit-border';
					} else if($row["major"] == "Communication Design") {
						echo ' photogrid-cd-border';
					}  

					echo '" data-groups=\'["all", "';
				
					if($row["major"] == "Interdisciplinary") {
						echo 'inter';
					} else if($row["major"] == "Computer Science") {
						echo 'csit';
					} else if($row["major"] == "Communication Design") {
						echo 'cd';
					} 
				
					echo '"]\' data-title="' . $row["title"] .'" data-major=\'';
				
					if($row["major"] == "Inter") {
						echo 'inter';
					} else if($row["major"] == "CS") {
						echo 'csit';
					} else if($row["major"] == "CD") {
						echo 'cd';
					} 
				
					echo '\' data-names=\'' . '???' . '\' data-posterroom=\'' . $row["poster_room"] . '\' data-presgroup=\'' . $row["pres_group"] . '\''; 
				
						if(file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.png' )) {
							echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.png\')" >';
						} else if (file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.jpg' )) {
							echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.jpg\')" >';
						} else if (file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.jpeg' )) {
							echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.jpeg\')" >';
						} else {
							echo ' style="background-image: url(\'content/projects/' . sanitize($row["title"]) . '/icon.gif\')" >';
						}
				
					echo	'<a href="/warnerleigha/capstonesite/project.php?id=' . $row["id"] . '" class="photogrid-hovertext">';
				
					if($row["major"] == "Interdisciplinary") {
						echo '<span class="photogrid-label cd">CD</span> <span class="photogrid-label csit">CSIT</span>';
					} else if($row["major"] == "Computer Science") {
						echo '<span class="photogrid-label csit">CSIT</span>';
					} else if($row["major"] == "Communication Design") {
						echo '<span class="photogrid-label cd">CD</span>';
					}
					
					echo '<br/><span class="photogrid-label photogrid-tooltip">' . $row["title"] . '</span>';
				
					echo '</a>
					</div>';
			}
		}
	}
	
	function projects_list() {
	
		require 'dbconfig.php';
		
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$projects_res = $mysqli->query("SELECT * FROM projects ORDER BY id DESC");
		
		echo '<table class="project-list">
					<thead>
					<tr>
						<th>
							Icon
						</th>
						<th>
							Project Title
						</th>
						<th class="hidden-xs">
							Major
						</th>
						<th class="hidden-xs">
							Presentation Group
						</th>
						<th class="hidden-xs">
							Poster Room
						</th>
						<th class="hidden-xs">
							First Name
						</th>
						<th class="hidden-xs">
							Last Name
						</th>
					</tr>
					</thead>
					<tbody>';						
						
			for ($row_no = $projects_res->num_rows - 1; $row_no >= 0; $row_no--) {
				$projects_res->data_seek($row_no);
				$row = $projects_res->fetch_assoc();
			
				$students_res = $mysqli->query("SELECT * FROM students WHERE project_id=" . $row['id'] . " ORDER BY project_id DESC");
				for ($s_row_no = $students_res->num_rows - 1; $s_row_no >= 0; $s_row_no--) {
					$students_res->data_seek($s_row_no);
					$s_row = $students_res->fetch_assoc();
				
					echo '<tr data-major="';
					if($row["major"] == "Interdisciplinary") {
						echo 'inter';
					} else if($row["major"] == "Computer Science") {
						echo 'csit';
					} else if($row["major"] == "Communication Design") {
						echo 'cd';
					}  
					echo '">
					
						<td>';
					
					if( file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.png' ) ) {
						echo '<img src="content/projects/' . sanitize($row["title"]) .  '/icon.png" ';
					} else if ( file_exists ( 'content/projects/' . sanitize($row['title']) . '/icon.jpg' ) ) {
						echo '<img src="content/projects/' . sanitize($row["title"]) .  '/icon.jpg" ';
					} else if ( file_exists('content/projects/' . sanitize($row['title']) . '/icon.jpeg') ) {
						echo '<img src="content/projects/' . sanitize($row['title']) . '/icon.jpeg" ';
					} else {
						echo '<img src="content/projects/' . sanitize($row['title']) . '/icon.gif" ';
					}
					
					
					if($row["major"] == "Interdisciplinary") {
						echo 'class="photogrid-inter-border"';
					} else if($row["major"] == "Computer Science") {
						echo 'class="photogrid-cs-border"';
					} else if($row["major"] == "Communication Design") {
						echo 'class="photogrid-cd-border"';
					}
					
					echo	'/>
						</td>
						<td>' .
							$row["title"]
						. '</td>
						<td class="hidden-xs">';
							
						if($s_row["major"] === "Computer Science") {
							echo "CSIT" . ": " . $s_row["concentration"];
						} else if($s_row["major"] === "Communication Design") {
							echo "CD" . ": " . $s_row["concentration"];
						}
									
					echo '</td>
						<td class="hidden-xs">';
						
						if($row["pres_group"] == 1) {
							echo '<span class="visibility: hidden">0</span>9:00am - 9:50am';
						} else if($row["pres_group"] == 2) {
							echo '10:00am - 10:50am';
						} else if($row["pres_group"] == 3) {
							echo '11:00am - 11:50am';
						} else if($row["pres_group"] == 4) {
							echo '12:00pm - 12:50pm ';
						} else if($row["pres_group"] == 5) {
							echo '1:00pm - 1:50pm ';
						}
							
					echo '</td>
						<td class="hidden-xs"> Rm. ' .
							'<a href="/warnerleigha/capstonesite/map.php?room=' . $row['poster_room'] .  '">' . $row["poster_room"] . '</a>'
						. '</td>
						<td class="hidden-xs">' .
							$s_row["first_name"]
						. '</td>
						<td class="hidden-xs">' .
							$s_row["last_name"]
						. '</td>
					</tr>';
				}
			}
						
			echo	'</tbody>
				</table>';
	}
	
	function project_page() {
	
		require 'dbconfig.php';
		
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
		$students_res = $mysqli->query("SELECT * FROM students WHERE project_id='" . $_GET["id"] . "' ORDER BY last_name DESC");
		$projects_res = $mysqli->query("SELECT * FROM projects WHERE id='" . $_GET["id"] . "'ORDER BY id ASC");
	
		$projects_res->data_seek(0);
		$row = $projects_res->fetch_assoc();
	
		echo '<div class="container">
					<div class="col-xs-12 col-md-4">';
					
					if( file_exists('content/projects/' . sanitize($row['title']) . '/banner.jpg') ) {
						echo '<img src="content/projects/' . sanitize($row['title']) . '/banner.jpg" class="project-page-icon" />
						<br />';
					} else if ( file_exists('content/projects/' . sanitize($row['title']) . '/banner.png') ) {
						echo '<img src="content/projects/' . sanitize($row['title']) . '/banner.png" class="project-page-icon" />
						<br />';
					} else if ( file_exists('content/projects/' . sanitize($row['title']) . '/banner.jpeg') ) {
						echo '<img src="content/projects/' . sanitize($row['title']) . '/banner.jepg" class="project-page-icon" />
						<br />';
					} else {
						echo '<img src="content/projects/' . sanitize($row['title']) . '/banner.gif" class="project-page-icon" />
						<br />';
					}
		
		for ($s_row_no = $students_res->num_rows - 1; $s_row_no >= 0; $s_row_no--) {
			$students_res->data_seek($s_row_no);
			$s_row = $students_res->fetch_assoc();
							
			echo			'<div class="row">
								<div class="col-xs-12 col-md-12">
									<img src="content/projects/' . sanitize($row['title']) . '/' . $s_row['profile_image'] . '" class="profile-img';
							if($s_row["major"] == "Computer Science") {
								echo ' photogrid-csit-border';
							} else if($s_row["major"] == "Communication Design") {
								echo ' photogrid-cd-border';
							} 
			echo				'" />
									<h4>' . $s_row['first_name'] . ' ' . $s_row['last_name'] . '</h4>
									<span class="green-text">' . $s_row['major'] . '</span><br />
									<span class="green-text"><i>' . $s_row['concentration'] . '</i></span> <br />';
									
									if($s_row['email'] != "") {
										echo '<span class="orange-text">' . $s_row['email'] . '</span> <br />';
									}
									
									if($s_row['resume'] != "") {
										echo '<a href="content/projects/' . $s_row['resume'] . '">Resume</a>';
									}
									
									if($s_row['linkedin'] != "") {
										if($s_row['resume'] != "") {
											echo ' | <a href="' . $s_row['linkedin'] . '">LinkedIn</a>';
										} else {
											echo ' <a href="' . $s_row['linkedin'] . '">LinkedIn</a>';
										}
									}
									
									if($s_row['github'] != "") {
										if($s_row['resume'] != "" || $s_row['linkedin'] != "") {
											echo ' | <a href="' . $s_row['github'] . '">GitHub</a>';
										} else {
											echo ' <a href="' . $s_row['github'] . '">GitHub</a>';
										}
									}
									
									if($s_row['portfolio'] != "") {
										if($s_row['resume'] != "" || $s_row['linkedin'] != "" || $s_row['github'] != "") {
											echo ' | <a href="' . $s_row['portfolio'] . '">Portfolio</a>';
										} else {
											echo ' <a href="' . $s_row['portfolio'] . '">Portfolio</a>';
										}
									}
			echo '<br />';
									if($s_row['jobdes'] != "" && $s_row['jobloc'] != "") {
										echo 'I\'m looking for a job in <span class="orange-text">' . $s_row['jobdes'] . '</span>
										near <span class="orange-text">' . $s_row['jobloc'] . '</span>!<br/>';
									}
			echo 		'</div>
							</div>
							<br />';
		}
						
		echo 		'</div>
					
					<div class="col-xs-12 col-md-8">
					
						<div class="row">
							
							<div class="col-md-12">'
								 . (($row['url'] != "") ? '<a href="' . $row['url'] . '">' : '') . '<h2>' . $row['title'] . '</h2>' . (($row['url'] != "") ? '</a>' : '') .
							'</div>' .
							/*<div class="col-md-6">
								/*<h2 class="orange-text">' .
									'<a href="#" class="rating-star">' . (($row['rating'] > 0.5) ? '<span class="glyphicon glyphicon-star"></span> ' : '<span class="glyphicon glyphicon-star-empty"></span> ') . '</a>' .
									'<a href="#" class="rating-star">' . (($row['rating'] > 1.5) ? '<span class="glyphicon glyphicon-star"></span> ' : '<span class="glyphicon glyphicon-star-empty"></span> ') . '</a>' .
									'<a href="#" class="rating-star">' . (($row['rating'] > 2.5) ? '<span class="glyphicon glyphicon-star"></span> ' : '<span class="glyphicon glyphicon-star-empty"></span> ') . '</a>' .
									'<a href="#" class="rating-star">' . (($row['rating'] > 3.5) ? '<span class="glyphicon glyphicon-star"></span> ' : '<span class="glyphicon glyphicon-star-empty"></span> ') . '</a>' .
									'<a href="#" class="rating-star">' . (($row['rating'] > 4.5) ? '<span class="glyphicon glyphicon-star"></span> ' : '<span class="glyphicon glyphicon-star-empty"></span> ') . '</a>' .
									</h2>
							'</div>*/
						'</div>
						<div class="row">
							<div class="col-md-12 project-description">
								<h4>Presentation Group: ';

								  if($row["pres_group"] == 1) {
										echo '9:00am - 9:50am';
									} else if($row["pres_group"] == 2) {
										echo '10:00am - 10:50am';
									} else if($row["pres_group"] == 3) {
										echo '11:00am - 11:50am';
									} else if($row["pres_group"] == 4) {
										echo '12:00pm - 12:50pm ';
									} else if($row["pres_group"] == 5) {
										echo '1:00pm - 1:50pm ';
									}
								  
						echo '<span class="orange-text"> | </span> Poster Room: <a href="/warnerleigha/capstonesite/map.php?room=' . $row['poster_room'] .  '">'  . $row['poster_room'] .  '</a></h4>';
								
								if(sanitize($row['pic1']) != "") {
									echo '<img class="pic1" src="content/projects/' . sanitize($row['title']) . '/' . $row['pic1'] . '" />';
								}
								
								if(sanitize($row['pic2']) != "") {
									echo '<div class="spacer"></div>
									<img class="pic2" src="content/projects/' . sanitize($row['title']) . '/' . $row['pic2'] . '" />';
								}
								
								echo $row['description'] . '
							</div>
						</div>' .
						/*<hr>
						<div class="row" id="question-answer">
							<div class="col-md-12">
								<h3>Q & A</h3>
								<h5 class="orange-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit?</h5>
								<p>Praesent viverra blandit nibh eu laoreet. Suspendisse potenti. Nunc sit amet pharetra massa. Sed scelerisque arcu eu mauris gravida interdum. Cras consectetur nisi nec turpis vehicula semper. Etiam vestibulum ac turpis eu euismod. Quisque nec nibh mollis, sollicitudin felis tempus, placerat dui. In nec viverra ligula, ut malesuada dui. Vestibulum eu lorem ac quam euismod interdum. Curabitur cursus nulla vel dui luctus congue. Praesent ultricies sollicitudin quam ac bibendum. Vestibulum vehicula ligula aliquet eros blandit feugiat. Sed pretium quis tellus et dignissim. Aliquam aliquam turpis nulla, sit amet venenatis lorem euismod pretium. Cras vestibulum, libero non ultrices iaculis, mauris mauris rhoncus ante, dictum ullamcorper neque purus ac velit. </p>
								<h3>Ask a Question</h3>									
								<div class="form-group">
									<textarea class="form-control" rows="5"></textarea>
								</div>
								<button type="submit" class="btn btn-primary btn-lg">Submit</button>
								<br/><br/>
							</div>
						</div>*/
						
					'</div>	
					
				</div>';
	}
	
	function page_navigation() {
		echo'<div class="row" id="page-navigation">
  			<div class="container">
				<ul class="nav nav-pills nav-justified">
				  <li class="right-padding" id="schedule-tab"><a href="#schedule">Schedule</a></li>
				  <li class="active center-padding" id="projects-tab"><a href="#projects">Projects</a></li>
				  <li class="left-padding" id="live-tab"><a href="#live">Live</a></li>
				</ul>
			</div>
  		</div>';
	}
	
	function live_content() {
		echo '<div class="container">
					<div class="col-md-4 left-col">
						<h2 class="green-text">#csumbcapstone</h2>
						<div class="twitter-feed">
							<a class="twitter-timeline" href="https://twitter.com/search?q=%23csumbcapstone"  data-widget-id="439480944240508928"
							data-link-color="#b0d235" 
							data-chrome="noheader transparent"
							data-border-color="#f26522">Tweets about "#csumbcapstone"</a>
   							<script>
   								!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
   							</script>
						</div>
					</div>
					<div class="col-md-8">
						<h2 class="green-text">Live Stream</h2>
						<div class="video-placeholder"></div>
					</div>
				</div>';
	}
	
	function schedule_content() {
		echo '<div class="container schedule">
					<div class="col-md-4 left-col">
						<h2 class="green-text">Schedule</h2>';
		$info = schedule();	
		echo '
					</div>
					<div class="col-md-8">
						<div id="schedule-details" class="schedule-details">'
							. $info;	
		echo			'</div> 
					</div>
				</div>';
	}
	
	function schedule() {
	
		require 'dbconfig.php';
		
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
				
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/warnerleigha/capstonesite/content/schedule.txt";
		
		if (!file_exists($filename)) {
  			print 'File not found: . ' . $filename . ' <br/>';
		}
		
		$file = @fopen($filename, "r" );
		if( $file == false )
		{
		   echo ( "Error in opening file" );
		}
		
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/warnerleigha/capstonesite/content/awards.txt";
		
		if (!file_exists($filename)) {
  			print 'File not found: . ' . $filename . ' <br/>';
		}
		
		$awards_file = @fopen($filename, "r" );
		if( $awards_file == false )
		{
		   echo ( "Error in opening file" );
		}
		
		$dateString = fgets($file);
		$dateObj = date_parse($dateString);
		$tempDate = mktime(0, 0, 0, $dateObj["month"], 1, 1900);
		echo '<h4><span class="schedule-month" style="display: none">' . $dateObj["month"] .  '</span><span class="schedule-month-long">' . date("F",$tempDate) . '</span> <span class="schedule-day">' . $dateObj["day"] . '</span>, <span class="schedule-year">' . $dateObj["year"] . '</span></h4><br />';
		echo '<dl class="schedule-list">';
		
		$counter = 1;
		$info = "";
				
		while (($buffer = fgets($file)) !== false) {
		
			$ddbuffer = fgets($file);
       		echo '<dt data-moreinfoid="moreinfo' . $counter . '">' . $buffer . ' <span class="glyphicon glyphicon-arrow-right orange-text arrow'  . (($counter == 1) ? ' active' : '') . '"></span><span class="glyphicon glyphicon-arrow-down orange-text arrow'  . (($counter == 1) ? ' active' : '') . '"></span></dt>
				<dd>' . $ddbuffer . '</dd>';
			
			$info = $info . '<div id="moreinfo'. $counter . '" class="schedule-moreinfo"'  . (($counter == 1) ? 'style="display: block"' : '') . '><h2>' . $ddbuffer . '</h2><ul>';
			
			if($counter < 6) {
				$projects_res = $mysqli->query("SELECT * FROM `projects` WHERE `pres_group` = " . $counter ." ORDER BY `projects`.`title` DESC ");
			
				for ($row_no = $projects_res->num_rows - 1; $row_no >= 0; $row_no--) {
					$projects_res->data_seek($row_no);
					$row = $projects_res->fetch_assoc();
																				
					$names = "";	
					$students_res = $mysqli->query("SELECT * FROM students WHERE project_id='" . $row["id"] . "' ORDER BY last_name DESC");
	
					for ($s_row_no = $students_res->num_rows - 1; $s_row_no >= 0; $s_row_no--) {
						$students_res->data_seek($s_row_no);
						$s_row = $students_res->fetch_assoc();
					
						if($s_row_no != 0) {
							$names = $names . $s_row["first_name"] . " " . $s_row["last_name"] . ", ";
						} else {
							$names = $names . $s_row["first_name"] . " " . $s_row["last_name"];
						}
					}
				
					$info = $info . '<li><a href="project.php?id=' . $row['id'] . '">' . $row['title'] . '</a> - ' . $names . '</li>';
				}
				
			} else {
				while (($awards_buffer = fgets($awards_file)) !== false) {
					$info = $info . '<li><span class="green-text">' . $awards_buffer . '</span> - ' . fgets($awards_file) . '</li>';
				}
			}
			
			$info = $info . '</ul></div>';
			
			$counter = $counter + 1;
    	}

    	echo '</dl>';
    	
    	fclose( $file );
    	
    	return $info;
	}
		
	function map_content() {
	
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/warnerleigha/capstonesite/content/rooms.txt";
		
		if (!file_exists($filename)) {
  			print 'File not found: . ' . $filename . ' <br/>';
		}
		
		$file = @fopen($filename, "r" );
		if( $file == false )
		{
		   echo ( "Error in opening file" );
		}
				
		echo '<div class="container">
				<div class="col-md-4 left-col">
					<h2 class="green-text">Rooms</h2>
					<div class="panel-group" id="accordion">';		
			
		$buffer = $first = fgets($file);	
		do {
			$lat = fgets($file);
			$long = fgets($file);
			map_room($buffer, $lat, $long);
			
    	} while (($buffer = fgets($file)) !== false);			
		  
		echo '			</div>
					</div>
					<div class="col-md-8 map-container">
						<div id="map-canvas"></div>
					</div>
				</div>';
				
		if (isset($_GET['room'])) {
			echo '<script>
					function setActive() {
						$( "#trigger' . $_GET['room'] . '" ).trigger( "click" );
					}
				</script>';
		}
	}
	
	function map_room($room, $lat, $long) {
		require 'dbconfig.php';
		$projects_res = $mysqli->query("SELECT * FROM projects WHERE poster_room='" . $room . "' ORDER BY title DESC");
	
		$room = trim($room);
		$lat = trim($lat);
		$long = trim($long);
	
		echo '<div class="panel panel-default">  
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" id="trigger' . $room . '" href="#collapse' . $room . '" class="map-displayinfo" onClick="addMarker(' . $lat . ', ' . $long . ',  \'Room #' . $room . '\')">
					  Room #' . $room
				  . '</a>
				  </h4>
				</div>
				
				<div id="collapse' . $room . '" class="panel-collapse collapse">
				  <div class="panel-body">';
				 
					 $info = "";
				  
					for ($row_no = $projects_res->num_rows - 1; $row_no >= 0; $row_no--) {
						$projects_res->data_seek($row_no);
						$row = $projects_res->fetch_assoc();
					
						if ($row["poster_room"] == ($room)) {
	
							$names = "";	
							$students_res = $mysqli->query("SELECT * FROM students WHERE project_id='" . $row["id"] . "' ORDER BY last_name DESC");
		
							for ($s_row_no = $students_res->num_rows - 1; $s_row_no >= 0; $s_row_no--) {
								$students_res->data_seek($s_row_no);
								$s_row = $students_res->fetch_assoc();
			
								if($s_row_no != 0) {
									$names = $names . $s_row["first_name"] . " " . $s_row["last_name"] . ", ";
								} else {
									$names = $names . $s_row["first_name"] . " " . $s_row["last_name"];
								}
							}
		
							$info = $info . '<li><a href="project.php?id=' . $row['id'] . '">' . $row['title'] . '</a> - ' . $names . '</li>';
		
						}
					}
				
					echo $info;
							
		echo				  '</div>
							</div>
						  </div>';
	}
	
	function about_content() {
		echo '<div class="container">
					<div class="col-xs-12 col-md-4">
					<br />
					<h2> Advisors </h2>';
								
					$filename = $_SERVER['DOCUMENT_ROOT'] . "/warnerleigha/capstonesite/content/advisors.txt";
		
					if (!file_exists($filename)) {
						print 'File not found: . ' . $filename . ' <br/>';
					}
		
					$file = @fopen($filename, "r" );
					if( $file == false )
					{
					   echo ( "Error in opening file" );
					}
	
					 while (($photo = fgets($file)) !== false) {
						$name = fgets($file);
						$major = fgets($file);
						$concentration = fgets($file);
						$email = fgets($file);
						
						echo '<div class="row">
							<div class="col-xs-12 col-md-12">
								<img src="content/advisor_pics/' . $photo . '" class="profile-img photogrid-csit-border" />
								<h4>' . $name . '</h4>
								<span class="green-text">' . $major . '</span><br />
								<span class="green-text"><i>' . $concentration . '</i></span> <br />
								<span class="orange-text">' . $email. '</span> <br />
							</div>
						</div>
						<br />';		
					}	
					
			echo '</div>
					
					<div class="col-xs-12 col-md-8">
						<br />
						
						 <p>As part of the Information Technology and Communication Design Bachelor\'s degree programs, all students complete two semesters of capstone classes (CST400 and CST401) and complete a capstone project. During the first semester, students choose a project, select a faculty capstone advisor and complete a detailed plan for the creation of their project. In the second semester the capstone project is completed.</p>

						<p>The capstone festival is where students present their finished projects to the School of ITCD faculty, CSUMB students and the broader community. Capstones for ITCD majors cover a wide spectrum of design and technical projects including complex web sites, programming projects, networking, animation, and visual identity packages. The projects are based on the student\'s emphasis in the major as well as the student\'s individual strengths and passions. </p>
						
					</div>	
					
				</div>';
	}
	
	/* http://stackoverflow.com/questions/2668854/sanitizing-strings-to-make-them-url-and-filename-safe */
	
	function sanitize($string, $force_lowercase = true, $anal = false) {
		$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
					   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
					   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
		$clean = trim(str_replace($strip, "", strip_tags($string)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
		return ($force_lowercase) ?
			(function_exists('mb_strtolower')) ?
				mb_strtolower($clean, 'UTF-8') :
				strtolower($clean) :
			$clean;
	}

?>