

<?php $this -> render("default/modal/nextprev"); 
foreach ($this->presupuesto as $pre){
	//var_dump($pre);
	?>
	
<?php } ?>
<div class="col-xs-6 col-md-4"><img width="240" height="140" src="<?php echo IMG;?>logobesign.jpg"/></div>
<div  class="col-xs-6 col-md-8 text-center">  BESIGN, C.A. 
                     RIF: J-29397290-6 <br>
                    Urb. la Alegria, Calle 152 c/c Calle 104, #102-183. Valencia, Edo. Carabobo. Tlf: (0241) 825.10.78<br>
                  <small> (Presupuesto V&aacute;lido por 10 dias)</small></div>
<div class="clearfix"></div>
<div class="col-md-7"></div>
			<div class=" col-md-2 text-center with_border">
		Fecha</div> 
		<div class="col-md-3  with_border">
			<a href="#" id="fecha-<?php echo $pre["fecha"]; ?>" class="editable" data-placeholder="Fecha" data-type="text" data-pk="presupuesto-fecha-<?php echo $this->id; ?>">
			<?php  echo $pre["fecha"]; ?>
			</a>
		</div><div class="grid_11 text-left ">&nbsp;</div> <br>
		<div class="col-md-4 "></div>
		<div class="col-md-4 with_border">
		  Cliente: 
		<a href="#" id="cliente-<?php  echo $this->id; ?>" class="editable" data-type="select" data-pk="presupuesto-id_cliente-<?php echo $this->id; ?>" data-source="clients">
			<?php echo $pre["razon_social"]; ?>
		</a>
		</div>
		<div class="col-md-4 with_border">
		  Rif: 
		<a href="#" id="rif-<?php  echo $this->id; ?>" class="editable" data-type="text" data-pk="presupuesto-rif-<?php echo $this->id; ?>" >
			<?php echo $pre["rif"]; ?>
		</a>
		</div>
		<div class="col-md-4 "></div>
		<div class="col-md-4 with_border">
		 Direccion: 
		<a href="#" id="direccion_fisica-<?php  echo $this->id; ?>" class="editable" data-type="text" data-pk="presupuesto-direccion_fisica-<?php echo $this->id; ?>" >
			<?php echo $pre["direccion_fisica"]; ?>
		</a>
		</div>
		<div class="col-md-4 with_border">
		 Telefono: 
		<a href="#" id="telefono-<?php  echo $this->id; ?>" class="editable" data-type="text" data-pk="presupuesto-telefono-<?php echo $this->id; ?>" >
			<?php echo $pre["telefono"]; ?>
		</a>
		</div>
		
		<div class="grid_11 text-left">
		
		Persona de Contacto: 
		<a href="#" id="persona_contacto-<?php  echo $this->id; ?>" class="editable" data-type="select" data-pk="presupuesto-persona_contacto-<?php echo $this->id; ?>" data-source="clients">
			<?php echo $pre["id_cliente"]; ?>
		</a>
		</div>
	
	<div class="grid_11 text-left tit">Presupuesto Nº <?php echo $this->id;?></div>
	
	<div class="col-md-3 text-left header_pre with_border"> Cantidad</div>
	<div class="col-md-3 text-left header_pre with_border">Descripción</div>
	<div class="col-md-3 text-left header_pre with_border">P.U.</div>
	<div class="col-md-3 text-left header_pre with_border">Sub Total/Bs.	</div>
	
	<?php 
	$subtotal=0;
	foreach($this->campo as $campo){
			if(count($campo)){ 
				?>
				<div class="col-md-3 text-left with_border"><?php echo $campo[0]["cantidad"] ;?></div>
				<div class="col-md-3 text-left with_border"><?php echo $campo[0]["descripcion"] ;?></div>
				<div class="col-md-3 text-left with_border"><?php echo $campo[0]["precio_unitario"] ;?></div>
				<div class="col-md-3 text-left with_border"><?php echo $campo[0]["precio_total"] ;?>	</div>
				<?php $subtotal+=$campo[0]["precio_total"] ; ?>
		<?php 
			}
		} 
	?>
	<div class="col-md-6 text-left  ">	</div>
	<div class="col-md-3 text-left  with_border">Sub Total/Bs.	</div>
	<div class="col-md-3 text-left  with_border"><?php echo $pre["subtotal"]; ?>	</div>
	<div class="col-md-6 text-left  ">	</div>
	<div class="col-md-3 text-left  with_border"> IVA	 <?php echo $pre["iva"];?>%</div>
	<div class="col-md-3 text-left  with_border"> <?php echo $pre["impuesto"];?></div>
	<div class="col-md-6 text-left  ">	</div>
	<div class="col-md-3 text-left  with_border">Total	</div>
	<div class="col-md-3 text-left  with_border"><?php echo $pre["iva"]+ $pre["subtotal"];  ?>	</div>
	<!--div class="grid_11 text-left">
		tipo
			<a href="#" id="tipo-<?php echo $pre["tipo"]; ?>" class="editable" data-placeholder="tipo" data-type="text" data-pk="presupuesto-tipo-<?php echo $this->id; ?>">
			<?php  echo $pre["tipo"]; ?>
			</a>
		<br></div--> 
		
	<br>
		<? if ($pre["nota"]!=""){ ?>
			<div class="grid_11 text-left ">&nbsp;</div>
	<br><div class="grid_11 text-left with_border">
		
			<a href="#" id="nota-<?php echo $pre["nota"]; ?>" class="editable" data-placeholder="nota" data-type="text" data-pk="presupuesto-nota-<?php echo $this->id; ?>">
			<?php  echo $pre["nota"]; ?>
			</a>
		</div> 
	<?php } ?>
	
	<!--div class="grid_11 text-left">
		Pago
			<a href="#" id="pago-<?php echo $pre["pago"]; ?>" class="editable" data-placeholder="pago" data-type="text" data-pk="presupuesto-pago-<?php echo $this->id; ?>">
			<?php  echo $pre["pago"]; ?>
			</a>
		<br></div--> 
		<!--div class="grid_11 text-left">
		Firma
			<a href="#" id="firma-<?php echo $pre["firma"]; ?>" class="editable" data-placeholder="firma" data-type="text" data-pk="presupuesto-firma-<?php echo $this->id; ?>">
			<?php  echo $pre["firma"]; ?>
			</a>
		<br></div> 
	
	<div class="grid_11 text-left">
		Titulo
			<a href="#" id="titulo-<?php echo $pre["titulo"]; ?>" class="editable" data-placeholder="titulo" data-type="text" data-pk="presupuesto-titulo-<?php echo $this->id; ?>">
			<?php  echo $pre["titulo"]; ?>
			</a>
		<br></div> 
		<div class="grid_11 text-left">
		IDP
			<a href="#" id="edp-<?php echo $pre["idp"]; ?>" class="editable" data-placeholder="idp" data-type="text" data-pk="presupuesto-idp-<?php echo $this->id; ?>">
			<?php  echo $pre["idp"]; ?>
			</a>
		<br></div--> 
			    
		<div class="grid_11 header_pre">
	Condiciones de Pago</div>
	 <div class="grid_11 with_border">
	 	<a href="#" id="pago-<?php echo $pre["pago"];  ?>" class="editable" data-placeholder="pago" data-type="select" data-pk="presupuesto-pago-<?php echo $this->id; ?>" data-source="planes_pago">
	 	<?php echo $this->plan_pago[0]["descripcion"]; ?>
	 	</a>
	<br>*Tiempo de Entrega 
		<a href="#" id="tiempo-<?php echo $pre["tiempo"];  ?>" class="editable" data-placeholder="tiempo" data-type="select" data-pk="presupuesto-tiempo-<?php echo $this->id; ?>" data-source="tipo_entrega">
			<?php  echo $this->tipo_entrega[0]["nombre"]; ?>
			</a>
</div>


</div>
<div class="clear"></div>

			  
	</div>

