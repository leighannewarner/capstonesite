<!DOCTYPE html>
<html lang="en">
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
				reverse: true,
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
						$( ".photogrid-duplicate" ).css("display", "none");
						opts = {
						  reverse: true,
						  by: function($el) {
							return $el.data('title');
						  }
						};
					  } else if ( $(this).attr('data-group') === 'major' ) {
						$( ".photogrid-duplicate" ).css("display", "none");
						opts = {
						  by: function($el) {
							return $el.data('major').toLowerCase();
						  }
						};
					  } else if ( $(this).attr('data-group') === 'name' ) {
						$( ".photogrid-duplicate" ).css("display", "block");
						opts = {
						  by: function($el) {
							return $el.data('names')[0];
						  }
						};
					  }else {
						alert("You done goofed son");
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
						var sorting = [[4,0],[3,0]]; 
					  }else {
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
	
			<div class="row content">
				<?php projects_grid(); ?>
				<table class="project-list">
					<thead>
					<tr>
						<th>
							Icon
						</th>
						<th>
							Project Title
						</th>
						<th>
							Major
						</th>
						<th>
							First Name
						</th>
						<th>
							Last Name
						</th>
					</tr>
					</thead>
					<tbody>
					<tr data-major="inter" >
						<td>
							<img src="projects/origin/origin.png" />
						</td>
						<td>
							Origin: The Game
						</td>
						<td>
							Communication Design: Interactive Media
						</td>
						<td>
							Ezequiel
						</td>
						<td>
							Gatica
						</td>
					</tr>
					<tr data-major="inter" >
						<td>
							<img src="projects/origin/origin.png" />
						</td>
						<td>
							Origin: The Game
						</td>
						<td>
							Computer Science & Information Technology: Software Engineering
						</td>
						<td>
							Leigh Anne
						</td>
						<td>
							Warner
						</td>
					</tr>
					<tr data-major="cd" >
						<td>
							<img src="images/placeholder.gif" />
						</td>
						<td>
							Project A
						</td>
						<td>
							Communication Design: Web Development
						</td>
						<td>
							John
						</td>
						<td>
							Doe
						</td>
					</tr>
					<tr data-major="csit" >
						<td>
							<img src="images/placeholder.gif" />
						</td>
						<td>
							Project B
						</td>
						<td>
							Computer Science & Information Technology: Networking & Security
						</td>
						<td>
							Jane
						</td>
						<td>
							Doe
						</td>
					</tr>
					</tbody>
				</table>
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