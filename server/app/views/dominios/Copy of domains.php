<?php $this -> render("dominios/expiring");  ?>

<?php 
                    	foreach ($this->dominios as $Dominio) {
	       						$id_cliente = $Dominio['cliente'];
								$id_domain =  $Dominio['id'];
								$year =  $this->fields_group[$id_domain][0]['year'];														
								
								//Si No hay fecha de renovación, es porque el cliente no ha pagado, entonces mostrar datos del año pendiente aun.							
								if (empty($this->fields_group[$id_domain][0]['renewal_date'])) {
									$anio = 1;
								} else { $anio = 0; }
																
								//endif
								
	       					?>				 			
						  <tr>
                        	
                        	<th>
	                        	<form class="form domains-form">
	                        		<div>
	                        		<?php 
	                        		//substr($array_datos['domain_creationdate'], 3, 2);
	                        	
										$renewal_date = explode('/',$Dominio['domain_creationdate']);	
										$date_analysis = strtotime($renewal_date[0]+$renewal_date[1]+$renewal_date[2]);
										echo $date_analysis;
	                        		?>	
	                        		</div>
	                        		<div class="icon_calendar-sheet left"><?php echo shortdate($this->fields_group[$id_domain][$anio]['renewal_date']); ?></div>
	                        		<div class="grid_4">
	                        			<h1 class="domains"><?php echo $Dominio['domain']; ?> 
	                        				<button class="btn btn-blue btn-xs details-loader" data-toggle="collapse" href="#details-<?php echo $id_domain; ?>"><i class="glyphicon glyphicon-chevron-down"></i></button>
								 			<input type="hidden" id="domain_id" name="domain_id" value="<?php echo $Dominio['id']; ?>" />
	                        				<input type="hidden" id="year" name="year" value="<?php echo $this->fields_group[$id_domain][$anio]['year']; ?>" />
	                        				
			             				</h1>
			             				<span class="cliente"><?php echo $this -> cliente[$id_cliente]; ?></span>
	                        		</div>
	                        		<div class="grid_4">
	                        			
	                        		<div class="switch-group">
	                        			<span class="icon_mail-small icon_small left"></span>
	                        			<div class="switch ">
									      <input type="radio" class="switch-input" name="notification_email" value="no" id="mail-no-<?php echo $id_domain; ?>" <?php if ($this->fields_group[$id_domain][$anio]['notification_email'] === 'no') echo "checked"; ?>>
									      <label for="mail-no-<?php echo $id_domain; ?>" class="switch-label switch-label-off">NO</label>
									      
									      <input type="radio" class="switch-input" name="notification_email" value="si" id="mail-si-<?php echo $id_domain; ?>" <?php if ($this->fields_group[$id_domain][$anio]['notification_email'] === 'si') echo "checked"; ?>>
									      <label for="mail-si-<?php echo $id_domain; ?>" class="switch-label switch-label-on">SI</label>
									      <span class="switch-selection"></span>
									    </div>
									</div>	
									<div class="switch-group">
	                        			<span class="icon_phone-small icon_small left"></span>
	                        			<div class="switch ">
									      <input type="radio" class="switch-input" name="notification_phone" value="no" id="phone-no-<?php echo $id_domain; ?>" <?php if ($this->fields_group[$id_domain][$anio]['notification_phone'] === 'no') echo "checked"; ?> >
									      <label for="phone-no-<?php echo $id_domain; ?>" class="switch-label switch-label-off">NO</label>
									      
									      <input type="radio" class="switch-input" name="notification_phone" value="si" id="phone-si-<?php echo $id_domain; ?>" <?php if ($this->fields_group[$id_domain][$anio]['notification_phone'] === 'si') echo "checked"; ?>>
									      <label for="phone-si-<?php echo $id_domain; ?>" class="switch-label switch-label-on">SI</label>
									      <span class="switch-selection"></span>
									    </div>
									</div>
	                        		
					             </div>
					             <div class="left">
					             	
					             	<div class="switch-group">
	                        			<span class="icon_renew-small icon_small left"></span>
	                        			<div class="switch ">
									      <input type="radio" class="switch-input" name="renewal" value="no" id="renewal-no-<?php echo $id_domain; ?>" <?php if ($this->fields_group[$id_domain][$anio]['renewal'] === 'no') echo "checked"; ?> >
									      <label for="renewal-no-<?php echo $id_domain; ?>" class="switch-label switch-label-off">NO</label>
									      
									      <input type="radio" class="switch-input" name="renewal" value="si" id="renewal-si-<?php echo $id_domain; ?>" <?php if ($this->fields_group[$id_domain][$anio]['renewal'] === 'si') echo "checked"; ?>>
									      <label for="renewal-si-<?php echo $id_domain; ?>" class="switch-label switch-label-on">SI</label>
									      <span class="switch-selection"></span>
									    </div>
									</div>
									
					             </div>
					             <div class="right">
					             	<button class="btn btn-blue details-loader" data-toggle="collapse" href="#details-<?php echo $id_domain; ?>"><i class="glyphicon glyphicon-pencil"></i> editar</button>
								 <!--div class="options-dominio anime right">
								 	<div>
								     	<a data-toggle="collapse" href="#details-<?php echo $Dominio['id']; ?>"><span class="icon_money"></span><span>Registrar Pago</span></a>
								        <a data-toggle="collapse" href="#details-<?php echo $Dominio['id']; ?>"><span class="icon_modify"></span><span>Modificar Renovación	</span></a>
								    </div-->
								</div>
								
					            <div class="clear"></div>
					            </form>
					            <div id="details-<?php echo $Dominio['id']; ?>" class="collapse detalles">					            	
					            	<div class="dominios-details">
					            		<div class="dominios-details-head">
									 		<div class="col_anio"></div>
									 		
										 		<div class="grid_3 alpha omega">
										 			<span class="icon_domain-small icon_small"></span><h5>DOMINIO </h5>
										 			<span class="mini-info">creado el <?php echo $Dominio['domain_creationdate']; ?></span></div>
											 	<div class="grid_3 alpha omega"><span class="icon_server-small icon_small"></span><h5>SERVIDOR</h5>
											 		<span class="mini-info">creado el <?php echo $Dominio['hosting_creationdate']; ?></span></div>
											 	<div class="grid_3 alpha omega"><span class="icon_mail-small icon_small"></span><h5>CORREO</h5>
											 		<span class="mini-info">(Configuracón del Servidor)</span>
											 	</div>
											 	<div class="grid_2 alpha omega"><span class="icon_money-small icon_small"></span><h5> COBRANZA</h5></div>
											 	<div class="grid_2 alpha omega text-right"><h5> RENOVAR</h5></div>
									 		
										 	
										 	<div class="clear"></div>
									 	</div>
					            	</div>
					            	<div id="years-details-<?php echo $Dominio['id']; ?>">
					            		
					            		<?php //Aqui cargan "dominios/domain-details"  ?>
					            		
					            	</div>
				                	
								</div>
	                        
                       	 </tr>
                        </th>
					<?php } ?>