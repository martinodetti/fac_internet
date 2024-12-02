<?php

class aconexion
{

    var $_DB;
    var $wsdl   = "wsaa_prod.wsdl";
//    var $cert   = "test.pem"; # The X.509 certificate in PEM format
//    var $pkey   = "test"; # The private key correspoding to CERT (PEM)
    var $cert   = "facturacion.crt";
    var $pkey   = "facturacion";
	var $tra    = "TRA.xml";
	var $tmp    = "TRA.tmp";
    var $request= "request-loginCms.xml";
    var $respons= "response-loginCms.xml";
    
    
    var $pass   = ""; # The passphrase (if any) to sign
//    var $url    = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms";
    var $url    = "https://wsaa.afip.gov.ar/ws/services/LoginCms";
    
    
    var $token  = "";
    var $sign   = "";
    var $wsname = "";
//	var $cuit	= "20304942119";
    var $cuit   = "30709716006";
        
    var $error = "";

    function __construct($wsname = "")
    {
        $this->wsdl     = dirname(__FILE__) . "/" . $this->wsdl;
        $this->cert     = dirname(__FILE__) . "/" . $this->cert;
        $this->pkey     = dirname(__FILE__) . "/" . $this->pkey;
        $this->tra      = dirname(__FILE__) . "/" . $this->tra;
        $this->tmp		= dirname(__FILE__) . "/" . $this->tmp;
        $this->request  = dirname(__FILE__) . "/" . $this->request;
        $this->respons  = dirname(__FILE__) . "/" . $this->respons;
    
    
        if($wsname != "")
        {
            $this->_DB = new Database();
        
            $sql = "SELECT * FROM afip_login WHERE expirateTime > now() and webservices = '".$wsname."'" ;
            $result = $this->_DB->select_query($sql);

            if(count($result) > 0)
            {
                $this->token= $result[0]['token'];
                $this->sign = $result[0]['sign'];
                $this->wsname = $result[0]['webservices'];
            }
            else
            {   
                $this->crearAcceso($wsname);
            }
        }
    }
    
    
    private function crearAcceso($wsname)
    {
        //creamos el TRA de consumo
        $TRA = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' .
                                        '<loginTicketRequest version="1.0">'.
                                        '</loginTicketRequest>');
        $TRA->addChild('header');
        $TRA->header->addChild('uniqueId',date('U'));
        $TRA->header->addChild('generationTime',date('c',date('U')-60));
        $TRA->header->addChild('expirationTime',date('c',date('U')+60));
        $TRA->addChild('service',$wsname);
        $TRA->asXML($this->tra);

        //firmamos los archivos con certificado y private key
        $STATUS=openssl_pkcs7_sign( $this->tra, 
                                    $this->tmp, 
                                    "file://".$this->cert,
                                    array("file://".$this->pkey, $this->pass),
                                    array(),
                                    !PKCS7_DETACHED);
        if (!$STATUS) 
        {
            $this->error = "ERROR generating PKCS#7 signature";
            exit();
        }
        
        $inf=fopen($this->tmp, "r");
        $i=0;
        $CMS="";
        while (!feof($inf)) 
        { 
            $buffer=fgets($inf);
            if ( $i++ >= 4 ) 
            {
                $CMS .= $buffer;
            }
        }
        fclose($inf);
        unlink($this->tra);
        unlink($this->tmp);

        //llamomos al webservices si todo salio bien
        unlink($this->request);
        unlink($this->respons);
        
        $client=new SoapClient( $this->wsdl, 
                                array(  'soap_version'   => SOAP_1_2,
                                        'location'       => $this->url,
                                        'trace'          => 1,
                                        'exceptions'     => 0
                                    )
                                ); 
		try{
            $results = $client->loginCms(array('in0'=>$CMS));
        }catch(Exception $e){
            $results = $e;
        }    
		if (is_soap_fault($results)) 
        {
            $this->error = "SOAP Fault: ".$results->getCode()."\n".$results->getMessage();
			pr($this->error);
			exit();
        }
        
        //guardamos los archivos para debug
        file_put_contents($this->request,$client->__getLastRequest());
        file_put_contents($this->respons,$client->__getLastResponse());

        //obtengo el resultado del soap
        $result = simplexml_load_string($results->loginCmsReturn);
        $this->token = $result->credentials->token;
        $this->sign  = $result->credentials->sign;
        
        $query = "INSERT INTO afip_login values (0,'".$this->token."','".$this->sign."','".$result->header->generationTime."','".$result->header->expirationTime."','".$result->header->source."','".$result->header->destination."',".$result->header->uniqueId.",'".$wsname."')";
        $rt = $this->_DB->alteration_query($query);

        mysql_query($query);
    }

}
?>
