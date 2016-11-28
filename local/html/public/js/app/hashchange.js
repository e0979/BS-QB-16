define(function() {
	
	var cache = {
		'' : $('.default'), //title: "<?= $page->attr['title'] ?>", elem: $('.site-head')
	};
	
	$(window).bind('hashchange', function () {
		var url = $.param.fragment();
		// Hide any visible ajax content.
		$('#mainarea').children(':visible').hide();
		//$('#mainarea').children('.nohide').show();
		if (cache[url]) {
			cache[url].show();	
			$('.preloader').fadeOut();			
		} else {
			$('.preloader').show();			
			
			var active_page = url.split('/');
			console.log(active_page[0] + " ACTIVE_page");
			console.log(url);
			//Version 1
			cache[url] = $('<div class="view"/>').appendTo('#mainarea').load('../'+url, function() {
				switch(active_page[0]) {
					
					/*case "doctor":
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
					*/
					default:
						var controler = active_page[0];
						require(['app/'+controler], function(controler) {
							controler.run();
						});
						switch(active_page[1]) {
							default:
								/*var controler2 = active_page[0]
								require(['app/'+controler2], function(controler2) {
									controler2.run();
								});*/
							break;
						}
						break;
				}
			});

			//Version 2
			/*switch(active_page[0]) {
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
					var controler = active_page[0];
					require(['app/'+controler], function(controler) {
						controler.run();
					});
					break;
			}*/
			$('.preloader').fadeOut();		
			
			
		}
		
	});
	// Trigger and Handle the hash the page may have loaded with
	$(window).trigger('hashchange');
	
});