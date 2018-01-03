<?php

class conexion{
	var $db_host	= "localhost";		// Host, nombre o IP del servidor Mysql.
	var $db_user	= "root";   		// Usuario de Mysql
	var $db_pass	= "";   	  		// contraseña de Mysql
	var $database 	= "fac_internet";	// Nombre de la base de datos
	public static $conexion=NULL;		// Variable que contiene el objeto conexión singleton
	
	/**
	 * Constructor
	 * @access private
	 */
	private function __construct(){
		if (!$this->db_con=@mysql_connect($this->db_host,$this->db_user,$this->db_pass)){
			return(NULL);
		}
		mysql_select_db($this->database, $this->db_con);
		return($this);
	}


	//Permite que la clase sea unica (singleton) y se cree una sola conexion
	public static function getConexion() {
		if(conexion::$conexion == Null){
			conexion::$conexion = new conexion();
		}
		return(conexion::$conexion);
	}
	
	public static function insert($sql){
		mysql_query('SET names UTF8');
		return mysql_query($sql);
	}
	
	public static function insertReturn($sql, $tabla){
		mysql_query('SET names UTF8');
		$id = services::mysql_next_id($tabla);
		$r = mysql_query($sql);
		if($r){
			return $id;
		}else{
			return 0;
		}
	}
	
	public static function selectArr($sql){
		mysql_query('SET names UTF8');
		$rs = mysql_query($sql);
		$ret = array();
		while($row = mysql_fetch_assoc($rs)){
			array_push($ret,$row);
		}
		return $ret;
	}
	
	public static function selectObj($sql){
		mysql_query('SET names UTF8');
		$rs = mysql_query($sql);
		$row = mysql_fetch_assoc($rs);
		return $row;
	}
}
?>
