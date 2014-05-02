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
    <script src="js/dynamicschedule.js"></script>
    <?php include 'scripts/structure.php'; ?>
    
    <!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<!-- END FAVICON -->
	
	<style type="text/css">
		.map-container { 
			height: 500px;
		}
      #map-canvas { 
      	height: 100%; 
      	width: 100%;
      }
      #map-canvas img{max-width: inherit;}
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVhJVL_Po6V5Lzk3RYnpOYxA1v3KEBOrM&sensor=true">
    </script>
    <script type="text/javascript">
    	var map;
    	var you_marker;
    	var room_marker;
    	
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(36.6542302, -121.799859),
          zoom: 19
		  }
		  addYouMarker();
        
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
      
		var initialLocation;
		var siberia = new google.maps.LatLng(60, 105);
		var newyork = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
		var browserSupportFlag =  new Boolean();
      
      function addMarker(lat, lng, title) {      
      	if(typeof(room_marker) != "undefined") {
      		room_marker.setMap(null);
      	}
      	var myLatlng = new google.maps.LatLng(lat, lng);
      	  room_marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: title,
			icon: 'images/mapicon_orange.png'
		});
      }
      
      function addYouMarker() {
            
      	if(typeof(you_marker) != "undefined") {
      		room_marker.setMap(null);
      	}
      	
	  	if(navigator.geolocation) {
	  
			browserSupportFlag = true;
			navigator.geolocation.getCurrentPosition(function(position) {
		
			  initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			  
			  you_marker = new google.maps.Marker({
				 position: initialLocation,
				 map: map,
				 title: "Current Location",
				 icon: 'images/mapicon_green.png'
			   });
			   
			});
		}
				  
      }

    </script>

    
  </head>
  
  <body>

  	<div class="container">
  	
  		<div class="row" id="header">
  			<?php navigation("map", ""); ?>
  		</div>
		
		<div id="map">
			<div class="row sub-content">
				<?php sub_content_upnext(); ?>
			</div>
	
			<div class="row content">
				<?php map_content(); ?>
			</div>
		</div>
			
  	</div>
  	
  </body>
  
  <script>    
      $( ".map-displayinfo" ).click(function() {
      		$( ".map-displayinfo" ).removeClass('active');
      		$( this ).addClass('active');
      });
  	
  </script>
  
</html>