define(['globals', 'functions', 'app/login'], function(globals, Functions, Login ) {
	
	function run() {
		
	var currentLocation = Functions.getPage(1);
	
		switch(currentLocation) {
			default:
				Login.signin();
				break;
		}
	
	}
	
	

	

	return {
      run: run,
	}

});