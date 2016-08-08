									<?php 
										$id_domain = $this->id_domain;
										 
										//Si No hay fecha de renovación, es porque el cliente no ha pagado, entonces mostrar datos del año pendiente aun.							
										if (empty($this->fields_group[$id_domain][0]['renewal_date'])) {
											$anio = 1;
										} else { $anio = 0; }
										//end if
											
										$i = 0;
									 		foreach ($this->fields_group[$id_domain] as $detail_anio) { 
									 		$i++;
									 	?>
										<div id="years-<?php $id_domain; ?>" class="dominios-details-body">				 	
										 	<div class="col_anio"><?php echo $detail_anio['year']; ?></div>
										 	<div class="grid_3 alpha">
										 		<a href="#" id="dominio-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="select-registrant" data-type="select" data-pk="dominio-<?php echo $detail_anio['year'] . '-' . $id_domain; ?>" data-source="provider_registrant"><?php echo @field_diccionario($detail_anio['dominio']); ?></a>
										 		<?php if ($detail_anio['dominio'] !== 'NULL') { ?>
										 		<div class="forpayment">
										 			<span class="icon_coins-small icon_small"></span>
										 			<a href="#" id="payment_dominio-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="editable bancario" data-type="text" data-pk="field-payment_dominio-<?php echo $detail_anio['year'] . '-' . $id_domain; ?>" ><?php echo @$detail_anio['payment_dominio']; ?></a>
										 		</div>
										 		<?php } ?>
										 	</div>
										 	<div class="grid_3 alpha">
										 		<a href="#" id="hosting-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="select-hosting" data-type="select" data-pk="field-hosting-<?php echo $detail_anio['year'] . '-' . $id_domain; ?>" data-source="provider_hosting" ><?php echo @field_diccionario($detail_anio['hosting']); ?></a>
										 		
										 		<?php if ($detail_anio['hosting'] !== 'NULL') { ?>
										 		<div class="forpayment">
										 			<span class="icon_coins-small icon_small"></span>
										 			<a href="#" id="payment_hosting-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="editable bancario" data-type="text" data-pk="field-payment_hosting-<?php echo $detail_anio['year'] . '-' . $id_domain; ?>" ><?php echo @$detail_anio['payment_hosting']; ?></a>			 				
										 		</div>
										 		<?php } ?>
										 	</div>
										 	<div class="grid_2 alpha">
										 		<a href="#" id="mail_server-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="select-mail_server" data-type="select" data-pk="field-mail_server-<?php echo $detail_anio['year'] . '-' . $id_domain; ?>" data-source="provider_mailserver" ><?php echo @field_diccionario($detail_anio['mail_server']); ?></a>
										 		
										 	</div>
										 	<div class="grid_4 alpha">
										 		<a href="#">&nbsp;</a>
										 		<div class="forpayment left">
										 			<span class="icon_coins-small icon_small"></span>
													<a href="#" id="payment_cliente-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="editable bancario" data-type="text" data-pk="field-payment_cliente-<?php echo $detail_anio['year'] . '-' . $id_domain; ?>" ><?php echo @$detail_anio['payment_cliente']; ?></a>
												</div>
												
												<?php												
												// Use the creator only at recent/current YEAR
												if ($i === 1) {
												
													if ($this->fields_group[$id_domain][$anio]['renewal'] === 'si'){
														$status = "";
													} else {
														$status = ' style=" display: none;"';
													}
												 ?>
													
												<div id="boton-<?php echo $id_domain; ?>" class="roundedOne right" <?php echo $status; ?>>
													<input type="checkbox" value="None" id="renew-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" name="renew">
													<label for="renew-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>"></label>
												</div>
												<?php } ?>
												
											</div>
										 	
										 	
										 	<div class="clear"></div>
										</div>
										<?php  }  ?>