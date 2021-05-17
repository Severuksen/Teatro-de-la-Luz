<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
        <meta charset="utf-8">
        <title>ILUMINACIÓN TEATRAL 1.0</title>
        <link rel="stylesheet" href="css/hoja.css" type="text/css">
        <link rel="stylesheet" href="css/w3.css"> 
        <link rel="icon" type="image/png" href="imagenes/favicon.png" />
        <script type="application/javascript" src="js/jquery.min.js"></script>
        <script type="application/javascript" src="js/jquery.backstretch.min.js"></script>
        <script type="application/javascript" src="js/fondo.js"></script>
        <script type="application/javascript" src="js/funcion.js"></script>
	</head>
    
	<?php if (isset($_SESSION["mensajeregistro"]) == 1){echo "<body onLoad=Mostrar('registrar','entrar')>";} else {echo "<body onLoad=Mostrar('entrar','registrar')>";} ?>
        <div class="Menu" id="Menu">
            <div class="RegistrarseBarra" OnClick="Mostrar('registrar','entrar')">
                <input type="button" OnClick="Mostrar('registrar','entrar');" name="Registrar" id="RegistrarB" class="BotonesVerdes Fuente" value="Registro">
            </div>
            <div id="registrar" class="Registrarse Fuente" style="visibility: hidden">
                <form action="modulos/login.php?op=Registro" method="POST">
                    <div class="Cuadro1">
                        <table width="201" border="0" align="center">
                          <tbody>
                            <tr>
                              <td width="134">Usuario:</td>
                              <td width="57"><input name="disenador" type="text" id="disenador" placeholder="Nombre del diseñador del plano" size="10" maxlength="70"></td>
                            </tr>
                            <tr>
                              <td>Contraseña:</td>
                              <td>
                                <input name="contrasena" type="password" id="contrasena" placeholder="Contraseña para el usuario" size="10" maxlength="70">
                              </td>
                            </tr>
                            <tr>
                              <td>Correo:</td>
                              <td><input name="correo" type="text" id="correo" placeholder="Correo electrónico del usuario" size="10" maxlength="70"></td>
                            </tr>
                            <tr>
                              <td colspan="2"><strong><em><?php if (isset($_SESSION["mensajeregistro"]) == 1){echo $_SESSION["mensajeregistro"]; unset($_SESSION["mensajeregistro"]);}?></em></strong></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <div class="Cuadro2">
                        <input class="Botones Naranja" type="submit" name="submit" id="submit" value="OK">
                    </div>
                </form>
            </div>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--> 
            <div class="EntrarBarra" OnClick="Mostrar('entrar','registrar')">
                <input type="button" name="entrar" OnClick="Mostrar('entrar','registrar')" id="EntrarB" class="BotonesAzules Fuente" value="Entrar">
            </div>
            <div id="entrar" class="Entrar Fuente" style="visibility: visible">
                <form action="modulos/login.php?op=Entrar" method="POST">
                    <div class="Cuadro1">
                        <table width="201" border="0" align="center">
                          <tbody>
                            <tr>
                              <td width="134">Usuario:</td>
                              <td width="57"><input name="disenador" type="text" autofocus id="Disenador" placeholder="Nombre del diseñador del plano" size="10" maxlength="70"></td>
                            </tr>
                            <tr>
                              <td>Contraseña:</td>
                              <td>
                                <input name="contrasena" type="password" id="Contrasena" placeholder="Contraseña para el usuario" size="10" maxlength="70">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2"><strong><em><?php if (isset($_SESSION["mensajeentrar"])==1){echo $_SESSION["mensajeentrar"]; unset($_SESSION["mensajeentrar"]);} ?></em></strong></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <div class="Cuadro2">
                        <input class="Botones Naranja" type="submit" name="submit" id="submit" value="OK">
                    </div>
                </form>
            </div>
        </div>
        <div id="infoobra" class="infoobra Fuente">
        	<div id="obra" class="obra"></div>
            <div id="autor" class="autor"></div>
            <div id="interprete" class="interprete"></div>
        </div>
	</body>
</html>			