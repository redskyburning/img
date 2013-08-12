function refreshImages(){
	$('.nav-item img').each(function(){
		
		var w = $(this).width();
		var h = $(this).height();
		var x = $(this).attr('data-fX');
		var y = $(this).attr('data-fY');
		var f = $(this).attr('data-orig').split('.');
		$(this).attr('src','out/'+f[0]+'_'+w+'_'+h+'_'+x+'_'+y+'.'+f[1]);
	});
}

$(window).load(function(){

	window.onresize = function(event) {
		wait = setTimeout(function(){
			refreshImages();			
		},100);
	}
	refreshImages();
});