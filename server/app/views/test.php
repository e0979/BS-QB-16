<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo DB_ENCODE; ?>">

<title><?php echo $this->titulo; ?></title>
<!--CSS-->


<!--
<link rel="stylesheet" href="<?php echo CSS; ?>normalize.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>fonts.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>onecssgrid.css" />






-->

<link rel="stylesheet" href="<?php echo CSS; ?>flat-ui.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>bootstrap.css" />

<link rel="stylesheet" href="<?php echo CSS; ?>quinbi.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>animate.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>all.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>font-awesome.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


    
<script src="<?php echo JS; ?>bootstrap-datepicker.js"></script>


    
<script>
	
	$(document).ready(function() {
		 $('.datepicker').datepicker({})
	});
	
</script>


<?php echo @$this->js_head; ?>

<link rel="icon" type="image/png" href="<?php echo IMG; ?>favico.gif">



</head>
<body <?php //echo @$this->loadFunctions; ?>>
	<?php // include_once('nav.php'); ?>
	<div class="onepcssgrid-1200">	
    	<div id="container">
    		
    	<label>mm/dd/yy</label><br>
  <input id="date3" class="datepicker" data-date-format="dd/mm/yy" placeholder="dd/mm/yy">

    	</div>
    </div>
</body>
</html>