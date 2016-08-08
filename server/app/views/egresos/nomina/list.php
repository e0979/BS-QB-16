<div class="onerow">
  	<div class="grid_1 alpha">&nbsp;</div>
  	<div class="grid_10 seccion">
  		
  		
  		
  
  		<div class="head head-egresos">
  			<div class="left"><h3>Nóminas emitidas</h3></div>  			
  			<ul class="nav nav-pills right">	
  				<?php $this->render('egresos/nav'); ?>
			</ul>			
  		</div>
  		<!-- MENU AREA-->
  		
  		
  		
  		<div class="box">
  			
		<?php $this -> render("egresos/comprobantes/add");  ?>
		
		<?php $this -> render("egresos/nomina/add"); //add  ?>		
		<?php $this -> render("egresos/nomina/ver");  ?>
		<?php $this -> render("egresos/nomina/recibo-ver");  ?>
		<?php $this -> render("egresos/comprobantes/ver");  ?>
  		
  		
  			<div class="cl-md-9">
    	 		<table class="table table-hover table-list-search domains nominas" id="list-results">
                    <thead>
                        <tr>
                        	<th width="5%"></th>                        	
                        	<th width="20%">desde</th>
                        	<th>hasta</th>  
                        	<th>elaborada por </th>                     	
                        	<th width="20%"></th>
                        </tr>
                    </thead>
                   <tbody>
                   		<tr>
							<td class="dataTables_empty">Loading data from server</td>
						</tr>
					</tbody>                   
                </table>               
				<div class="clearfix"></div>			
             </div>
  		
  		</div>
  	</div>
  	<div class="grid_1 alpha">&nbsp;</div>
</div>