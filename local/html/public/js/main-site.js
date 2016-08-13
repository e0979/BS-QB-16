require.config({
  baseUrl: "http://localhost/Quinbi/local/html/public/js",
  requireDefine: true,
  waitSeconds:0,
  paths: {
          jquery:[  'assets/jquery.min'], // 2.0.0
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
          'assets/jquery.easing.min': ['jquery'],   
          'assets/jquery.scrollTo.min': ['jquery'], 
          'assets/jquery.dataTables.min': ['jquery'],
          'assets/select2.min': ['jquery'], 

          'functions': ['jquery','assets/all','assets/jquery-ui.min','assets/bootstrap.min','assets/jquery.validate.min','assets/jquery.easing.min','assets/jquery.scrollTo.min','assets/moment.min','config'],
          'app/registration': ['jquery','functions', 'globals'],
          'app/site': ['jquery','functions', 'globals','app/login'],
          'app/login': ['jquery','functions', 'globals','assets/jquery.validate.min'],
          'app/egresos': ['jquery', 'functions', 'globals','assets/jquery.dataTables.min',],
          'app/dashboard': ['jquery','functions', 'globals','assets/jquery.validate.min', 'assets/select2.min'],
          'app/hashchange': ['jquery', 'globals', 'app/site', 'app/login', 'app/dashboard'],

        }
      });
require([
  'jquery',
  'globals', 
  'app/hashchange',
  'app/site'
  ],
  function($, app, start, site ) { 
    site.run();
  }
);