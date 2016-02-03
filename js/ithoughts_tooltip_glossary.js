jQuery(document).ready(function($){
	$('a.glossary-hover').tooltip();
});

(function(){
	var lastPos;

	$d.ready(function(){

		// Handle clicking
		$('.atoz-clickable').click(function(){
			lastPos = $w.scrollTop();
			$('.atoz-clickable').removeClass('atozmenu-on').addClass('atozmenu-off');
			$(this).removeClass('atozmenu-off').addClass('atozmenu-on');
			var alpha = $(this).data('alpha');
			location.hash = alpha;

			$('.glossary-list').removeClass('atozitems-on').addClass('atozitems-off');
			$('.glossary-list-' + alpha).removeClass('atozitems-off').addClass('atozitems-on');
		});

		// Manual hash change - trigger click
		$w.bind('hashchange',function(event){
			var alpha = location.hash.replace('#','');
			$w.scrollTop(lastPos);
			location.hash = alpha;
			$('.atoz-clickable').filter(function(i){return $(this).data('alpha') == alpha;}).click();
			$('.ithoughts_tt_gl-please-select').hide();
		});

		// Page load hash management:
		//  - Look for first available if none specified
		//  - Trigger click if exists
		var myLocation = document.location.toString();
		var myAlpha    = '';
		if( myLocation.match('#') )
			myAlpha = myLocation.split('#')[1];
		if( ! myAlpha.length ){
			//myAlpha = $('.atoz-clickable:eq(0)').data('alpha');
			$('.atoz-clickable').removeClass('atozmenu-on').addClass('atozmenu-off');
			$('.glossary-list').removeClass('atozitems-on').addClass('atozitems-off');
			$('.ithoughts_tt_gl-please-select').show();
		}
		if( myAlpha.length ){
			$('.ithoughts_tt_gl-please-select').hide();
			$('.atoz-clickable').filter(function(i){return $(this).data('alpha') == myAlpha;}).click();
		}

	});
})();
