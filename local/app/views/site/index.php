<?php $this -> render('default/preloader'); ?>
<div class="container-fluid site-home">
	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1 "></div>
		<div class="col-lg-10 col-md-10 col-sm-10 ">
			<h1>
				<div class="col-lg-6 col-md-6 col-sm-6 text-right">
					Encontrar un
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6  text-left row">
					<span class="rotate">Cardiólogo, Ginecólogo, Nutricionista, Veterinario, Odontólogo</span>
				</div>
				
				
			</h1>
			<h3 class="text-center">busca al médico que necesitas y pide una cita con comodidad</h3>
			<div class="text-center">
				<?php $this -> render('search/main-form'); ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 "></div>
	</div>
</div>
<div class="container-fluid whatisit">
	<div class="container">
		<div class="col-lg-4 col-md-4 col-sm-4 text-center">
			<img class="img-responsive" src="<?php echo IMG; ?>default-female.png">
			<h3>Bondad del servicio</h3>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 text-center">
			<img class="img-responsive" src="<?php echo IMG; ?>default-male.png">
			<h3>Bondad del servicio</h3>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 text-center">
			<img class="img-responsive" src="<?php echo IMG; ?>default-female.png">
			<h3>Bondad del servicio</h3>
		</div>	
	</div>
</div>

<!--div class="site-head animations">
	<div class="container text-center temporaryfademe">
		<h1 style="margin:auto; width: 670px;">
		<div class="text-right" style="float:left;">
			Encontrar un &nbsp;
		</div>
		<div class="text-left" style="float:left;">
			<span class="rotate">Cardiólogo, Ginecólogo, Nutricionista, Veterinario, Odontólogo</span>
		</div></h1>
		<div class="clearfix"></div>
		<h3>busca al médico que necesitas y solicita una cita con comodidad</h3>
		<?php $this -> render('search/main-form'); ?>
	</div>
	<div class="clearfix"></div>
</div-->
<div id="templates">
	<?php $this -> render('mockups/filters'); ?>
	<?php $this -> render('mockups/item-card'); ?>
</div>
<div id="results"></div>

<?php $this -> render('site/forms/register'); ?>



