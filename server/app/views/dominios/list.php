
<div class="onerow">
  	<div class="grid_1 alpha">&nbsp;</div>
  	<div class="grid_10 seccion">
  		
  		
  		
  
  		<div class="head head-dominios">
  			<div class="left"><h3>Dominios</h3></div>  			
  			<ul class="nav nav-pills right">  			
  				<?php $this->render('dominios/nav'); ?>
			</ul>			
  		</div>
  		<!-- MENU AREA-->
  		
  		<div class="box">
  		
  		
  		
  			
		<?php $this -> render("dominios/add");  ?>
  		
  		
  			<div class="cl-md-9">
    	 		<table class="table table-list-search domains" id="list-results">
                    <thead>
                        <tr>
                        	<th>Dominio <i class='glyphicon glyphicon-sort'></i> </th>
                        </tr>
                    </thead>
                    <tbody id="dominios-list-body">
                    	<?php $this -> render("dominios/domains");  ?>
					</tbody>                    
                </table>
             </div>
  		
  		
	      
  		
  		</div>
  	</div>
  	<div class="grid_1 alpha">&nbsp;</div>
</div>