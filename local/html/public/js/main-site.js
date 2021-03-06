require.config({
  baseUrl: "http://localhost/QB/local/html/public/js",
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
          'assets/bootstrap.min' : ['jquery',],
          'assets/jquery.validate.min': ['jquery'],
          'assets/jquery.easing.min': ['jquery'],   
          'assets/jquery.scrollTo.min': ['jquery'], 
          'assets/jquery.dataTables.min': ['jquery'],
          'assets/select2.min': ['jquery'],
          'assets/jquery.maskedinput.min': ['jquery'],
          'assets/bootstrap-editable.min': ['jquery','assets/bootstrap.min'],

          'functions': ['jquery','assets/all','assets/jquery-ui.min','assets/bootstrap.min','assets/jquery.validate.min','assets/jquery.easing.min','assets/jquery.scrollTo.min','assets/moment.min','config'],
          'app/registration': ['jquery','functions', 'globals'],
          'app/site': ['jquery','functions', 'globals','app/login'],
          'app/login': ['jquery','functions', 'globals','assets/jquery.validate.min'],
          'app/forms': ['jquery', 'functions', 'globals', 'assets/bootstrap.min', 'assets/bootstrap-editable.min', 'assets/jquery.validate.min', 'assets/select2.min', 'assets/jquery.maskedinput.min'],
          'app/egresos': ['jquery', 'functions', 'globals','assets/jquery.validate.min', 'assets/jquery.dataTables.min','app/forms'],
          'app/dashboard': ['jquery','functions', 'globals','assets/jquery.validate.min', 'assets/select2.min'],
          'app/hashchange': ['jquery', 'globals', 'app/site', 'app/login', 'app/dashboard', 'app/forms'],

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