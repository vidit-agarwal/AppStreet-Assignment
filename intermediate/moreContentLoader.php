<?php
	
	$pgCount = $_GET['count'] ;

	
	$col_count =0 ;
	
	$api_url = "https://assignment-appstreet.herokuapp.com/api/v1/products?page=".$pgCount ;

	$contents = file_get_contents($api_url);

	$json_data = (json_decode($contents,true));

	$returnVal ='' ;

	foreach ($json_data as $key => $api_data) {
		
		foreach ($api_data as $api_data_name => $api_data_value) 
		{
  						$returnVal.= ' <li class="li-wrap">' ;
	  					$returnVal.= '<div class="item-wrap">' ;
						foreach ($api_data_value['images'] as $image_index => $img_value) {
							$returnVal.= "<img src='".$img_value."' alt='product_image' class='rounded fix-images'>" ;
							break;
						}
		
						$returnVal.= '<p class="h6 product_name">'.substr($api_data_value['name'], 0 , strrpos($api_data_value['name'], '(')).'</p>' ;
						$returnVal.= '<p class="h6 product_price"> &#8377;'.$api_data_value['mark_price'].'</p>';	

						$returnVal.= '</div>' ;
						$returnVal.= '</li>' ;
  						
		}
	}
	echo $returnVal;		



?>