<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8"/>
  <head>
  
    <title>ITCD Capstone Festival</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- BOOTSTRAP -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>		
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
    <script src="js/jquery.shuffle.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    
    <script>
		$(document).ready(function() {
			$(".project-list").tablesorter(); 

			/* initialize shuffle plugin */
			var $grid = $('#grid');

			$grid.shuffle({
				itemSelector: '.item' // the selector for the items in the grid
			});
			
			opts = {};
			opts = {
			  	by: function($el) {
					return $el.data('title').toLowerCase();
			  	}
			};
			
			$grid.shuffle('sort', opts);

			/* reshuffle when user clicks a filter item */
			$('.showing a').click(function (e) {
				e.preventDefault();

				// set active class
				$('.showing a').removeClass('active');
				$(this).addClass('active');
			
				if( $('.project-list').is(':hidden') ) {

					// get group name from clicked item
					var groupName = $(this).attr('data-group');
					console.log( $(this).attr('data-major')  + " " + groupName );
					
					// reshuffle grid
					$grid.shuffle('shuffle', groupName );
				} else {
					var groupName = $(this).attr('data-group');
					
					if(groupName === "all") {
						$('.project-list tbody tr').show(500)
					} else {
						$('.project-list tbody tr').each( function() {
							if( $(this).attr('data-major') != groupName ) {
								$(this).hide(500);
							} else {
								$(this).show(500);
							}						
						});
					}
				}
			});

			// Sorting options
			$('.sorting a').click(function(e) {
				e.preventDefault();
				
				$('.sorting a').removeClass('active');
				$(this).addClass('active');
				
				if( $('.project-list').is(':hidden') ) {
				
					opts = {};
				
					if ( $(this).attr('data-group') === 'title' ) {
					
						$( ".photogrid" ).each(function( index ) {
							$(this).find(".photogrid-tooltip").html( $(this).attr('data-title') );
						});
						
						$( ".photogrid-duplicate" ).css("display", "none");
						opts = {
						  by: function($el) {
							return $el.data('title');
						  }
						};
					  } else if ( $(this).attr('data-group') === 'major' ) {
					  
						$( ".photogrid" ).each(function( index ) {
							$(this).find(".photogrid-tooltip").html( $(this).attr('data-title') );
						});
						
						$( ".photogrid-duplicate" ).css("display", "none");
						opts = {
						  by: function($el) {
						  	console.log($el.data('groups')[1].toLowerCase());
							return $el.data('groups')[1].toLowerCase();
						  }
						};
					  } else if ( $(this).attr('data-group') === 'name' ) {
					  
						$( ".photogrid" ).each(function( index ) {
							$(this).find(".photogrid-tooltip").html( $(this).attr('data-names') );
						});
						
						$( ".photogrid-duplicate" ).css("display", "block");
						opts = {
						  by: function($el) {
							return $el.data('names');
						  }
						};
					  } else if ( $(this).attr('data-group') === 'presgroup' ) {
					
						$( ".photogrid" ).each(function( index ) {
							if($(this).attr('data-presgroup') == 1) {
								$(this).find(".photogrid-tooltip").html('9:00am - 9:50am');
							} else if($(this).attr('data-presgroup') == 2) {
								$(this).find(".photogrid-tooltip").html('10:00am - 10:50am');
							} else if($(this).attr('data-presgroup') == 3) {
								$(this).find(".photogrid-tooltip").html('11:00am - 11:50am');
							} else if($(this).attr('data-presgroup') == 4) {
								$(this).find(".photogrid-tooltip").html('12:00pm - 12:50pm ');
							} else if($(this).attr('data-presgroup') == 5) {
								$(this).find(".photogrid-tooltip").html('1:00pm - 1:50pm ');
							}
						});
						
						$( ".photogrid-duplicate" ).css("display", "none");
						opts = {
						  by: function($el) {
							return $el.data('presgroup');
						  }
						};
					  }  else if ( $(this).attr('data-group') === 'posterroom' ) {
					  
						$( ".photogrid" ).each(function( index ) {
							$(this).find(".photogrid-tooltip").html( "#" + $(this).attr('data-posterroom') );
						});
						
						$( ".photogrid-duplicate" ).css("display", "none");
						opts = {
						  by: function($el) {
							return $el.data('posterroom');
						  }
						};
					  } else {
						console.log( "Group not matched: " + $(this).attr('data-group') );
					  }
				  
					$grid.shuffle('sort', opts);
				} else {
					e.preventDefault();
				
					$('.sorting a').removeClass('active');
					$(this).addClass('active');
			
					if ( $(this).attr('data-group') === 'title' ) {
						var sorting = [[1,0],[3,0]]; 
					  } else if ( $(this).attr('data-group') === 'major' ) {
						var sorting = [[2,0],[3,0]]; 
					  } else if ( $(this).attr('data-group') === 'name' ) {
						var sorting = [[6,0],[5,0]]; 
					  } else if ( $(this).attr('data-group') === 'presgroup' ) {
						var sorting = [[3,0],[1,0]]; 
					  }  else if ( $(this).attr('data-group') === 'posterroom' ) {
						var sorting = [[4,0],[1,0]]; 
					  } else {
						alert("You done goofed son");
					  }
				  
					$('.project-list').trigger("sorton",[sorting]);
				}
			});
		});
	</script>
	
    <?php include 'scripts/structure.php'; ?>
    
    <!-- FAVICON -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<!-- END FAVICON -->
    
  </head>
  
  <body>

  	<div class="container">
  	
  		<div class="row" id="header">
  			<?php navigation("projects", "list"); ?>
  		</div>
		
		<div id="projects">
			<div class="row sub-content">
				<?php sub_content_projects(); ?>
			</div>
	
			<div class="row content" id="main">
				<?php projects_grid(); ?>
				<?php projects_list(); ?>
			</div>
		</div>
			
  	</div>
  	
  </body>
  
  <script>
  	$( ".photogrid" ).mouseenter(function() {
			$( ".photogrid-hovertext" ).css('visibility', 'hidden');
			$( this ).children( ".photogrid-hovertext" ).css('visibility', 'visible');
		});
		
		$( ".photogrid-hovertext" ).mouseleave(function() {
			$( ".photogrid-hovertext" ).css('visibility', 'hidden');
		});
	
	$( ".show-grid" ).click(function() {
		$( ".project-list" ).hide(500);
		$( ".project-grid" ).show(500);
		$( ".show-list" ).removeClass("active");
		$( this ).addClass("active");
	});
	
	$( ".show-list" ).click(function() {
		$( ".project-grid" ).hide(500);
		$( ".project-list" ).show(500);
		$( ".show-grid" ).removeClass("active");
		$( this ).addClass("active");
	});
  </script>
  
</html>