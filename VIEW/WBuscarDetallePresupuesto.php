<?php
	
	$aColumns = array( 'id_producto','nom_producto','descrip_producto','precio_detord', 'canti_detord');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id_presupuesto";
	
	/* DB table to use */
	$sTable = "v_presupuesto_reparacion_detalle";
	
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
	
	
	$sWhere = 'WHERE id_presupuesto = ' . $_GET['id_presupuesto'];
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere   
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
		$producto = str_replace('Mano de obra ','',$aRow[ $aColumns[2] ]);
		$producto = str_replace('Torneria','',$producto);
		$producto = str_replace('(','',$producto);
		$producto = str_replace(')','',$producto);
		$row = array();
//                $row[] = $aRow[ $aColumns[0] ];
                $row[] = $aRow[ $aColumns[1] ];
                $row[] = $producto;
				$row[] = $aRow[ $aColumns[3] ];
				$row[] = $aRow[ $aColumns[4] ];
                $row[] = $aRow[ $aColumns[3] ] * $aRow[ $aColumns[4] ];
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>
