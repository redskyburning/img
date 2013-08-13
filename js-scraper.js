var childUrls = [];
var out = [];		
childCount = 0;

function checkCount(){
	if(++childCount == childUrls.length){
		console.log('done');
		console.log(JSON.stringify(out));
	}
}
				
$('#category_product_grid > li > a').each(function(){
	var href = 'http://www.stelladot.com'+$(this).attr('href');
	//console.log("h: "+href);
	childUrls.push(href);
});

for(i in childUrls){
	var c = childUrls[i];
	//console.log("c: "+c);
	var base = document.createElement('div');
	var data = $(base).load(c+' #view_container', 
	function(response){
		var images = [];
		$(this).find('.pdp_image_gallery_thumbs img').each(function(){
			var src = $(this).attr('src');	
			if(src){
				var re = new RegExp('cache/[^/]+/[^/]+/[^/]+/[^/]+/', "g");
				var str = src.replace(re,'');
				images.push(str);
			}		
			
		});
		
		var item = {
			'images'		: images,
			'title'			: $(this).find('#pdp_add_to_bag_form h2').html(),
			'price'			: $(this).find('#main_price_label').html(),
		};
			//'description'	: $(this).find('#product_description .expandable').html(),
		out.push(item);
		//console.log(item);
		checkCount();
	});
}