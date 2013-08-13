<?php include('data.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/root.css">

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
		<?php
			function resizeUrl($file,$save = false,$w = 150,$h = 150,$x = 50,$y = 50){
				$file = explode('.',$file);
				$saveStr = ($save) ? 'out' : 'tmp';
				return '/img/'.$saveStr.'/'.$file[0].'_'.$w.'_'.$h.'_'.$x.'_'.$y.'.'.$file[1];
			}
			
			function image($file,$w,$h,$x = 50,$y = 50){
				$parts = explode('/',$file);
				$local = $parts[count($parts) - 1];
				return '<img class="product-img img-unloaded" src="trans/'.$w.'x'.$h.'.png" width="'.$w.'" height="'.$h.'" data-orig="'.$local.'" data-fX="'.$x.'" data-fY="'.$y.'" />';
			}
			
			
		
			$dir = $_SERVER['DOCUMENT_ROOT'].'/img/src';
			$files = array_diff(scandir($dir), array('..', '.'));
		?>
		<div class="nav-list">
			
				<?php foreach($sd_data as $item): ?><div class="nav-item">
					<div class="item-image">
						<?= image($item->images[0],3,3,0,100) ?>
					</div>
					<!--<div class="item-description">
						<?= $item->title ?>
					</div>-->
				</div><?php endforeach ?>
				
		</div>
		<!--<div id="item-detail">
			<div id="detail-fader">&nbsp;</div>
			<div id="detail-body">
				<p>At a signal from Dak Kova the doors of two cages were thrown open and a dozen green Martian females were driven to the center of the arena. Each was given a dagger and then, at the far end, a pack of twelve calots, or wild dogs were loosed upon them.</p>
			</div>
		</div>-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="js/main.js"></script>
    </body>
</html>
