	<div class="onerow">
    	<div class="grid_2">&nbsp;</div>
		<div class="grid_8">
        	
              
            
        	<div class="seccion">
            	<ul id="progressbar" class="progressbar-4">
                    <li class="active">Datos del cliente</li>
                    <li>Tipo de Proyecto</li>
                    <li>Ejecución y consideraciones</li>
                    <li>Comentarios Adicionales</li>
                  </ul>
 		
		<form id="formulario" action="">
		 	<!-- PASO 1 -->
			<fieldset id="presupuestos-delegate-step1">
				<div class="seccion"><h3>Datos del Cliente</h3></div>                
                <?php $this->render('entidades/clientes/select');?>
                              
                <div id="errors"></div>
                <input name="email-extra" type="text" placeholder="Indicó algún Email nuevo?" class="mediuminput" />
                 <div help="...si es el mismo email de siempre, puedes omitir este campo " class="helptip">
                	<i class="icon-question-sign"></i>
                </div>
                
                <div class="separador"></div>
                <div class="info">...ó completa los siguientes campos, si el Cliente no está registrado</div>
                <input type="text" name="razon_social" placeholder="Razón Social" required="required"  class="form mediuminput" id="razon_social-input"/><br>
                <input type="text" name="razon_comercial" placeholder="Alias" required="required" class="mediuminput" />
                <div help="...o Nombre Comercial Ejemplo: 'Nivea' " class="helptip">
                	<i class="icon-question-sign"></i>
                </div>
                <input type="text" name="rif" required="required" placeholder="Cédula o RIF" class="mediuminput" />
                <input type="text" name="direccion" placeholder="Dirección" style="width: 74%" />
                <div class="grid_12">
                    <div id="emailaddresses" class="grid_6 alpha">
                     <input type="email" name="email" placeholder="Email"   /><i class="icon-plus-sign action-icon-add-email"></i>
                    </div>
                    
                    <div id="phonenumbers" class="grid_6 omega">
                        <input type="text" name="telefono" placeholder="Teléfono" required="required" /><i class="icon-plus-sign action-icon-add"></i>
                    </div>
                    
                </div>
                <div class="separador"></div>
                <input type="button" name="next" class="next btn" value="Siguiente  &raquo;" id="next1" />
                 
            </fieldset>
            
            <!-- PASO 2 -->  
			<fieldset id="presupuestos-delegate-step2">	
                 <div class="seccion"><h3>Tipo de Proyecto</h3></div>
                 <div class="info">¿Qué tipo de Proyecto quiere el cliente?</div>
                 <select data-placeholder="Seleccione ..." name="tipo_trabajo" id="tipo_trabajo" required>
                	<option value=""></option>
					<?php foreach($this->proyectosList as $key => $TipoProyecto) { ?>
                  	<option value="<?php echo $TipoProyecto['nombre']; ?>"><?php echo $TipoProyecto['nombre']; ?></option>
					<?php } ?>
                </select>
                <div class="clear"></div>
                <div id="trabajo_preguntas">
                	
                    
                    
                    
                </div>
                

               <div class="separador"></div>
                <input type="button" name="previous" class="previous btn" value="&laquo; Anterior" />
                <input type="button" name="next" class="next btn" value="Siguiente &raquo;" />
              </fieldset>
              
                   
			  <!-- PASO 3 -->
              <fieldset id="presupuestos-delegate-step3">
                <div class="seccion"><h3>Ejecución y Consideraciones</h3></div>
                <div class="info">La entrega se necesita en..</div>
                <select data-placeholder="Seleccione..." class="droppy" name="tiempo_entrega" >
                  <?php foreach($this->tiemposEntregaList as $key => $TiempoEntrega) { ?>
                  <option value="<?php echo $TiempoEntrega['nombre']; ?>"><?php echo $TiempoEntrega['nombre']; ?></option>
                  <?php } ?>
                </select>
                <div class="info"> ¿A cuantas partes de pago?</div>
                <select data-placeholder="Seleccione..." class="droppy" name="plan_pago" >
                  <?php foreach($this->partesPagoList as $key => $PlandePago) { ?>
                  <option value="<?php echo $PlandePago['resumen']; ?>" <?php if ($PlandePago['nombre'] === 'Plan C') echo "selected=selected" ; ?>><?php echo $PlandePago['resumen']; ?></option>
                  <?php } ?>
                </select>
                
                <div class="info"> Este trabajo es de Prioridad...</div>
                <select data-placeholder="Seleccione..." class="droppy" name="prioridad" >
                  <option value="Baja">Baja</option>
                  <option value="Normal" selected="selected">Normal</option>
                  <option value="Alta">Alta</option>
                  <option value="Muy alta">Muy alta</option>
                </select>
                <div class="separador"></div>
                  <input type="button" name="previous" class="previous btn" value="&laquo; Anterior" />
                  <input type="button" name="next" class="next btn" value="Siguiente &raquo;" />
                </fieldset>
                
              	<!-- PASO 4 -->
                <fieldset id="presupuestos-delegate-step4">
                	<div class="seccion"><h3>Ejecución y Consideraciones</h3></div>
	                <div class="info">¿El Cliente indicó alguna página de referencia?</div>
                    <textarea placeholder="liste separando por comas" name="referencias"></textarea>
                    
                    <div class="info">¿Se hicieron peticiones especiales?</div>
                    <textarea placeholder="indica separando por comas" name="peticiones"></textarea>
                    
    	            <div class="info">Algunas condidiones a tener en cuenta..?</div>
                    
                  
                    
                    
                    
                   <textarea type="text" placeholder="Selecciona ó escribe tus propias condiciones" autocomplete="off" id="condiciones" name="condiciones" ></textarea>
                   
                    <div class="separador"></div>
                     <input type="button" name="previous" class="previous btn" value="&laquo; Anterior" />
                    
                    <input type="submit" name="submit" class="btn btn-success" value="Listo!" />
                    
              </fieldset>
        	</form>
        <div id="confirm" class="notifications">
       		<a href="list">
                <img src="<?php echo ICONS; ?>check.png"/><br /><br />¡Todo Listo!</a>
            </a>
        </div>
         <div id="failed" class="notifications">
       		<a href="delegate">
                <img src="<?php echo ICONS; ?>wrong.png"/><br /><br />Umm... hubo un error ):</a>
            </a>
        </div>
        
        
        
        
        </div>
		</div>
      	<div class="grid_2 last">&nbsp;</div>
   </div>
   <script type="text/javascript">
	<?php 
				
		$condiciones = '';
								
		foreach($this->condicionesList as $key => $Condicion) { 
        	$condiciones .= '"'.$Condicion['nota'].'",';
		}
	?>
				
	$(document).ready(function(e) {
      /*  */
		$("#tipo_trabajo").select2( { 
			placeholder: 'Seleccione...',
			minimumResultsForSearch: -1,
			width: '50%',
		});
					
		$("#condiciones").select2({
			placeholder: 'Seleccione...',
			tags:[<?php echo $condiciones; ?>],
			width: '95%',
			separator: '<?php echo SEPARADOR; ?>'
		});					
				
	});
</script>