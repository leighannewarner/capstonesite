<?php
	ini_set('display_errors', 1); 
	error_reporting(E_ALL); 
	
	function navigation($active, $subactive = "") {
		echo '<div class="hidden-md hidden-lg hidden-sm col-xs-1">
  				<span class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-align-justify"></span></a>
				  <ul class="dropdown-menu">
					<li' . (($active == 'projects') ? ' class="active"' : '') . '><a href="/capstonesite/index.php">Projects</a></li>
					<li' . (($active == 'schedule') ? ' class="active"' : '') . '><a href="/capstonesite/schedule.php">Schedule</a></li>
					<li' . (($active == 'live') ? ' class="active"' : '') . '><a href="/capstonesite/live.php">Live</a></li>
					<li' . (($active == 'map') ? ' class="active"' : '') . '><a href="/capstonesite/map.php">Map</a></li>
					<li' . (($active == 'about') ? ' class="active"' : '') . '><a href="/capstonesite/about.php">About</a></li>
				  </ul>
				</span>
  			</div>
  			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-9 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 text-left green-text">
  				<h4>School of Information Technology and Communication Design</h4>
  			</div>
  			<div class="col-lg-11 col-md-11 col-sm-11 col-xs-10 text-left">
  				<h1><span class="orange-text">Spring 2014</span> <span class="blue-text">Capstone Festival</span></h1>
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
					  <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">Navigation</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav">
					  	<li class="dropdown' . (($active == 'projects') ? ' active' : '') . '">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
						  <ul class="dropdown-menu">
						  	<li' . (($subactive == 'list') ? ' class="active"' : '') . '><a href="/capstonesite/index.php">Project List</a></li>
						  	<li class="divider"></li>
							<li' . (($subactive == 'origin') ? ' class="active"' : '') . '><a href="/capstonesite/projects/origin/origin.php">Origin</a></li>
							<li><a href="#">Project #2</a></li>
							<li><a href="#">Project #3</a></li>
						  </ul>
						</li>
						<li' . (($active == 'schedule') ? ' class="active"' : '') . '><a href="/capstonesite/schedule.php">Schedule</a></li>
						<li' . (($active == 'live') ? ' class="active"' : '') . '><a href="/capstonesite/live.php">Live</a></li>
						<li' . (($active == 'map') ? ' class="active"' : '') . '><a href="/capstonesite/map.php">Map</a></li>
						<li' . (($active == 'about') ? ' class="active"' : '') . '><a href="/capstonesite/about.php">About</a></li>
					  </ul>
					</div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
  			</div>';
	}
	
	function sub_content_projects() {
		echo '<div class="col-md-12 hidden-xs">
					<a href="#"  class="active show-grid">Grid View</a> &nbsp; <a href="#" class="show-list">List View</a> <span class="orange-text">&nbsp;|&nbsp;</span> Show: &nbsp;
					<span class="showing"><a class="active" href="#" data-group="all">All</a> &nbsp;
					<a href="#" data-group="csit">CSIT</a> &nbsp;
					<a href="#" data-group="cd">CD</a> &nbsp;
					<a href="#" data-group="inter">Interdisciplinary</a></span>
					<span class="orange-text">&nbsp;|&nbsp;</span> Sort By: &nbsp;
					<span class="sorting"><a class="active" href="#" data-group="title">Project Title</a> &nbsp;
					<a href="#" data-group="major">Major</a> &nbsp;
					<a href="#" data-group="name">Last Name</a> &nbsp;</span>
				</div>
				<div class="col-md-12 hidden-sm hidden-md hidden-lg">
					<a href="#">List View</a> <span class="orange-text">&nbsp;|&nbsp;</span> Sort By: &nbsp; 
					<span class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
					  <ul class="dropdown-menu">
						<li><a href="#" class="active" data-group="cd">Major</a></li>
						<li><a href="#" data-group="csit">Student</a></li>
						<li><a href="#" data-group="inter">Presentation</a></li>
						<li><a href="#" >Group</a></li>
						<li><a href="#" >Poster Room</a></li>
					  </ul>
					</span>
				</div>';
	}
	
	function sub_content_upnext() {
		echo '<div class="col-md-12">
					<a href="#">Up Next</a> <span class="orange-text">&nbsp;|&nbsp;</span> <span id="upnext"></span>
				</div>';
	}
	
	function projects_grid() {
		echo '<div class="container project-grid">
				<div class="col-md-12">
					<div id="grid" class="row-fluid">
						<div class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small photogrid-inter-border photogrid-duplicate"  data-groups=\'["all", "inter"]\' data-title=\'Origin\' data-major=\'inter\' data-names=\'Gatica\' style="background-image: url(\'projects/origin/origin.png\')">
							<a href="projects/origin/origin.php" class="photogrid-hovertext">
								<span class="photogrid-label cd">CD</span> <span class="photogrid-label csit">CSIT</span>
							</a>
						</div>
						
						<div class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small photogrid-inter-border"  data-groups=\'["all", "inter"]\' data-title=\'Origin\' data-major=\'inter\' data-names=\'Warner\' style="background-image: url(\'projects/origin/origin.png\')">
							<a href="projects/origin/origin.php" class="photogrid-hovertext">
								<span class="photogrid-label cd">CD</span> <span class="photogrid-label csit">CSIT</span>
							</a>
						</div>
						
						<div class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small photogrid-cd-border" data-groups=\'["all", "cd"]\' data-title=\'projectb\' data-major=\'cd\' data-names=\'Pyne\' style="background-image: url(\'images/placeholder.gif\')">
							<div class="photogrid-hovertext">
								<span class="photogrid-label cd">CD</span>
							</div>
						</div>
						
						<div class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small photogrid-csit-border"  data-groups=\'["all", "csit"]\' data-title=\'projecta\' data-major=\'csit\' data-names=\'Snider\' style="background-image: url(\'images/placeholder.gif\')">
							<div class="photogrid-hovertext">
								<span class="photogrid-label csit">CSIT</span>
							</div>
						</div>
						
						<div class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small photogrid-inter-border"   data-groups=\'["all", "inter"]\' data-title=\'projectm\' data-major=\'inter\' data-names=\'ONeil\' style="background-image: url(\'images/placeholder.gif\')">
							<div class="photogrid-hovertext">
								<span class="photogrid-label cd">CD</span> <span class="photogrid-label csit">CSIT</span>
							</div>
						</div>
						
						<div class="item col-xs-4 col-sm-2 col-md-1 photogrid photogrid-small photogrid-inter-border photogrid-duplicate"   data-groups=\'["all", "inter"]\' data-title=\'projectm\' data-major=\'inter\' data-names=\'Brown\' style="background-image: url(\'images/placeholder.gif\')">
							<div class="photogrid-hovertext">
								<span class="photogrid-label cd">CD</span> <span class="photogrid-label csit">CSIT</span>
							</div>
						</div>
					</div>
				</div>
			</div>'; 
	}
	
	function project_page() {
		echo '<div class="container">
					<div class="col-xs-12 col-md-4">
						<br />
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<img src="../../images/placeholder.gif" class="profile-img photogrid-cd-border" />
								<h4>Ezequiel Gatica</h4>
								<span class="green-text">Communication Design</span><br />
								<span class="green-text"><i>Interactive Media</i></span> <br />
								<span class="orange-text">egatica@csumb.edu</span> <br />
								<a href="#">Resume</a> | <a href="#">LinkedIn</a> <br />
								I\'m looking for a job in <span class="orange-text">video game design</span>
								near <span class="orange-text">San Jose, CA</span>!<br/>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<img src="../../images/placeholder.gif" class="profile-img photogrid-csit-border" />
								<h4>Leigh Anne Warner</h4>
								<span class="green-text">Computer Science</span><br />
								<span class="green-text"><i>Software Engineering</i></span> <br />
								<span class="orange-text">lwarner@csumb.edu</span> <br />
								<a href="#">Resume</a> | <a href="#">LinkedIn</a> | <a href="#">Portfolio</a><br />
								I\'m looking for a job in <span class="orange-text">software engineering</span>
								near <span class="orange-text">San Jose, CA</span>!<br/>
							</div>
						</div>
						<br />
					</div>
					
					<div class="col-xs-12 col-md-8">
					
						<br />
						<div class="row">
							<div class="col-md-6">
								<h2>Origin: The Game</h2>
							</div>
							<div class="col-md-6">
								<h2 class="orange-text"><span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span></h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h4>Presentation Group: #3 <span class="orange-text">|</span> Poster Room: <a>#118</a></h4>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent viverra blandit nibh eu laoreet. Suspendisse potenti. Nunc sit amet pharetra massa. Sed scelerisque arcu eu mauris gravida interdum. Cras consectetur nisi nec turpis vehicula semper. Etiam vestibulum ac turpis eu euismod. Quisque nec nibh mollis, sollicitudin felis tempus, placerat dui. In nec viverra ligula, ut malesuada dui. Vestibulum eu lorem ac quam euismod interdum. Curabitur cursus nulla vel dui luctus congue. Praesent ultricies sollicitudin quam ac bibendum. Vestibulum vehicula ligula aliquet eros blandit feugiat. Sed pretium quis tellus et dignissim. Aliquam aliquam turpis nulla, sit amet venenatis lorem euismod pretium. Cras vestibulum, libero non ultrices iaculis, mauris mauris rhoncus ante, dictum ullamcorper neque purus ac velit. </p>
							</div>
						</div>
						<hr>
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
						</div>
						
					</div>	
					
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
						<h2 class="green-text">Twitter Feed</h2>
						<div class="twitter-feed">
							<a class="twitter-timeline"  href="https://twitter.com/search?q=%23csumb"  data-widget-id="439480944240508928">
								Tweets about "#csumb"
							</a>
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
		echo schedule();	
		echo '
					</div>
					<div class="col-md-8">
						<h2 class="green-text">To Do List</h2>
						<form id="todo">
							<input type="checkbox" name="todo" value="item1"> Watch Group #1 presentation<br><br>
							<input type="checkbox" name="todo" value="item2"> See The Best Project Ever\'s poster session<br><br>
							<input type="checkbox" name="todo" value="item3"> See Another Really Cool Project\'s poster session<br>
						</form> 
					</div>
				</div>';
	}
	
	function schedule() {
		$filename = $_SERVER['DOCUMENT_ROOT'] . "/capstonesite/content/schedule.txt";
		
		if (!file_exists($filename)) {
  			print 'File not found <br/>';
		}
		
		$file = @fopen($filename, "r" );
		if( $file == false )
		{
		   echo ( "Error in opening file" );
		}
		
		$dateString = fgets($file);
		$dateObj = date_parse($dateString);
		$tempDate = mktime(0, 0, 0, $dateObj["month"], 1, 1900);
		echo '<h4><span class="schedule-month" style="display: none">' . $dateObj["month"] .  '</span><span class="schedule-month-long">' . date("F",$tempDate) . '</span> <span class="schedule-day">' . $dateObj["day"] . '</span>, <span class="schedule-year">' . $dateObj["year"] . '</span></h4><br />';
		echo '<dl class="schedule-list">';
		
		while (($buffer = fgets($file)) !== false) {
       		echo '<dt>' . $buffer . '</dt>
				<dd>' . fgets($file) . '</dd>';
    	}
    	echo '</dl>';
    	
    	fclose( $file );
	}
	
	function map_content() {
		echo '<div class="container">
					<div class="col-md-4 left-col">
						<h2 class="green-text">Rooms</h2>
						<ul>
							<li><a href="#">Room #104</a></li>
							<li><a href="#">Room #118</a></li>
							<li><a href="#">Room #131</a></li>
							<li><a href="#">Room #156</a></li>
							<li><a href="#">Room #171</a></li>
						</ul>
					</div>
					<div class="col-md-8 map-container">
						<div id="map-canvas"></div>
					</div>
				</div>';
	}
	
	function about_content() {
		echo '<div class="container">
					<div class="col-xs-12 col-md-4">
					<br />
					<h2> Advisors </h2>
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<img src="images/placeholder.gif" class="profile-img photogrid-csit-border" />
							<h4>Young Joon Byun</h4>
							<span class="green-text">Computer Science</span><br />
							<span class="green-text"><i>Software Engineering</i></span> <br />
							<span class="orange-text">ybyun@csumb.edu</span> <br />
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<img src="images/placeholder.gif" class="profile-img photogrid-cd-border" />
							<h4>Kevin Cahill</h4>
							<span class="green-text">Communication Design</span><br />
							<span class="green-text"><i>Web Design</i></span> <br />
							<span class="orange-text">kcahill@csumb.edu</span> <br />
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<img src="images/placeholder.gif" class="profile-img photogrid-csit-border" />
							<h4>Kate Lockwood</h4>
							<span class="green-text">Computer Science</span><br />
							<span class="green-text"><i>Software Engineering</i></span> <br />
							<span class="orange-text">klockwood@csumb.edu</span> <br />
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<img src="images/placeholder.gif" class="profile-img photogrid-cd-border" />
							<h4>Bobbi Long</h4>
							<span class="green-text">Communication Design</span><br />
							<span class="green-text"><i>Visual Design</i></span> <br />
							<span class="orange-text">blong@csumb.edu</span> <br />
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<img src="images/placeholder.gif" class="profile-img photogrid-csit-border" />
							<h4>Sathya Narayanan</h4>
							<span class="green-text">Computer Science</span><br />
							<span class="green-text"><i>Networking & Security</i></span> <br />
							<span class="orange-text">snarayanan@csumb.edu</span> <br />
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<img src="images/placeholder.gif" class="profile-img photogrid-cd-border" />
							<h4>Pat Watson</h4>
							<span class="green-text">Communication Design</span><br />
							<span class="green-text"><i>Interactive Media</i></span> <br />
							<span class="orange-text">pwatson@csumb.edu</span> <br />
						</div>
					</div>
					<br />
				</div>
					
					<div class="col-xs-12 col-md-8">
						<br />
						
						 <p>As part of the Information Technology and Communication Design Bachelor\'s degree programs, all students complete two semesters of capstone classes (CST400 and CST401) and complete a capstone project. During the first semester, students choose a project, select a faculty capstone advisor and complete a detailed plan for the creation of their project. In the second semester the capstone project is completed.</p>

						<p>The capstone festival is where students present their finished projects to the School of ITCD faculty, CSUMB students and the broader community. Capstones for ITCD majors cover a wide spectrum of design and technical projects including complex web sites, programming projects, networking, animation, and visual identity packages. The projects are based on the student\'s emphasis in the major as well as the student\'s individual strengths and passions. </p>
						
					</div>	
					
				</div>';
	}

?>