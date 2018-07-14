<?php

	$product_unique_id = $_GET['_id'];

	$api_desc_url = "https://assignment-appstreet.herokuapp.com/api/v1/products/".$product_unique_id ;

	$product_desc = file_get_contents($api_desc_url);

	$product_json_data = (json_decode($product_desc,true)); 

	//fetch the data 

	$found = false ;

	//pick product_desc
	$sign = array();
	
	$product_description = $product_json_data['primary_product']['desc'] ;

	
	foreach ($product_json_data['product_variations'] as $key => $value) {
		foreach ($value as $identifiers => $pv_value) {
				
				//echo $identifiers." : ".$pv_value."<br />" ;

				if($pv_value === $product_unique_id)
				{	

					$product_name = $value['name'];
					$product_market_price = $value['mark_price'];
					$product_sale_price = $value['sale_price'] ;
					$product_sale_perc = $value['sale_msg'] ;
					foreach( $value['sign'] as $key=> $val)
					{
						array_push($sign, $val);
					}
					$found = true ;
					break;
				}
			}
			if($found) break;		
	}

	//fetch product variations
	$attribute_color = array();
	$attribute_storage = array() ;

	

	foreach ($product_json_data['attributes'] as $key => $value) {
		foreach ($value as $attribute_key => $attribute_value) {
			//id 
			//name of that

			if($attribute_key==="name" && $attribute_value === "Storage")
			{
				
				//go to options and find how many storage variants are there of our product
				foreach ($product_json_data['options'] as $option_index => $option_array) {
					foreach ($option_array as $option_array_key => $option_array_value) {
						if($option_array_key==="attrib_id" && $option_array_value===$value["_id"])
						{
							//echo "Storage is : ".$option_array["name"]."<br />";
							//array_push($attribute_storage[$j++],$option_array["name"]);
							$attribute_storage[$option_array["name"]] = $option_array["_id"];
						}
					}
				}
			}
			elseif($attribute_key==="name" && $attribute_value === "Colour")
			{
				
				//go to options and find how many storage variants are there of our product
				foreach ($product_json_data['options'] as $option_index => $option_array) {
					foreach ($option_array as $option_array_key => $option_array_value) {
						if($option_array_key==="attrib_id" && $option_array_value===$value["_id"])
						{
							//echo "Storage is : ".$option_array["name"]."<br />";
							//$attribute_color[$k++][0] = $option_array["name"];
							$attribute_color[$option_array["name"]] = $option_array["_id"];
						}
					}
				}
			}
	}

}


$number_color_variant = sizeof($attribute_color);
$number_storage_variant = sizeof($attribute_storage);

