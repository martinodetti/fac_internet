<?php
include_once 'DAC/Database.class.php';
include_once 'CONTROLLER/C_Debug.php';

include 'afip/awsfe.php';

$acon = new awsfe();

$param['FeCompConsReq'] = array( 'CbteNro'   => 11237,
                                 'PtoVta'    => 2,
                                 'CbteTipo'  => 1);


echo '<pre>';
print_r($acon->ejecutar_metodo('FECompConsultar',$param));


?>
