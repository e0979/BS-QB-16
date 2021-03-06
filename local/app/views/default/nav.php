<header>
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top topmenu" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"></span> <span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span>Dashboard</a></li>

                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-user"></span> &nbsp; Entidades <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#agenda-cliente">
                                <i class="glyphicon glyphicon-book"></i> &nbsp; Agenda Clientes
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#agenda-proveedor">
                                <i class="glyphicon glyphicon-book"></i> &nbsp; Agenda Proveedores
                            </a>
                        </li>                        
                    </ul>
                </li>
                <!-- Egresos -->
                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-credit-card"></span> &nbsp; Pagos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#add-egreso">
                                <i class="fa fa-plus"></i> &nbsp; Emitir Pago
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#add-egreso-banco">
                                <i class="fa fa-plus"></i> &nbsp; Registrar movimiento Banco
                            </a>
                        </li>
                        <li>
                            <a href="#egresos">
                                <i class="fa fa-search"></i> &nbsp; Comprobantes de Egreso
                            </a>
                        </li> 
                        <li class="divider"></li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#add-egreso-nomina">
                                <i class="fa fa-plus"></i> &nbsp; Emitir Pago Nómina
                            </a>
                        </li>
                        <li>
                            <a href="#egresos/nominas">
                                <i class="fa fa-search"></i> &nbsp; Nóminas emitidas
                            </a>
                        </li>                       
                    </ul>
                </li>
                <!-- Cobranzas -->
                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-money"></span> &nbsp; Cobros <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#add-factura">
                                <i class="fa fa-plus"></i> &nbsp; Emitir Factura
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#add-pago-factura">
                                <i class="fa fa-plus"></i> &nbsp; Ingresar pago Factura
                            </a>
                        </li>
                        <li>
                            <a href="#cobros/facturas">
                                <i class="fa fa-search"></i> &nbsp; Facturas
                            </a>
                        </li>                        
                    </ul>
                </li>




                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-search"></span>Search <b class="caret"></b></a>
                    <ul class="dropdown-menu" style="min-width: 300px;">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="navbar-form navbar-left" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">
                                                Go!</button>
                                        </span>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-envelope"></span>Inbox <span class="label label-info">32</span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="label label-warning">4:00 AM</span>Favourites Snippet</a></li>
                        <li><a href="#"><span class="label label-warning">4:30 AM</span>Email marketing</a></li>
                        <li><a href="#"><span class="label label-warning">5:00 AM</span>Subscriber focused email
                            design</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="text-center">View All</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-user"></span>Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</header>