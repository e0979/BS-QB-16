
<div class="onerow">
  	<div class="grid_1 alpha">&nbsp;</div>
  	<div class="grid_10 seccion">
  		
  		
  		
  
  		<div class="head head-impuestos">
  			<div class="left"><h3>Planillas</h3></div>  			
  			<ul class="nav nav-pills right">  			
  				<?php $this->render('impuestos/nav'); ?>
			</ul>			
  		</div>
  		<!-- MENU AREA-->
  		
  		<div class="box">
  		
  			
		<?php $this -> render("impuestos/compras/add");  ?>
		<?php $this -> render("impuestos/retenciones/add");  ?>		
		<?php $this -> render("impuestos/iva/ver");  ?>
  		
  		
  			<div class="cl-md-9">
    	 		<table class="table table-hover table-list-search domains" id="list-results">
                    <thead>
                        <tr>
                        	<th>Periodo  </th>
                        	<th>Planilla </th>
                        	<th>IVA Débitos  </th>
                        	<th>IVA Créditos  </th>
                        	<th>a Pagar</th>
                        	<th>elaborada</th>
                        	<th> </th>
                        </tr>
                    </thead>
                    <tbody id="list-body-iva">
                    	<?php $this -> render("impuestos/iva/planillas");  ?>
					
					</tbody>                    
                </table>
             </div>
  		
  		
	      
  		
  		</div>
  	</div>
  	<div class="grid_1 alpha">&nbsp;</div>
</div>