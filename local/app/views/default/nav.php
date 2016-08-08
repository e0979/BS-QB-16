<header>
	<nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class=" hidden-xs col-sm-1 col-lg-1">
            </div>
            <div class="col-xs-5 col-lg-5">
           	<a href="<?php echo URL; ?>"><img src="<?php echo IMG; ?>okidoc-logo-full-white.png" class="img-responsive"></a>
           </div>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!--li class="active"><a href="#">Home</a></li-->               
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
				<li><a href="<?php echo URL; ?>site/login" class="btn btn-default btn-login"><?php echo SITE__LOG_IN; ?></a></li>
				<li><button class="btn btn-register-outline" data-toggle="modal" data-target="#signin"><?php echo SITE__SIGN_IN; ?></button></li>
            </ul>
        </div>
    </nav>
</header>