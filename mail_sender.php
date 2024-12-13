<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include_once 'MODEL/Persona.php';
include_once 'CONTROLLER/C_Debug.php';


class mail_sender{

    var $username = 'no_reply@frenosoeste.com.ar';
    var $password = 'martin1234';
    var $mail; 

    public function __construct() {
        $this->mail = new PHPMailer();

        $this->mail->SMTPDebug = 0; // Muestra mensajes de depuración detallados
        $this->mail->Debugoutput = 'html'; // Formato de salida para los mensajes de depuración
        $this->mail->SMTPKeepAlive = false; // Cierra la conexión después de cada mensaje
        //Tell PHPMailer to use SMTP
        $this->mail->isSMTP();
        //Set the hostname of the mail server
        $this->mail->Host = 'smtp.frenosoeste.com.ar';
        //Set the SMTP port number:
        $this->mail->Port = 587;
        $this->mail->SMTPSecure = 'tls'; 
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = $this->username;
        //Password to use for SMTP authentication
        $this->mail->Password = $this->password;
        //Set who the message is to be sent from
        $this->mail->setFrom($this->username, 'Frenos Oeste');
        //Set an alternative reply-to address
        $this->mail->addReplyTo($this->username, 'Frenos Oeste');
    }


    public function send_factura($path ='', $cliente, $numero){
		if($path != ''){
            $arr_address = array_map('trim', explode(";",$cliente->get_email_persona()));
			foreach($arr_address as $address){
                $this->mail->addAddress($address);
            }
            
            //Set the subject line
            $this->mail->Subject = 'Nuevo comprobante de Frenos Oeste, ref: ' . $numero . '. ';

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            
            $this->mail->msgHTML('<p>Estimado cliente,</p>
        <p>Adjunto encontrará el comprobante emitido.</p>
        <p>Cualquier inquietud enviar mail a las siguientes direcciones:</p>
        <p>clulic@frenosoeste.com.ar</p>
        <p>info@frenosoeste.com.ar</p>
        <br>
        <p>Saludos cordiales,</p>
        <p><br>Frenos Oeste<br>
        <a href="https://www.frenosoeste.com.ar">www.frenosoeste.com.ar</a><br>
        Teléfono: 0261-4360959</p>
');

            //Replace the plain text body with one created manually
            $this->mail->AltBody = 'Adjunto encontrará el documento.';

            //Attach an image file
            $this->mail->addAttachment($path);
            //send the message, check for errors
            if (!$this->mail->send()) {
				logger("Error en envio de mail: " . $mail->ErrorInfo);
            } else {
                //echo 'Message sent!';
            }
        }

    }


}
?>
