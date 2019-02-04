<?php
session_start();
require("modulos/consulta.php");
$id = $_SESSION["id"];
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/hoja.css">
		<link rel="icon" type="image/png" href="imagenes/favicon.png"/>
		<script type="application/javascript" src="js/jquery-1.11.3.js"></script>
        <script type="application/javascript" src="js/jquery-ui.js"></script>
		<script type="application/javascript" src="js/jquery.ui.rotatable.min.js"></script>
        <script type="application/javascript" src="js/jquery.easing.min.js"></script>
        <script type="application/javascript" src="js/funcion.js" ></script>
</head>

<body>
<div id="panelm" class="panelm">
	<div class="Fuente panelma">
    	<form action="modulos/login.php?op=Abrir" method="POST">
            <div class="panelma-1">Cambiar: </div>
            <div class="panelma-1 panelma-2">
                <select name="proyecto" class="panelma-2-1" id="proyecto">
					<?php
						$consulta = $BD->query("SELECT id_pro, nm_pro FROM pro WHERE id_usr='$id'");
						$num = $consulta->num_rows;
						for($i=0;$i<$num;$i++){
							$fetch = $consulta->fetch_array(MYSQLI_BOTH);
							/*MUESTRA EL NOMBRE DEL PROYECTO SELECCIONADO*/
							if (isset($_SESSION["proyectonm"]) || isset($_SESSION["proyectonro"])){
								if ($proyectonro == $fetch[0] || $proyectonm == $fetch[1]){
								  echo "<option selected value='$proyectonro'>$proyectonm</option>";}
								else{ echo "<option value='$fetch[0]'>$fetch[1]</option>";}}
						}
					?>
                </select>
            </div>
            <div class="panelma-1 panelma-3"><input class="Botones Naranja BtnPequeno" type="submit" name="submit" id="submit" value="OK"></div>
        </form> 
    </div>
	<div class="Fuente panelmb">
    	<form action="modulos/login.php?op=Crear" method="POST">
            <div class="panelmb-1">Crear nuevo: </div>
            <div class="panelmb-1 panelmb-2"><input name="proyecto" class="panelmb-2-1" type="text" id="proyecto" placeholder="Nombre del proyecto" size="20" maxlength="70"></div>
            <div class="panelmb-1 panelmb-3"><input class="Botones Naranja BtnPequeno" type="submit" name="submit" id="submit" value="OK"></div>
        </form>
    </div>
	<div class="Fuente panelmc">
    	<form action="modulos/login.php?op=Modificar" method="POST">
            <div class="panelmc-1">Modificar nombre: </div>
            <div class="panelmc-1 panelmc-2"><input name="proyecto" class="panelmc-2-1" type="text" id="proyecto" placeholder="Nombre del proyecto" size="20" maxlength="70"></div>
            <div class="panelmc-1 panelmc-3"><input class="Botones Naranja BtnPequeno" type="submit" name="submit" id="submit" value="OK"></div>
        </form>
    </div>
</div>
</body>
</html>