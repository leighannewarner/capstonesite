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
    
    <link rel="stylesheet" media="only screen and (max-width: 768px)" href="css/mobile.css" />
	<link href="//fonts.googleapis.com/css?family=Carrois+Gothic:400" rel="stylesheet" type="text/css">
    <?php include 'scripts/structure.php'; ?>
    <script src="js/dynamicschedule.js"></script>
    
    <!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<!-- END FAVICON -->
    
  </head>
  
  <body>

  	<div class="container">
  	
  		<div class="row" id="header">
  			<?php navigation("schedule", ""); ?>
  		</div>
		
		<div id="projects">
			<div class="row sub-content">
				<?php sub_content_upnext(); ?>
			</div>
	
			<div class="row content" id="main">
				<?php schedule_content(); ?>
			</div>
		</div>
			
  	</div>
  	
  	<script>
  		var day;
  		var userSelectedMoreInfo = false;
  		$(document).ready(function() {
  			year = $(".schedule-year").html();
  			month = $(".schedule-month").html();
  			day = $(".schedule-day").html();
  		});
  		
  		function checkTime(start) {
  			current = new Date();
  			next = new Date(year, Number(month)-1, day, start, 0, 0, 0);

  			if(checkDay()) {
  				//console.log("Current time: " + current.getHours() + " \nChecking time: " + next.getHours());
				if(current.getHours() - next.getHours() == -1 && current.getMinutes() > 50) {
					return true;
				} else if (current.getHours() == next.getHours() && current.getMinutes() <= 50) {
					return true;
				}
  			}
  			
  			return false;
  		}
  		
  		function checkDay() {
  			currentday = new Date();
  			nextday = new Date(year, Number(month)-1, day, 0, 0, 0, 0);
  			if(currentday.getFullYear() == nextday.getFullYear()) {
  				if(currentday.getMonth() == nextday.getMonth()) {
  					if(currentday.getDay() == nextday.getDay()) {
  						return true;
  					}
  				}
  			}
  			
  			return false;
  		}
  		
  		function showMoreInfo(moreinfoid) {
  			$( ".schedule-moreinfo" ).css("display", "none");
			$( "#" + moreinfoid ).css("display", "block");
  		}
  		
  		function addActiveClassToSchedule() {
			$( ".schedule-list dt" ).each(function (index) {
				var time = 0;
				var ampm = "";
				if ($( this ).text()[1] != ':') {
					time = $( this ).text()[0] + $( this ).text()[1];
					ampm = $( this ).text()[5];
				} else {
					time = ($( this ).text()[0]);
					ampm = $( this ).text()[4];
				}
			
				militarytime = 0;
				if (ampm == "p" && time != 12) {
					militarytime = Number(time) + 12;
				} else {
					militarytime = time;
				}
			
				if(checkTime(militarytime)) {
					$( this ).addClass("active");
					$( this ).next("dd").addClass("active");
					
					if( !userSelectedMoreInfo ) {
						$( ".arrow" ).removeClass("active");
						$( this ).children(".arrow").addClass("active");
						moreinfoid = $( this ).data( "moreinfoid" );
						showMoreInfo( moreinfoid );
					}
					
				} else {
					$( this ).removeClass("active");
					$( this ).next("dd").removeClass("active");
				}
			});
  		}
  		
  		$( ".schedule-list dt" ).click( function() {
  			userSelectedMoreInfo = true;
  			$( ".arrow" ).removeClass("active");
			$( this ).children(".arrow").addClass("active");
  			moreinfoid = $( this ).data( "moreinfoid" );
  			showMoreInfo(moreinfoid);
  			
  		});
  		  		
  		function init() {
  			addActiveClassToSchedule();
  			updateUpNext();
  		}
  		
  		window.setInterval("addActiveClassToSchedule()", 10000);
  		window.setInterval("updateUpNext()", 10000);
  		 
  		window.onload=function(){ init() };

  	</script>
  	
  </body>
  
</html>