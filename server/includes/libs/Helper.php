<?php
		
	class Helper {
	
		function __construct() {
			
		//	echo 'This is Helper';

		}
				 		
		static function tellmebyID($tablename, $id) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."$tablename WHERE id=%s LIMIT 1", $id);	
			
	    }
		
		static function tellmebyName($tablename, $name) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."$tablename WHERE nombre=%s LIMIT 1", $name);	
			
	    }
		static function tellmeLast($tablename, $order = 'DESC') {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."$tablename ORDER BY id $order", $tablename);	
			
	    }
		
		//TODO funcion para sacar el nombre del usuario

		static function getIpAddress($ip = USER_IP) {
			
			if ($ip === '') {
				
				if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
					$ip = $_SERVER['REMOTE_ADDR'];
				}
				
			}
			return $ip;
		}
			
		
		//Database	
		static function insert($tablename, $vars){
			
			$tablename = escape_value($tablename);
			
			return DB::insert( DB_PREFIX . $tablename, $vars);
						
			
		}
		
		static function update($tablename, $id, $vars, $by ='id'){
				
			$tablename = escape_value($tablename);
			$id = escape_value($id);
			$by = escape_value($by);
			
							
			return DB::update( DB_PREFIX . $tablename, $vars, $by."=%s", $id);		

	  			
		}
		
		
		
		
		
		
		/* FROM DATATABLES for long 
		 * 
		 * https://editor.datatables.net/release/DataTables/extras/Editor/examples/server-side-processing.html
		 * http://datatables.net/examples/data_sources/server_side.html
		 * https://datatables.net/release-datatables/examples/server_side/server_side.html
		 * http://datatables.net/examples/server_side/custom_vars.html
		*/
		static function getJSONtables($tablename, $vars, $element) {
				
			$aColumns = $vars;
	
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = "id";
			
			/* DB table to use */
			$sTable = $tablename;//$tablename;

			/* Database connection information */
			$gaSql['user']       = DB_USER;
			$gaSql['password']   = DB_PASSWORD;
			$gaSql['db']         = DB_NAME;
			$gaSql['server']     = DB_HOST;
			
			
			
			
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
			 * no need to edit below this line
			 */
			
			/* 
			 * MySQL connection
			 */
			$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
				die( 'Could not open connection to server' );
			
			mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
				die( 'Could not select database '. $gaSql['db'] );
			
			
			/* 
			 * Paging
			 */
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
					mysql_real_escape_string( $_GET['iDisplayLength'] );
			}
			
			
			/*
			 * Ordering
			 */
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}
			
			
			/* 
			 * Filtering
			 * NOTE this does not match the built-in DataTables filtering which does it
			 * word by word on any field. It's possible to do here, but concerned about efficiency
			 * on very large tables, and MySQL's regex functionality is very limited
			 */
			$sWhere = "";
			if ( $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}
			
			/* Individual column filtering */
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
			}
			
			
			/*
			 * SQL queries
			 * Get data to display
			 */
			$sQuery = "
				SELECT SQL_CALC_FOUND_ROWS id,".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM   $sTable
				$sWhere
				$sOrder
				$sLimit
			";
			$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			
			/* Data set length after filtering */
			$sQuery = "
				SELECT FOUND_ROWS()
			";
			$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
			$iFilteredTotal = $aResultFilterTotal[0];
			
			/* Total data set length */
			$sQuery = "
				SELECT COUNT(".$sIndexColumn.")
				FROM   $sTable
			";
			$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			$aResultTotal = mysql_fetch_array($rResultTotal);
			$iTotal = $aResultTotal[0];
			
			
			/*
			 * Output
			 */			
			//$vars = array_push($vars, 'id');
			
			$aColumns = $vars; //array( 'numero', 'dia','mes','anio', 'beneficiario', 'monto', 'elaborador','id');
			$sOutput = '{';
			$sOutput .= '"sEcho": '.intval($_GET['sEcho']).', ';
			$sOutput .= '"iTotalRecords": '.$iTotal.', ';
			$sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
			$sOutput .= '"aaData": [ ';
			while ( $aRow = mysql_fetch_array( $rResult ) ) {
				$sOutput .= "[";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					switch ( $aColumns[$i]) {

						//FORMATOS
						case 'numero':					
							$sOutput .= '"'.str_replace('"', '\"', zerofill($aRow[ $aColumns[$i] ],5) ).'",';
							break;
							
						case 'monto':					
							$sOutput .= '"'.str_replace('"', '\"', dineroFormat($aRow[ $aColumns[$i] ]) ).'",';
							break;
							
						case 'dia':					
							$fecha = zerofill($aRow[ $aColumns[$i] ],2);
														
							break;
							
						case 'mes':							
							$fecha .= "/".zerofill($aRow[ $aColumns[$i] ],2);
							$sOutput .= '"'.str_replace('"', '\"', '').'",';
							break;
						
						case 'anio':
							$fecha .= "/".$aRow[ $aColumns[$i] ];
							$sOutput .= '"'.str_replace('"', '\"', $fecha).'",';
							break;
						
						/*case 'subtotal'
						//	$id = ;
						//	$cliente = DB::query("SELECT * FROM ". DB_PREFIX ."factura WHERE id=%s LIMIT 1", $id);	
							
							$sOutput .= '"'.$cliente[0]['razon_social'].'",';
							
							break;
							*/
						case 'id_cliente':
							
							$id = $aRow[$aColumns[$i]];
							$cliente = DB::query("SELECT * FROM ". DB_PREFIX ."cliente WHERE id=%s LIMIT 1", $id);	
							
							$sOutput .= '"'.$cliente[0]['razon_social'].'",';

							break;
						
						case 'elaborador':
							
							$id = $aRow[$aColumns[$i]];
							if (is_numeric($id)) {
									
								$elaborador = DB::query("SELECT * FROM ". DB_PREFIX ."empleados WHERE cedula=%s LIMIT 1", $id);	
								$elaborador = $elaborador[0]['nombre'].' '.$elaborador[0]['apellido'];
							} else {
								$elaborador = $id;
							}
 							$sOutput .='"<span class='."'label label-warning'>".$elaborador.'</span>",';

							break;
							
						case 'pagada':
						
						
							if ($aRow[ $aColumns[$i] ] == 'si') {
								//ver detalles
								//$sOutput .= "<button class='btn btn-xs btn' onclick=edit('$element',$id,$i);>.<span class='icon_money-small icon_small'></span>editar</button>".'"",';
								$sOutput .= '"<span class='."'icon_money-small icon_small'".'></span>",';
								
							} else {
								//pagar
								$sOutput .= '"",';
							}
								
							break;
							
						case 'id': /* Edit buttons*/
							
							if($i !='0') {
									
								$id = $aRow[ $aColumns[$i] ];
								$botones_edicion  = "<button class='btn btn-xs btn-blue' onclick=edit('$element',$id);><i class='glyphicon glyphicon-pencil'></i> editar</button> ";
										
								switch ($tablename) {
									case 'factura':
										$botones_edicion .= "<button class='btn btn-xs btn-info' onclick=view('$element',$id);><i class='glyphicon glyphicon-search'></i> ver</button>";
										$botones_edicion .= " <button class='btn btn-xs btn-danger' onclick=annul('$element',$id);><i class='glyphicon glyphicon-remove'></i> anular</button>";
										
										break;
									
									default:
										
										$botones_edicion .= "<button class='btn btn-xs btn-info' onclick=view('$element',$id);><i class='glyphicon glyphicon-search'></i> ver</button>";
										break;
								}

								$sOutput .= '"'.$botones_edicion.' ",';		
							
							} else {
											
									//switch ($tablename) {
									//case 'factura':
											
									$sOutput .= '"'.str_replace('"', '\"', zerofill($aRow[ $aColumns[$i] ],5)).'",';
							}
													
							
							
							break;
						
						default: /* General output */
							if ( $aColumns[$i] != ' ' ) {
								$sOutput .= '"'.str_replace('"', '\"', $aRow[ $aColumns[$i] ]).'",';
							}
							break;
							
					}
					
				
					
					
				}
				
				/*
				 * Optional Configuration:
				 * If you need to add any extra columns (add/edit/delete etc) to the table, that aren't in the
				 * database - you can do it here
				 */
				
				
				$sOutput = substr_replace( $sOutput, "", -1 );
				$sOutput .= "],";
			}
			$sOutput = substr_replace( $sOutput, "", -1 );
			$sOutput .= '] }';
			
			echo $sOutput;	
		}
		
	/*	static function getJSONtables_1($tablename, $vars){

			$tablename = escape_value($tablename);
			
			
			
			$aColumns = $vars;
	
			/* Indexed column (used for fast and accurate table cardinality) */
		/*	$sIndexColumn = "id";
			
			/* DB table to use */
			/*$sTable = $tablename;

			/* Database connection information */
			/*$gaSql['user']       = DB_USER;
			$gaSql['password']   = DB_PASSWORD;
			$gaSql['db']         = DB_NAME;
			$gaSql['server']     = DB_HOST;
			
			
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
			 * no need to edit below this line
			 */
			
			/* 
			 * MySQL connection
			 */
		/*	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
				die( 'Could not open connection to server' );
			
			mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
				die( 'Could not select database '. $gaSql['db'] );
			
			
			/* 
			 * Paging
			 */
			/*$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
					mysql_real_escape_string( $_GET['iDisplayLength'] );
			}
			
			
			/*
			 * Ordering
			 */
		/*	if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}
			
			
			/* 
			 * Filtering
			 * NOTE this does not match the built-in DataTables filtering which does it
			 * word by word on any field. It's possible to do here, but concerned about efficiency
			 * on very large tables, and MySQL's regex functionality is very limited
			 */
		/*	$sWhere = "";
			if ( $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}
			
			/* Individual column filtering */
			/*for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
			}
			
			
			/*
			 * SQL queries
			 * Get data to display
			 */
			/*$sQuery = "
				SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM   $sTable
				$sWhere
				$sOrder
				$sLimit
			";
			$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			
			/* Data set length after filtering */
			/*$sQuery = "
				SELECT FOUND_ROWS()
			";
			$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
			$iFilteredTotal = $aResultFilterTotal[0];
			
			/* Total data set length */
			/*$sQuery = "
				SELECT COUNT(".$sIndexColumn.")
				FROM   $sTable
			";
			$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			$aResultTotal = mysql_fetch_array($rResultTotal);
			$iTotal = $aResultTotal[0];
			
			
			/*
			 * Output
			 */
			/*$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);
			
			while ( $aRow = mysql_fetch_array( $rResult ) )
			{
				$row = array();
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					if ( $aColumns[$i] == "version" )
					{
						/* Special output formatting for 'version' column */
						/*$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					else if ( $aColumns[$i] != ' ' )
					{
						/* General output */
						/*$row[] = $aRow[ $aColumns[$i] ];
					}
				}
				$output['aaData'][] = $row;
			}
			
			return $output;			
			
			
			
		}*/
		
		static function getJSONtables_advanced($tablename, $vars, $where ='',$temp=""){

			$tablename = escape_value($tablename);
			
			$aColumns = $vars;
			
			/* Array of database columns which should be read and sent back to DataTables. Use a space where
			 * you want to insert a non-database field (for example a counter or static image)
			 */
			
			
			
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = "id";
			
			/* DB table to use */
			$sTable = $tablename;
			
			/* Database connection information */
			$gaSql['user']       = DB_USER;
			$gaSql['password']   = DB_PASSWORD;
			$gaSql['db']         = DB_NAME;
			$gaSql['server']     = DB_HOST;
			
			
			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
			 * no need to edit below this line
			 */
			
			/* 
			 * MySQL connection
			 */
			// var_dump($gaSql);
			$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
				die( 'Could not open connection to server' );
			
			mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
				die( 'Could not select database '. $gaSql['db'] );
			if ($temp=="presupuestos"){
				$hora=date("hi");
				$sql="create temporary table IF not EXISTS ".$temp."_".$hora. "
				SELECT presupuesto.*,razon_social FROM " . DB_PREFIX . "presupuesto inner join " . DB_PREFIX . "cliente on cliente.id=presupuesto.id_cliente
				";		
				
				mysql_query( $sql ) or die(mysql_error());
				$sTable =$temp."_".$hora;
			}
			
			
			/* 
			 * Paging
			 */
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
					mysql_real_escape_string( $_GET['iDisplayLength'] );
			}
			
			
			/*
			 * Ordering
			 */
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}
			
			
			/* 
			 * Filtering
			 * NOTE this does not match the built-in DataTables filtering which does it
			 * word by word on any field. It's possible to do here, but concerned about efficiency
			 * on very large tables, and MySQL's regex functionality is very limited
			 */
			if ( $where != '') {
				$sWhere = $where;
			} else {
				$sWhere = "";
			}
			
			if ( $_GET['sSearch'] != "" )
			{
				$sWhere = "WHERE (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}
			
			/* Individual column filtering */
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
			}
			
			
			/*
			 * SQL queries
			 * Get data to display
			 */
			$sQuery = "
				SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM   $sTable
				$sWhere
				$sOrder
				$sLimit
			";
			$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			
			/* Data set length after filtering */
			$sQuery = "
				SELECT FOUND_ROWS()
			";
			$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
			$iFilteredTotal = $aResultFilterTotal[0];
			
			/* Total data set length */
			$sQuery = "
				SELECT COUNT(".$sIndexColumn.")
				FROM   $sTable
			";
			$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
			$aResultTotal = mysql_fetch_array($rResultTotal);
			$iTotal = $aResultTotal[0];
			
			
			/*
			 * Output
			 */
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);
			
			while ( $aRow = mysql_fetch_array( $rResult ) )
			{
				$row = array();
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					if ( $aColumns[$i] == "version" )
					{
						/* Special output formatting for 'version' column */
						$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					else if ( $aColumns[$i] != ' ' )
					{
						/* General output */
						$row[] = $aRow[ $aColumns[$i] ];
					}
				}
				$output['aaData'][] = $row;
			}
			
			echo json_encode( $output );
		}
					
	}
	
?>