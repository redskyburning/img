<?php
	// 

	include 'WideImage/WideImage.php';
	
	$jpgQ = 80;
	$pngQ = 6;
	
	$srcDir = 'src/';
	$outDir = 'out/';
	
	$src = isset($_GET['src']) ? $_GET['src'] : 'cat.jpg';
	
	$image = WideImage::load($srcDir.$src);
	
	$debug = isset($_GET['debug']) ? true : false;
	$save = isset($_GET['save']) ? true : false;
	
	$aspectH = isset($_GET['aH']) ? $_GET['aH'] : false; // Required
	$aspectW = isset($_GET['aW']) ? $_GET['aW'] : false; // Required
	$targetH = isset($_GET['tH']) ? $_GET['tH'] : false;
	$targetW = isset($_GET['tW']) ? $_GET['tW'] : false;
	$focalX = isset($_GET['fX']) ? $_GET['fX'] : 50;
	$focalY = isset($_GET['fY']) ? $_GET['fY'] : 50;
	
	$srcH = $image->getHeight();
	$srcW = $image->getWidth();
	$srcR = $srcW / $srcH;
	
	$targetR = ($targetW && $targetH) ? $targetW / $targetH : $aspectW / $aspectH;
	
	$cropH = (($srcR >= 1 && $targetR > 1) || ($srcR < 1 && $targetR >= 1));
	
	if($cropH){
		$targetW = ($targetW) ? $targetW : $srcW;
		$targetH = ($targetH) ? $targetH : floor($targetW / $targetR);
		$offset = floor((($srcH * $targetW / $srcW) - $targetH) * ($focalY / 100));
		$image = $image->resize($targetW,null)->crop(0,$offset,$targetW,$targetH);
	} else {
		$targetH = ($targetH) ? $targetH : $srcH;
		$targetW = ($targetW) ? $targetW : floor($targetH * $targetR);
		$offset = floor((($srcW * $targetH / $srcH) - $targetW) * ($focalX / 100));
		$image = $image->resize(null,$targetH)->crop($offset,0,$targetW,$targetH);
	}
	
	
	if(!$debug){
		$srcArr = explode('.',$src);
		$suff = strtolower(array_pop($srcArr));
		$stem = implode('.',$srcArr);
		$filename = $outDir.implode('_',[$stem,$targetW,$targetH,$focalX,$focalY]).'.'.$suff;
		
		if($suff == 'jpg'){
			if($save){	
				$image->saveToFile($filename, $jpgQ);
			}
			$image->output('jpg', $jpgQ);
		} else if($suff == 'png'){
			if($save){
				$image->saveToFile($filename, $pngQ);
			}
			$image->output('png',$pngQ);
		} else {
			if($save){
				$image->saveToFile($filename);
			}
			$image->output($suff);
		}
	} else {
		echo '<p>file: '.$src.'</p>';
		echo '<p>Src: '.$srcH.', '.$srcW.', '.$srcR.'</p>';
		echo '<p>Target: '.$targetW.', '.$targetH.' '.$targetR.'</p>';
	}
?>
