<?php
include_once 'DAC/Database.class.php';
include_once 'CONTROLLER/C_Debug.php';

include 'afip/awsfe.php';

$acon = new awsfe();

$param['FeCompConsReq'] = array( 'CbteNro'   => 169,
                                 'PtoVta'    => 2,
                                 'CbteTipo'  => 6);


echo '<pre>';
print_r($acon->ejecutar_metodo('FECompConsultar',$param));


?>
