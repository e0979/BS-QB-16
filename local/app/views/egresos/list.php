<div class="col-lg-2 col-md-1"></div>
<div class="col-lg-8 col-md-10 seccion">
	
	<div class="head head-egresos text-left">
		<h3><?php echo $this->h3; ?></h3>
		<ul class="nav nav-pills right">	
			<?php $this->render($this->navpills); ?>
		</ul>	
	</div>
 	<div class="box">
  		<table class="table table-hover table-list-search table-responsive <?php echo $this->class; ?>" id="list-results">	
			<thead>
	            <tr>
	            	<?php $this->render($this->head); ?>
	            </tr>
	        </thead>
	       	<tbody>
	       		<tr>
					<td colspan="8" class="dataTables_empty">por favor espera...</td>
				</tr>
			</tbody> 
		</table>
 	</div>

</div>
<div class="col-lg-2 col-md-1"></div>

<!-- MODALS -->
<?php $this -> render("egresos/modal");  ?>
<?php $this -> render("egresos/detail"); ?>
<?php $this -> render("egresos/comprobantes/add");  ?>



<?php $this -> render("egresos/nomina/add");  ?>		
<?php $this -> render("egresos/nomina/ver");  ?>
<?php $this -> render("egresos/nomina/recibo-ver");  ?>