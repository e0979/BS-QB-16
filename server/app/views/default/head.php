<!DOCTYPE html>
<html>
<head>
<meta charset="<?php echo DB_ENCODE; ?>">

<title><?php echo $this->titulo; ?></title>
<!--CSS-->

<link rel="stylesheet" href="<?php echo CSS; ?>normalize.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>fonts.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>onecssgrid.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>flat-ui.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>all.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>bootstrap.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>quinbi.css" />
<link rel="stylesheet" href="<?php echo CSS; ?>print.css" media="print" />
<link rel="stylesheet" href="<?php echo CSS; ?>animate.css" />


<link rel="stylesheet" href="<?php echo CSS; ?>font-awesome.min.css" />

<!-- ABOSULTAMENTE SI -->
<link href="<?php echo CSS; ?>bootstrap-editable.css" rel="stylesheet">
<!-- ABOSULTAMENTE SI -->


<script src="<?php echo JQUERY_LINK; ?>"></script>

<script src="<?php echo JS; ?>jquery.validate.min.js"></script> 
<script src="<?php echo JS; ?>jquery.maskedinput.min.js"></script>
<script src="<?php echo JS; ?>select2.min.js"></script>

<script src="<?php echo JS; ?>bootstrap.min.js"></script>
<script src="<?php echo JS; ?>jquery-ui.min.js"></script>
<script src="<?php echo JS; ?>jquery.easing.1.3.js"></script>




<script src="<?php echo JS; ?>jquery.bpopup.min.js"></script>
  
    <script src="<?php echo JS; ?>jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo JS; ?>jquery.ui.touch-punch.min.js"></script>
    
    <script src="<?php echo JS; ?>bootstrap-select.js"></script>
    <script src="<?php echo JS; ?>bootstrap-switch.js"></script>
    <script src="<?php echo JS; ?>flatui-checkbox.js"></script>
    <script src="<?php echo JS; ?>flatui-radio.js"></script>
    <script src="<?php echo JS; ?>jquery.tagsinput.js"></script>
    <script src="<?php echo JS; ?>jquery.placeholder.js"></script>
    <script src="<?php echo JS; ?>jquery.stacktable.js"></script>
    <script src="<?php echo JS; ?>application.js"></script>
    


<!-- ABOSULTAMENTE SI -->
<script src="<?php echo JS; ?>bootstrap-datepicker.js"></script>

<script src="<?php echo JS; ?>jquery.dataTables.js"></script>
<script src="<?php echo JS; ?>DT_bootstrap.js"></script>
<script src="<?php echo JS; ?>bootstrap-editable.js"></script>
<script src="<?php echo JS; ?>jquery.PrintArea.js"></script>
<!-- ABOSULTAMENTE SI -->



<script src="<?php echo JS; ?>common.js"></script>
<script src="<?php echo JS; ?>functions.js"></script>


<!--link rel="stylesheet" href="<?php echo URL; ?>public/textext/css/textext.core.css" />
<script src="<?php echo URL; ?>public/textext/js/textext.core.js"></script-->
    
    



<?php echo @$this->js_head; ?>

<link rel="icon" type="image/png" href="<?php echo IMG; ?>favico.gif">



</head>
<body <?php //echo @$this->loadFunctions; ?>>
	<?php include_once('nav.php'); ?>
	<div class="onepcssgrid-1200">	
    	<div id="container">
    	<?php $this -> render("default/persistents");  ?>