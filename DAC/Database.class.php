<?php
class Database extends PDO {

    private $motor;
    private $host;
    private $database;
    private $usuario;
    private $clave;

    public function __construct() {

        $this->motor 	= 'mysql';
        $this->host 	= 'db';
		$this->database = 'fac_internet';
        $this->usuario 	= 'root';
        $this->clave 	= '';

        $dns = $this->motor . ':dbname=' . $this->database . ';host=' . $this->host;

		
        try{
			parent::__construct($dns, $this->usuario, $this->clave);
		}catch(PDOException $e){

		}
		
    }

    public function alteration_query($query) {

        $logFile = fopen("log.txt", 'a') ;

        parent::exec("SET names UTF8");
        $count = parent::exec($query);

        $error = parent::errorInfo();

        if ($error[0] == 00000) {

            $error[2] = '';
        }

        return $resultarray = array('rows_affected' => $count, 'error' => $error[2]);

        fwrite($logFile, "Inserción de datos, Alteration_Query".PHP_EOL);
        fwrite($logFile, date("d/m/Y H:i:s")." Query: ".print_r($query, true).PHP_EOL);
        fwrite($logFile, date("d/m/Y H:i:s")." Resultarray: ".print_r($resultarray, true).PHP_EOL);
        fwrite($logFile, "Fin inserción de datos, Alteration_Query".PHP_EOL);
        fclose($logFile);

        $count = null;

        $error = null;

        $last = null;
    }

    public function select_query($query) {
		parent::exec("SET names UTF8");
        $sth = parent::prepare($query);

        if (!$sth->execute()) {

            $result = array(1 => 'false', 2 => 'There was an error in sql syntax.');

            return $result;
        }

        $result = $sth->fetchAll();

        $sth = null;

        return $result;
    }

}


?>