function color_name_to_hex($color_name)
{
    
    $colors  =  array(
	    'rosegold'=>'B76E79',
        'aliceblue'=>'F0F8FF',
        'antiquewhite'=>'FAEBD7',
        'aqua'=>'00FFFF',
        'aquamarine'=>'7FFFD4',
        'azure'=>'F0FFFF',
        'beige'=>'F5F5DC',
        'bisque'=>'FFE4C4',
        'black'=>'000000',
        'blanchedalmond '=>'FFEBCD',
        'blue'=>'0000FF',
        'blueviolet'=>'8A2BE2',
        'brown'=>'A52A2A',
        'burlywood'=>'DEB887',
        'cadetblue'=>'5F9EA0',
        'chartreuse'=>'7FFF00',
        'chocolate'=>'D2691E',
        'coral'=>'FF7F50',
        'cornflowerblue'=>'6495ED',
        'cornsilk'=>'FFF8DC',
        'crimson'=>'DC143C',
        'cyan'=>'00FFFF',
        'darkblue'=>'00008B',
        'darkcyan'=>'008B8B',
        'darkgoldenrod'=>'B8860B',
        'darkgray'=>'A9A9A9',
        'darkgreen'=>'006400',
        'darkgrey'=>'A9A9A9',
        'blackgrey'=>'403939',
        'darkkhaki'=>'BDB76B',
        'darkmagenta'=>'8B008B',
        'darkolivegreen'=>'556B2F',
        'darkorange'=>'FF8C00',
        'darkorchid'=>'9932CC',
        'darkred'=>'8B0000',
        'darksalmon'=>'E9967A',
        'darkseagreen'=>'8FBC8F',
        'darkslateblue'=>'483D8B',
        'darkslategray'=>'2F4F4F',
        'darkslategrey'=>'2F4F4F',
        'darkturquoise'=>'00CED1',
        'darkviolet'=>'9400D3',
        'deeppink'=>'FF1493',
        'deepskyblue'=>'00BFFF',
        'dimgray'=>'696969',
        'dimgrey'=>'696969',
        'dodgerblue'=>'1E90FF',
        'firebrick'=>'B22222',
        'floralwhite'=>'FFFAF0',
        'forestgreen'=>'228B22',
        'fuchsia'=>'FF00FF',
        'gainsboro'=>'DCDCDC',
        'ghostwhite'=>'F8F8FF',
        'gold'=>'FFD700',
        'goldenrod'=>'DAA520',
        'gray'=>'808080',
        'green'=>'008000',
        'greenyellow'=>'ADFF2F',
        'grey'=>'808080',
        'honeydew'=>'F0FFF0',
        'hotpink'=>'FF69B4',
        'indianred'=>'CD5C5C',
        'indigo'=>'4B0082',
        'ivory'=>'FFFFF0',
        'khaki'=>'F0E68C',
        'lavender'=>'E6E6FA',
        'lavenderblush'=>'FFF0F5',
        'lawngreen'=>'7CFC00',
        'lemonchiffon'=>'FFFACD',
        'lightblue'=>'ADD8E6',
        'lightcoral'=>'F08080',
        'lightcyan'=>'E0FFFF',
        'lightgoldenrodyellow'=>'FAFAD2',
        'lightgray'=>'D3D3D3',
        'lightgreen'=>'90EE90',
        'lightgrey'=>'D3D3D3',
        'lightpink'=>'FFB6C1',
        'lightsalmon'=>'FFA07A',
        'lightseagreen'=>'20B2AA',
        'lightskyblue'=>'87CEFA',
        'lightslategray'=>'778899',
        'lightslategrey'=>'778899',
        'lightsteelblue'=>'B0C4DE',
        'lightyellow'=>'FFFFE0',
        'lime'=>'00FF00',
        'limegreen'=>'32CD32',
        'linen'=>'FAF0E6',
        'magenta'=>'FF00FF',
        'maroon'=>'800000',
        'mediumaquamarine'=>'66CDAA',
        'mediumblue'=>'0000CD',
        'mediumorchid'=>'BA55D3',
        'mediumpurple'=>'9370D0',
        'mediumseagreen'=>'3CB371',
        'mediumslateblue'=>'7B68EE',
        'mediumspringgreen'=>'00FA9A',
        'mediumturquoise'=>'48D1CC',
        'mediumvioletred'=>'C71585',
        'midnightblue'=>'191970',
        'mintcream'=>'F5FFFA',
        'mistyrose'=>'FFE4E1',
        'moccasin'=>'FFE4B5',
        'navajowhite'=>'FFDEAD',
        'navy'=>'000080',
        'oldlace'=>'FDF5E6',
        'olive'=>'808000',
        'olivedrab'=>'6B8E23',
        'orange'=>'FFA500',
        'orangered'=>'FF4500',
        'orchid'=>'DA70D6',
        'palegoldenrod'=>'EEE8AA',
        'palegreen'=>'98FB98',
        'paleturquoise'=>'AFEEEE',
        'palevioletred'=>'DB7093',
        'papayawhip'=>'FFEFD5',
        'peachpuff'=>'FFDAB9',
        'peru'=>'CD853F',
        'pink'=>'FFC0CB',
        'plum'=>'DDA0DD',
        'powderblue'=>'B0E0E6',
        'purple'=>'800080',
        'red'=>'FF0000',
        'rosybrown'=>'BC8F8F',
        'royalblue'=>'4169E1',
        'saddlebrown'=>'8B4513',
        'salmon'=>'FA8072',
        'sandybrown'=>'F4A460',
        'seagreen'=>'2E8B57',
        'seashell'=>'FFF5EE',
        'sienna'=>'A0522D',
        'silver'=>'C0C0C0',
        'skyblue'=>'87CEEB',
        'slateblue'=>'6A5ACD',
        'slategray'=>'708090',
        'slategrey'=>'708090',
        'snow'=>'FFFAFA',
        'springgreen'=>'00FF7F',
        'steelblue'=>'4682B4',
        'tan'=>'D2B48C',
        'teal'=>'008080',
        'thistle'=>'D8BFD8',
        'tomato'=>'FF6347',
        'turquoise'=>'40E0D0',
        'violet'=>'EE82EE',
        'wheat'=>'F5DEB3',
        'white'=>'FFFFFF',
        'whitesmoke'=>'F5F5F5',
        'yellow'=>'FFFF00',
        'yellowgreen'=>'9ACD32');

    $color_name = strtolower(str_replace(' ' , '' , $color_name));
    if (isset($colors[$color_name]))
    {
        return ('#' . $colors[$color_name]);
    }
    else
    {
        return ($color_name);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Desc </title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/item.css">
		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script defer src="js/jquery.flexslider.js"></script>
	<link rel="stylesheet" type="text/css" href="css/flexslider.css">

</head>
<body>

	
	<nav class="navbar navbar-expand-lg navbar-light">
		 <div class="container">
		 	 <a class="navbar-brand upper" href="index.php">my awesome shop</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse align-items-end" id="navbarSupportedContent">
	   			 <ul class="navbar-nav ml-auto upper">
				      <li class="nav-item active">
				        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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

	

	

	<div class="container-fluid desc-wrapper">
		<div class="container">
			<div class="single-main">
				<div class="col-lg-12">
					<div class="col-lg-6">

						<div class="flexslider">

							<ul class="slides">

								<?php

										foreach ($product_json_data['product_variations'] as $key => $value) {
											foreach ($value as $identifiers => $pv_value) {

											if($pv_value===$product_unique_id)
											{
												foreach ($value["images"] as $img_index => $img_link) {
													
													echo '<li data-thumb="'.$img_link.'">
														<img class="img-fluid" src="'.$img_link.'"/>
													</li>';
													
												}
												 break;		
											}
											}
										}

								?>
								
								

								
							</ul>

							<script>
								// Can also be used with $(document).ready()
								$(window).load(function() {
								  $('.flexslider').flexslider({
								    animation: "slide",
								    controlNav: "thumbnails"
								  });
								});
							</script>

						</div>
					</div>

					<div class="col-lg-6 section-left">
							
							<div class="top_break_line" style="display: none;"></div>
							<p class="h3 product_heading"><?php echo  substr($product_name, 0 , strrpos($product_name, '(')) ;?></p>
							<div class="small_line"></div>
							<div class="product_description">
								<?php  echo $product_description;?>
							</div>

							<div class="more">
								+ More
							</div>

							<div class="break_line"></div>

							<div class="price_detail">
								<div class="price">
									<span class="disc_price">&#8377;&nbsp;<?php echo number_format($product_sale_price); ?></span>
									<span class="cur_price">&#8377; <?php echo number_format($product_market_price); ?></span>
								</div>
								<div class="discount">
									<span>You save </span>
									<span> &#8377; <?php echo number_format($product_market_price-$product_sale_price);?> </span>
									<span>(<?php echo $product_sale_perc;?>)</span>
								</div>

								<div class="taxes">
									Local taxes included (where applicable)
								</div>
							</div>

							<div class="break_line"></div>

							<div class="variation">
								<div class="var_col">
									<?php  echo $number_color_variant ; ?> color available
								</div>
								<div class="color">

									<?php

										foreach ($attribute_color as $key => $value) 
										{
												echo '
														<div class="col_detail ';
														for($i=0 ; $i<sizeof($sign); $i++)
															if($value==$sign[$i])
																	echo "col_detail_selected" ;
														echo '">
															<div class="col_col" style="background-color:'.color_name_to_hex($key).';"></div>
															<div class="col_name">&nbsp;'.$key.'</div>
														</div>
												';
										}
									
									

									?>
								</div>

								<div class="size_var">
									<?php echo $number_storage_variant ; ?> Storage available
								</div>
								<div class="size_chart">
									<?php

										foreach ($attribute_storage as $key => $value) 
										{
												echo '
														<div class="size_wrap ';
														for($i=0 ; $i<sizeof($sign); $i++)
															if($value==$sign[$i])
																	echo "col_detail_selected" ;
														echo '">'.$key.'</div>
												';
										}
									
									

									?>

									
									
								</div>
								<div class="qty">
									<div>Quantity</div>
									<div class="sel_qty">
										<div>-</div>
										<div>1</div>
										<div>+</div>
									</div>
								</div>

								<div class="add_cart">
									Add to cart
								</div>


							</div>

						

						
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>



	<div class="footer">
		<div class="container">
			<span>About</span>
			<span>|</span>
			<span>Contact</span>
			<span>|</span>
			<span>Privacy Policy</span>
			<span>|</span>	
			<span>Return Policy</span>
		</div>
		
	</div>


</body>
<script type="text/javascript" src="js/contentHide.js"></script>
</html>
