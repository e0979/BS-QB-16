 <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top topmenu" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <!--a class="navbar-brand" href="#">Project name</a-->
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          	
            <li class="dropdown" style="width:50px">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo ICONS; ?>apps.png"/ width="100%"></a>
              <ul class="dropdown-menu">
                
                <li><a href="http://mail.besign.com.ve" target="_blank"><img id="app-icon" src="<?php echo ICONS; ?>gmail.png"/> Gmail</a></li>
        	 	<li><a href="http://calendar.besign.com.ve" target="_blank"><img id="app-icon" src="<?php echo ICONS; ?>calendar.png"/> Calendario</a></li>
                <li><a href="http://drive.google.com/a/besign.com.ve" target="_blank"><img id="app-icon" src="<?php echo ICONS; ?>drive.png"/> Drive</a></li>
              </ul>
            </li>
           
            
            
        
			<li class="divider-vertical"></li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Entidades <b class="caret"></b></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">Clientes</li>
                <!--li><a href="<?php echo URL; ?>entidades/clientes"><i class="glyphicon glyphicon-search"></i> Clientes Registrados</a></li-->
                 <li><a href="#" data-toggle="modal" data-target="#agenda-cliente"><i class="glyphicon glyphicon-book"></i> Agenda</a></li>               
                 <li><a href="#" data-toggle="modal" data-target="#add-cliente"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Cliente</a></li>               
                
                <li class="divider"></li>
                <li class="dropdown-header">Proveedores</li>
                  <li><a href="#" data-toggle="modal" data-target="#agenda-proveedor"><i class="glyphicon glyphicon-book"></i> Agenda</a></li>
                  <li><a href="#" data-toggle="modal" data-target="#add-proveedor"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Proveedor</a></li>
                </ul>
            </li>
            
            
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-credit-card"></i> Pagos y Cobros <b class="caret"></b></a>
              <ul class="dropdown-menu">
              	<!--li class="dropdown-header">Cobranzas</li>
                <li><a href="<?php echo URL; ?>entidades/clientes"><i class="glyphicon glyphicon-search"></i> Ver Facturas</a></li>
                <li><a href="<?php echo URL; ?>entidades/clientes#add"><i class="glyphicon glyphicon-plus-sign"></i> Crear Factura</a></li>
                <li><a href="<?php echo URL; ?>entidades/clientes#add"><i class="glyphicon glyphicon-plus-sign"></i> Crear Recibo</a></li-->
                <li class="divider"></li>
                <li class="dropdown-header">Pagos</li>
                  	<li><a href="<?php echo URL; ?>egresos/"><i class="glyphicon glyphicon-search"></i> Comprobantes de Egreso</a></li>
                 	<li><a href="<?php echo URL; ?>egresos/nominas"><i class="glyphicon glyphicon-search"></i> Nóminas emitidas</a></li>
                 	<li><a href="<?php echo URL; ?>egresos/#add-egreso-proveedor"><i class="glyphicon glyphicon-plus-sign"></i> Emitir Pago Proveedor</a></li>
                	<li><a href="<?php echo URL; ?>egresos/#add-egreso-nomina"><i class="glyphicon glyphicon-plus-sign"></i> Emitir Pago Nómina</a></li>
                	<li class="divider"></li>
                	<li class="dropdown-header">Cobros</li>
                	<li><a href="<?php echo URL; ?>cobros/facturas/"><i class="glyphicon glyphicon-search"></i> Facturas</a></li>
                	<li><a href="<?php echo URL; ?>cobros/facturas/#add-factura"><i class="glyphicon glyphicon-plus-sign"></i> Crear Factura</a></li>
                </ul>
                
                
            </li>
            
				
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-calendar"></i> Impuestos <b class="caret"></b></a>
              <ul class="dropdown-menu">
              	<li class="dropdown-header">IVA</li>
                <li><a href="<?php echo URL; ?>impuestos/iva#iva-current"><i class="glyphicon glyphicon-calendar"></i> Planilla del Mes</a></li>
                <li><a href="<?php echo URL; ?>impuestos/iva"><i class="glyphicon glyphicon-search"></i>  Consultar Planillas</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Compras</li>
                 <li><a href="<?php echo URL; ?>impuestos/compras"><i class="glyphicon glyphicon-search"></i> Ver Compras</a></li>
                <li><a href="<?php echo URL; ?>impuestos/iva#add-compra"><i class="glyphicon glyphicon-plus-sign"></i> Agregrar Compra</a></li>
                
                 <li class="divider"></li>
                 <li class="dropdown-header">Retenciones</li>
                 <li><a href="<?php echo URL; ?>impuestos/retenciones"><i class="glyphicon glyphicon-search"></i> Ver Retenciones recibidas</a></li>
                <!--li><a href="<?php echo URL; ?>impuestos/retenciones#add-retencion"><i class="glyphicon glyphicon-plus-sign"></i> Agregrar Compra</a></li-->
                
                 <li class="divider"></li>
                
                <li class="dropdown-header">ISLR</li>
              </ul>
            </li>
            			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-globe"></i> Dominios <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo URL; ?>dominios/all"><i class="glyphicon glyphicon-search"></i> Ver Lista</a></li>
	        	<li><a href="<?php echo URL; ?>dominios/all#add-dominio"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Dominio</a></li>
              </ul>
            </li>		
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-file"></i> Presupuestos <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo URL; ?>presupuestos/delegate"><i class="glyphicon glyphicon-send"></i> Solicitar creación</a></li>
        		<li><a href="<?php echo URL; ?>presupuestos/all"><i class="glyphicon glyphicon-search"></i> Ver Lista</a></li>
              </ul>
            </li>
          </ul>
        
                
           
           	
			
			
			
			
			
			</ul>
			</li>
               
          <?php $this->render('settings/default/settings-menu'); ?>
          <?php if (!empty($this->notificaciones)) { ?>
          <ul class="nav navbar-nav navbar-right">
           	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell notifications-bell"></i> &nbsp;<span class="badge">42</span></a>
           		
             	<ul id="notifications-array" class="dropdown-menu text-left">
             		<?php foreach($this->notificaciones as $lista) { ?>
             		<li><button class="btn btn-xs" onclick="eliminate_notifications(<?php echo $lista["id"]; ?>);"><strong><?php echo $lista["text"]; ?></strong> &nbsp;<i class="glyphicon glyphicon-remove"></i></button></li>
                	<?php }	?>                	
                    
               </ul>
         	</li>
          </ul>
         <?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

   
