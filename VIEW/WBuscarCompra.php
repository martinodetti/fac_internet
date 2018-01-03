<?php
	
	$aColumns = array('guiacod_compra', 'fec_compra', 'fec_ingreso','nom_persona', 'subtotal_compra','iva21_compra','estado_compra', 'total_compra','id_compra', 'ape_persona', 'id_provd','iva10_compra');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id_compra";
	
	/* DB table to use */
	$sTable = "v_compra";
	
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
			if(intval( $_GET['iSortCol_'.$i] ) == 1)
			{
				$sOrder .= "f_compra ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
			elseif(intval( $_GET['iSortCol_'.$i] ) == 2)
			{
				$sOrder .= "f_ingreso ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
			else
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
				}
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
		$sWhere .= ')'." AND true";
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
	
	
	//FIN DE LA DESPROLIJIDAD
	
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
		FROM   $sTable WHERE true
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

		$estado = "Cancelada";
		if($aRow[ $aColumns[6] ] == "1")
			$estado = "Pendiente";
		
		$row = array();
		$row[] = $aRow[ $aColumns[0] ];
		$row[] = $aRow[ $aColumns[1] ];
		$row[] = $aRow[ $aColumns[2] ];
		$row[] = $aRow[ $aColumns[3] ] . " " . $aRow[ $aColumns[9] ];
		$row[] = $aRow[ $aColumns[4] ];
		$row[] = $aRow[ $aColumns[5] ];
		$row[] = $estado;
		$row[] = $aRow[ $aColumns[7] ];
		$row[] = "<a id='btn_edit" . $aRow['id_compra'] . "' name='btn_edit" .$aRow['id_compra'] . "' class='button white clsMatrizEdit' style='width:60px;height:15px' href='#'><span class='icon_text edit'></span>Editar</a>";;		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>
