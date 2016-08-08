<?php foreach ($this->info as $Info) { ?>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
	</div>
	<div class="col-sm-6 col-md-8">
		<h3> <?php echo $Info['razon_social']; ?>
			<small><br>(<?php echo $Info['razon_comercial']; ?>)</small></h3>
		<small><cite title="San Francisco, USA"><?php echo $Info['direccion']; ?><i class="glyphicon glyphicon-map-marker"> </i></cite></small>
		<p>
			<?php if (!empty($Info['telefono'])) { ?>
				<i class="glyphicon glyphicon-phone"></i><?php  echo $Info['telefono']; ?><br />				
			<?php } ?>
			<?php if (!empty($Info['fax'])) { ?>
				<i class="glyphicon glyphicon-phone-alt"></i><?php  echo $Info['fax']; ?><br />				
			<?php } ?>
			<?php if (!empty($Info['email'])) { ?>
				<i class="glyphicon glyphicon-envelope"></i><?php  echo $Info['email']; ?><br />				
			<?php } ?>
			<?php if (!empty($Info['website'])) { ?>
				<i class="glyphicon glyphicon-globe"></i> <a href="<?php echo $Info['website']; ?>"><?php echo $Info['website']; ?></a><br />
			<?php } ?>
			<?php if (!empty($Info['fecha_relacion'])) { ?>
				<i class="glyphicon glyphicon-gift"></i> <?php echo $Info['fecha_relacion']; ?><br />
			<?php } ?>
			
		</p>

		<div class="btn-group">
			<button type="button" class="btn btn-primary">
				Social
			</button>
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span><span class="sr-only">Social</span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="#">Twitter</a>
				</li>
				<li>
					<a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a>
				</li>
				<li>
					<a href="https://www.facebook.com/jquery2dotnet">Facebook</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="#">Github</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php } ?>

