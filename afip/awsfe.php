<?php
include_once 'aconexion.php';
include_once '../CONTROLLER/C_Debug.php';
/**
 * Clase de consumo del webservices de factura electronica
 * 
 */
class awsfe
{
//    var $wsdl   = "https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL";
    var $wsdl   = "https://servicios1.afip.gov.ar/wsfev1/service.asmx?WSDL";
    var $token  = "";
    var $sign   = "";
//	var $cuit	= "20304942119";
    var $cuit   = "30709716006";

    function __construct()
    {
        $con = new aconexion('wsfe');
        
        $this->token = $con->token;
        $this->sign = $con->sign;
    }
    
    /**
     * Recibe el nombre del método y parametros para hacer una llamada al webservices
     * 
     */    
    function ejecutar_metodo($metodo = "", $param = array())
    {
		//vamos a logear los parametros que recibe
		logger("Metodo: " . $metodo);
		logger("Parametros:");
		logger(print_r($param,true));
		
        $return = array();
        
        $ws = new SoapClient($this->wsdl);
        if($metodo != "")
        {
            //parametros de autenticacion
            $dat = array('Auth' => array(   'Token' => $this->token,
                                            'Sign'  => $this->sign,
                                            'Cuit'  => $this->cuit)
                        );
            //en caso que se requieran parametros adicionales
            if(count($param) > 0)
            {
                foreach($param as $var => $val)
                {
                    $dat[$var] = $val;
                }
            }
            try{
                $return = $ws->{$metodo}($dat);
            }catch(Exception $e){
                $return = $e;
            }            
        }
        else
        {
//            $return = $ws->__getFunctions();
        }
        
		//logeamos lo que devuelve la afip
		logger("Respuesta:");
		logger(print_r($return,true));
		
        return $return;
    }

}
/*
ACA VAMOS A PONER MUCHA INFORMACION UTIL
CbteTipo:
	1 Factura A
    2 Nota de debito A
    3 Nota de credito A
    6 Factura B
    7 Nota de debito B
    8 Nota de credito B
DocTipo:
	80 Cuit
    86 Cuil
    87 CDI
    89 LE
    90 LC
    91 Extranjero
    92 en tramite
    93 Acta nacimiento
    95 CI Bs. As. RNP
    96 DNI
    94 Pasaporte
    0 CI Policía Federal
    1 CI Buenos Aires
    2 CI Catamarca
    3 CI Córdoba
    4 CI Corrientes
    5 CI Entre Ríos
    6 CI Jujuy
    7 CI Mendoza
    8 CI La Rioja
    9 CI Salta
    10 CI San Juan
    11 CI San Luis
    12 CI Santa Fe
    13 CI Santiago del Estero
    14 CI Tucumán
    16 CI Chaco
    17 CI Chubut
    18 CI Formosa
    19 CI Misiones
    20 CI Neuquén
    21 CI La Pampa
    22 CI Río Negro
    23 CI Santa Cruz
    24 CI Tierra del Fuego
    99 Doc. (Otro)
IVA (id):
	3 0% Excento
    4 10.5%
    5 21%
    6 27%
    8 5%
    9 2.5%
*/
?>
