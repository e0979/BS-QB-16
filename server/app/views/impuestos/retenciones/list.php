
<div class="onerow">
  	<div class="grid_1 alpha">&nbsp;</div>
  	<div class="grid_10 seccion">
  		
  		
  		
  
  		<div class="head head-impuestos">
  			<div class="left">
  				<h3>Retenciones de Clientes 
  					<small><button class="btn btn-blue" onclick="javascript:updatelist('retenciones')"><i class="glyphicon glyphicon-refresh"></i></button>  						
  					</small>
  				</h3>
  			</div>  			
  			<ul class="nav nav-pills right">  			
  				<?php $this->render('impuestos/nav'); ?>
			</ul>			
  		</div>
  		<!-- MENU AREA-->
  		
  		<div class="box">
  		
  				
		
  		<?php $this -> render("impuestos/compras/add");  ?>
  		<?php $this -> render("impuestos/retenciones/ver");  ?>		
		<?php $this -> render("impuestos/retenciones/add");  ?>		
		<?php $this -> render("impuestos/iva/ver");  ?>
  		
  			<div class="cl-md-9">
    	 		<table class="table table-hover table-list-search domains" id="list-results">
                   <thead>
			          <tr>
			          	<th>Fecha</th>
			            <th>Cliente</th>			            
			             <th class="text-left"># Comprobante </th>
			             <th>Factura Afectada</th>
			             <th class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IVA Retenido</th>
			             <th class="text-right"></th>
			             <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			          </tr>
			        </thead>
                     <tbody id="list-body-retenciones">
                    	<?php $this -> render("impuestos/retenciones/retenciones");  ?>
					
					</tbody>                     
                </table>
             </div>
  		
  		
	      
  		
  		</div>
  	</div>
  	<div class="grid_1 alpha">&nbsp;</div>
</div>