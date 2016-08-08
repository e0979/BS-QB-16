<div class="onerow">
  	<div class="grid_1 alpha">&nbsp;</div>
  	<div class="grid_10 seccion">
  		
  		
  		
  
  		<div class="head head-facturas">
  			<div class="left"><h3>Facturas</h3></div>  			
  			<ul class="nav nav-pills right">	
  				<?php $this->render('cobros/nav'); ?>
			</ul>			
  		</div>
  		<!-- MENU AREA-->
  		
  		
  		
  		<div class="box">
  			
		<?php $this -> render("cobros/facturas/add");  ?>
		<?php $this -> render("cobros/facturas/ver");  ?>		
		<?php //$this -> render("egresos/nomina/ver");  ?>
		<?php //$this -> render("egresos/nomina/recibo-ver");  ?>
  		
  		
  			<div class="cl-md-9">
    	 		<table class="table table-hover table-list-search domains facturas" id="list-results">
                    <thead>
                        <tr>
                        	<th># </th>
                        	<th width="35%">Cliente </th>
                        	<th width="5%">Fecha</th>                        	
                        	<th class="righty">Monto</th>
                        	<th class="format_texts"></th>
                        	<th></th>
                        	<th class="format_texts"></th>
                        	<th width="25%"> </th>
                        </tr>
                    </thead>
                   <tbody>
                   		<tr>
							<td colspan="8" class="dataTables_empty">Loading data from server</td>
						</tr>
					</tbody>                   
                </table>               
				<div class="clearfix"></div>			
             </div>
  		
  		</div>
  	</div>
  	<div class="grid_1 alpha">&nbsp;</div>
</div>