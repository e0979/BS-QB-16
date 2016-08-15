<div class="col-lg-2 col-md-1"></div>
<div class="col-lg-8 col-md-10 seccion">
	
	<div class="head head-egresos text-left">
		<h3>Comprobantes de Egreso</h3>
  					
		<ul class="nav nav-pills right">	
				<?php //$this->render('egresos/nav'); ?>
		</ul>			
  	</div>
  	<div class="box">
  		<table class="table table-hover table-list-search comprobantes" id="list-results">	
			<thead>
	            <tr>
	            	<th># </th>
	            	<th width="5%">Fecha</th>
	            	<th>Beneficiario </th>
	            	<th class="righty">Monto</th>
	            	<th>elaborada</th>
	            	<th width="20%"> </th>
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
<!-- View/Edit Modal -->
<?php $this->render("egresos/modal"); ?>
<?php $this->render("egresos/detail");?>

<?php $this -> render("egresos/add");  ?>
  
<!--  
  		<div class="head head-egresos">
  			<div class="left"><h3>Comprobantes de Egreso</h3></div>  			
  			<ul class="nav nav-pills right">	
  				<?php $this->render('egresos/nav'); ?>
			
  			
		<?php $this -> render("egresos/comprobantes/add");  ?>
		
		<?php $this -> render("egresos/nomina/add");  ?>		
		<?php $this -> render("egresos/nomina/ver");  ?>
		<?php $this -> render("egresos/nomina/recibo-ver");  ?>
  		
  		
  			-->