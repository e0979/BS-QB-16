require.config({
	baseUrl: URL+"public/js",
	requireDefine:true,
	waitSeconds:7,
	paths: {
	       jquery:[  'assets/jquery.min', '//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min'], // 2.0.0
			'async': 'assets/requirejs-plugins/async',    	       
	   },	
	    
	shim: {
		'jquery': {
            exports: '$'
        },
       
        'bootstrap.min': {
            deps: ['jquery'],
            exports: '$'
        },
         'assets/all': ['jquery'],
         'assets/bootstrap.min' : ['jquery'],
         'assets/jquery.validate.min': ['jquery'],
         'common': ['jquery','assets/all','assets/jquery-ui.min','assets/bootstrap.min','assets/jquery.validate.min','assets/jquery.easing.min','assets/jquery.scrollTo.min','assets/bootstrap-datetimepicker','assets/jquery.geocomplete.min','assets/moment.min','assets/fullcalendar.min','assets/jsonsql','functions','config'],
         'app/settings': ['jquery','common'],
         'app/settings': ['common']
       
	}
});
require([
        'jquery',
        'app/settings',       
    ],
    function($) {
    console.log("Loaded Main-Settings.js"); 
   }
);