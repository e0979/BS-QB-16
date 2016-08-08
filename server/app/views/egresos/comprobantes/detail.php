<?php foreach ($this->comprobante as $Comprobante) {

$id = $Comprobante['id'];
?>

<?php $this -> render("default/modal/nextprev"); ?>
<table class="table table-condensed">
      <tbody>
        <tr>
          <td class="text-right format_texts">Formulario F­ADM001 | Lenar a Mano o Máquina | Creación 01/05/07 | Ultima Modificación 10/02/14</td>
        </tr> 
        <tr>
        	<td><div class="egreso_numero"><h4>Egreso con <a href="#" id="egreso-<?php echo $id; ?>" class="editable" data-type="select" data-source="formapago_options" data-pk="egresos_comprobantes-forma_pago-<?php echo $id; ?>"><?php echo $Comprobante['forma_pago']; ?></a> de Banco (Nº 
        		<a href="#" id="egreso-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-numero-<?php echo $id; ?>"><?php echo $Comprobante['numero']; ?></a>) 
        		<small class="format_texts"> BESIGN, C.A. J­29397290­6        Banco Mercantil (0105­0730­89­1730011306)</small></h4></div>
        	</td>
        </tr>      
      </tbody>
    </table>	
	<table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th width="15%" class="text-center"><strong>Fecha Emisión</strong></th>
      	  <th class="text-center"><strong>Beneficiario</strong></th> 
          <th class="text-center"><strong><?php echo $Comprobante['forma_pago']; ?></strong></th>
          <th width="20%" class="text-right"><strong>Monto Bs.</strong></th>
          <th  class="text-center"><strong>Concepto</strong></th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td>
          	<a href="#" id="fecha-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-fecha-<?php echo $id; ?>">
          	<?php echo $Comprobante['fecha']; ?></a>
          </td>
          <td>
          	<a href="#" id="beneficiario-<?php echo $id; ?>" class="editable" data-type="select" data-pk="egresos_comprobantes-beneficiario-<?php echo $id; ?>" data-source="providers_texttext">
				<?php echo $Comprobante['beneficiario']; ?>
          	</a>
          </td>
          <td>
          	<a href="#" id="cheque-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-cheque-<?php echo $id; ?>">
          	<?php echo $Comprobante['cheque']; ?>
          	</a></td>
          <td class="text-right">Bs. 
          	<a href="#" id="monto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-monto-<?php echo $id; ?>">
          	<?php echo dineroFormat($Comprobante['monto'],2, 'nobs'); ?></a></td>
          <td>
          	<a href="#" id="concepto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-concepto-<?php echo $id; ?>">
          	<?php echo $Comprobante['concepto']; ?>
          	</a>
          </td>
        </tr>       
      </tbody>
    </table>
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th>Elaborado</th>
      	  <th>Recibido</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <tr>
          <td class="area_firma"> <div>
          	<a href="#" id="elaborador-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-elaborador-<?php echo $id; ?>">
          		<?php echo $Comprobante['elaborador']; ?>
          	</a>	
          	</div></td>
          <td></td>
        </tr>  
        <tr>
          <td>Fecha: 
          	<a href="#" id="fecha-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-fecha-<?php echo $id; ?>">
          	<?php echo $Comprobante['fecha']; ?>
          	</a></td>
          <td>Fecha: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;  </td>
        </tr>       
      </tbody>
    </table>
    
<?php 
    	if (!empty($this->has_retencion)){ ?>
    		<div  style="height: 35%"></div>
    	<?php $this -> render("egresos/retenciones_aplicadas/detail");
			//Copia
			$this -> render("egresos/retenciones_aplicadas/detail");
    	} 
    
	} 
?>
