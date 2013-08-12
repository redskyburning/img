<?php
	include('data.php');
	
	
	foreach ($sd_data as $item){
		foreach($item->images as $image){
			echo '<div><img src="'.$image.'" /></div>';
		}
	}
	
 ?>
 