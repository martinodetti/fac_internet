<?php
	include '../CONTROLLER/C_Debug.php';	
	$aColumns = array( 'id_vehiculo', 'marca', 'modelo', 'dominio','anio','observacion', 'cliente', 'cliente_group');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id_vehiculo";
	
	/* DB table to use */
	$sTable = "v_vehiculo_buscar v";
	
	/* DB table to use JOIN */
//	$sJoin = " LEFT JOIN vehiculo_cliente vc ON (vc.id_vehiculo = v.id_vehiculo) LEFT JOIN persona c ON (vc.id_cliente = c.id_persona) ";
	
	/* DB group by tu use */
	$sGroup = " GROUP BY id_vehiculo";	
	
	/* Database connection information */
	$gaSql['user']       = "root";
	$gaSql['password']   = "";
	$gaSql['db']         = "fac_internet";
	$gaSql['server']     = "localhost";
	

	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	$sql = "SET NAMES utf8";
        mysql_query($sql, $gaSql['link'] );
	
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
		$sWhere .= ')'." AND true ";
	}else{
         $sWhere = " WHERE true ";   
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
		$sJoin
		$sWhere
		$sGroup   
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
		FROM   $sTable "; //WHERE estado_producto='1'";
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
	$Tipo_con="";
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{

		$row = array();
		$row[] = $aRow[ 0 ]; //id
		$row[] = $aRow[ $aColumns[3] ]; //patente
		$row[] = $aRow[ $aColumns[1] ]; //marca
		$row[] = $aRow[ $aColumns[2] ]; //modelo
		$row[] = $aRow[ 6 ]; //propietario (propietario)
		$row[] = $aRow[ $aColumns[4] ]; //año
		$row[] = $aRow[ $aColumns[5] ]; //observaciones
		$row[] = "<a id='btn_update" . $aRow['id_vehiculo'] . "' name='btn_update" .$aRow['id_vehiculo'] . "' class='button white clsMatrizModificar' style='width:60px;height:15px' href='#'><span class='icon_text edit'></span>Editar</a>";
//   $row[] ='<a href="#" id="modi_'.$aRow['id_disciplina'].'" class="tabla_editar">Modificar</a><a style="padding-left: 10px" class="tabla_eliminar" id="eli_'.$aRow['id_disciplina'].'" href="#">Eliminar</a>';
		$output['aaData'][] = $row;
	}

	echo json_encode( $output );
?>



