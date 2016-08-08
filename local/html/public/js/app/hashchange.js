define(function() {
	
	var cache = {
		'' : $('.default'), //title: "<?= $page->attr['title'] ?>", elem: $('.site-head')
	};
	
	$(window).bind('hashchange', function () {
		var url = $.param.fragment();
		// Hide any visible ajax content.
		$('#mainarea').children(':visible').hide();
		$('#mainarea').children('.nohide').show();
		
		if (cache[url]) {
			cache[url].show();	$('.preloader').fadeOut();			
		} else {
			$('.preloader').show();			
			//show preloader per request -- This is not related to first login preloader
			
			var active_page = url.split('/');
			switch(active_page[0]) {
					case "search":
					require(['app/search'], function(Search) {							
						Search.searchDoctor();
					});	
					break;
				case "doctor":
					$('<div class="view"/>').appendTo('#mainarea').load(URL+url, function(){
						require(['app/doctor'], function(Doctor) {
							switch(active_page[1]) {
								case 'profile':
								Doctor.profile();
								break;
							}
						}); 											
					});
					break;
				default:
					$('<div class="view"/>').appendTo('#mainarea').load(URL+url, function(){

					});
					console.log("is me");
					break;
			}
			$('.preloader').fadeOut();		
			
			
		}
		
	});
	// Trigger and Handle the hash the page may have loaded with
	$(window).trigger('hashchange');
	
});