function activateImage(image){
	var dpr = window.devicePixelRatio || 1;
	var w = Math.round(image.width() * dpr);
	var h = Math.round(image.height() * dpr);
	var x = image.attr('data-fX');
	var y = image.attr('data-fY');
	var f = image.attr('data-orig').split('.');
	
	image.attr('src','out/'+f[0]+'_'+w+'_'+h+'_'+x+'_'+y+'.'+f[1]);
	if(image.hasClass('img-unloaded')){
		image.removeClass('img-unloaded');
		image.addClass('img-loaded');
	}
}

function refreshImages(){
	$('.nav-item .img-loaded').each(function(){
		activateImage($(this));
	});
	lazyLoad();
}

function lazyLoad(threshold){
	var $w = $(window),
		th = threshold || 100,
		wt = $w.scrollTop(),
		wb = wt + $w.height();
		
	inview = $('.nav-item .img-unloaded').filter(function() {
		var $e = $(this),
			et = $e.offset().top,
			eb = et + $e.height();

		return eb >= wt - th && et <= wb + th;
	});
	
	inview.each(function(){
		activateImage($(this));
	});
}

$(window).load(function(){
	/* window.onresize = function(event) {
		wait = setTimeout(refreshImages,100);
	} */
	lazyLoad();
	//alert('w: ' + $(window).width() + ', h: '+ $(window).height());
});

$(window).scroll(function(){
	lazyLoad();
});