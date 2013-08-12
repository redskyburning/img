<?php

	include 'WideImage/WideImage.php';
	
	$pngQ = 2;
	
	$w = isset($_GET['w']) ? $_GET['w'] : false; 
	$h = isset($_GET['h']) ? $_GET['h'] : false; 
	
	$mainImage = WideImage::createTrueColorImage ( $w, $h );
	$mainImage = $mainImage->applyMask($mainImage,0,0);
	$mainImage->saveToFile('trans/'.$w.'x'.$h.'.png', $pngQ);
	$mainImage->output('png',$pngQ);
?>