define(['globals', 'functions', 'app/login', 'app/dashboard'], function(globals, Functions, Login, dashboard ) {
	
	function run() {
		
		var currentLocation = Functions.getPage(globals.position);
	
		switch(currentLocation) {
			case 'dashboard':
				dashboard.run();
				break;
			default:
				Login.signin();
				break;
		}
	
	}
	

	return {
      run: run,
	}

});