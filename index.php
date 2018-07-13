<!DOCTYPE html>
<html>
<head>
	<title>Home Page - Item Listing Page</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

	<!--Nav bar-->
	<nav class="navbar navbar-expand-lg navbar-light">
		 <div class="container">
		 	 <a class="navbar-brand upper" href="#">my awesome shop</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse align-items-end" id="navbarSupportedContent">
	   			 <ul class="navbar-nav ml-auto upper">
				      <li class="nav-item active">
				        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				      </li>

				      <li class="nav-item ">
				        <a class="nav-link" href="#">about</a>
				      </li>

				       <li class="nav-item ">
				        <a class="nav-link" href="#">contact</a>
				      </li>

				      <li class="nav-item">
				        <a class="nav-link" href="#">bag</a>
				      </li>
				</ul>
			  </div>
		 </div>
	</nav>

	<!--/Navbar Ends-->

	<!--Item Listing Container-->

	<div class="item-listing-container container-fluid">
		<div class="container">
			
			<ul id="ul-wrapper" style="display:flex ; list-style: none; flex-wrap: wrap ; width:100% ; height:auto ; padding-bottom:5% ; padding-left:0%; padding-top:10px;">
				
				
			
				<?php

			

				$col_count =0 ;
				$pageCount=1 ; //for initial page loading
				$api_url = "https://assignment-appstreet.herokuapp.com/api/v1/products?page=".$pageCount ;

				$contents = file_get_contents($api_url);

				$json_data = (json_decode($contents,true));

				foreach ($json_data as $key => $api_data) {
					
					foreach ($api_data as $api_data_name => $api_data_value) 
					{
			  						echo ' <li class="li-wrap">' ;
				  					echo '<div class="item-wrap">' ;
									foreach ($api_data_value['images'] as $image_index => $img_value) {
										echo "<img src='".$img_value."' alt='product_image' class='rounded fix-images'>" ;
										break;
									}
					
									echo '<p class="h6 product_name">'.substr($api_data_value['name'], 0 , strrpos($api_data_value['name'], '(')).'</p>' ;
									echo '<p class="h6 product_price"> &#8377;'.$api_data_value['mark_price'].'</p>';	

									echo '</div>' ;
									echo '</li>' ;
			  						
					}
				}
				?>

			</ul>	

		</div>
		
	</div>
	<!--/Item Listing the container-->

	<script>
		$(window).scroll(function(){
			var countNumber =2 ;
			if($(window).scrollTop() >= $(document).height() - $(window).height() - 500 )
			{
				//ajax call to a page to load dynamic data ;
				$.ajax({
				  
				  type:"GET",
				  url: "intermediate/moreContentLoader.php",
				  data: { 
				  		count: countNumber 
				   }
				}).done(function( msg ) {
				  	console.log(countNumber) ;
				  	countNumber++;
				  $("#ul-wrapper").append(msg) ;
				 
				});
				 
			}
		}) ;
	</script>

</body>
</html>