<?php
session_start();
require("modulos/consulta.php");
if (isset($_REQUEST["mensaje"])) {
  $nombre = $_SESSION["disenador"];
  $verificar = consulta("SELECT cor_usr FROM usr WHERE nm_usr = '$nombre'","fetch-array");
  $correo = $verificar[0];
  $mensaje = $_REQUEST["mensaje"];
  require ("modulos/class.phpmailer.php");
  require ("modulos/class.smtp.php");
  /*################################################################*/
  $mail              = new PHPMailer();
  $mail->IsSMTP();
  $mail->PluginDir   = "modulos/";
  $mail->Mailer      = "smtp";
  $mail->Host        = "smtp.gmail.com";
  $mail->SMTPAuth    = true;
  $mail->SMTPSecure  = "tls";
  $mail->Port        = 587;
  $mail->Username    = ""; 
  $mail->Password    = "";
  $mail->FromName    = "Planos de Iluminación || Teatro de la Luz"; 
  $mail->Timeout     = 30;
  $mail->Subject     = "Comentario de: $nombre";
  $mail->AddAddress("richard_malaga@hotmail.com", "Richard Málaga");
  $mail->IsHTML(true);
  /*$mail->MsgHTML(file_get_contents("mensaje.html"), "/");*/
  $mail->Body        = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin título</title>
</head>

<body>
<table width='500' height='600' border='0' align='center' background='https://goo.gl/CF59J8'>
  <tbody>
    <tr>
      <td><table width='495' height='358' border='0'>
        <tbody>
          <tr>
            <td height='230' width='495'><table width='325' height='291' border='0' align='center'>
              <tbody>
                <tr>
                  <td height='21' align='center' valign='middle'><p><strong>MENSAJE DE RECOMENDACIÓN</strong></p></td>
                </tr>
                <tr>
                  <td align='left' valign='top'><p><em>Usuario:</em> <strong>$nombre</strong></p>
                    <em>$mensaje</em></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>";
  $exito = $mail->Send();
  $intentos = 1; 
  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	//echo $mail->ErrorInfo;
     	$exito = $mail->Send();
     	$intentos=$intentos+1;
   }
  if(!$exito){
	  echo "1";
  } else {
	  echo "0";
  } 
} else {
	echo"<script>window.location.assign('main.php');</script>";
}
