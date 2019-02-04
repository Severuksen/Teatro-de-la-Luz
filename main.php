<?php
session_start();
if (!isset($_SESSION["disenador"]) || !isset($_SESSION["contrasena"])){
	echo "<meta charset='utf-8'>";
	echo "<script>alert('Usted no ha iniciado sesión'); window.location.assign('index.php')</script>";
} else {
	unset($_SESSION["correo"]);
	require("modulos/consulta.php");
	$disenador   = $_SESSION["disenador"];
	$id          = $_SESSION["id"];
	if (isset($_SESSION["proyectonm"]) || isset($_SESSION["proyectonro"])){
		$proyectonm  = $_SESSION["proyectonm"];
		$proyectonro = $_SESSION["proyectonro"];
	}
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
    	<meta charset="utf-8">
        <title>ILUMINACIÓN TEATRAL 1.0</title>
		<link rel="icon" type="image/png" href="imagenes/favicon.png"/>
        <link rel="stylesheet" type="text/css" media="screen" href="css/hoja.css">
        <link rel="stylesheet" type="text/css" media="print" href="css/imprimir.css">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
		<script type="application/javascript" src="js/jquery-1.11.3.js"></script>
        <script type="application/javascript" src="js/jquery-ui.js"></script>
		<script type="application/javascript" src="js/jquery.ui.rotatable.min.js"></script>
        <script type="application/javascript" src="js/jquery.easing.min.js"></script>
        <script type="application/javascript" src="js/funcion.js" ></script>
	</head>
    
	<body id="cuerpo" style="cursor: auto;" onLoad="Pantalla('escenario');">
        <div id="escenario" name="escenario" class="escenario" style="width: 842px; height: 845px;">
			<?php
			if (isset($_SESSION["proyectonm"]) || isset($_SESSION["proyectonro"])){
				$consulta = $BD->query("SELECT pos.id_p, pos.p_x, pos.p_y, pos.ang, luz.nm_luz FROM pos, luz WHERE pos.id_luz = luz.id_luz AND pos.id_usr='$id' AND pos.id_pro = '$proyectonro' ORDER BY pos.id_p ASC");
				$S = $consulta->num_rows;
				for($i=0;$i<$S;$i++){
					$luz = $consulta->fetch_array(MYSQLI_BOTH);
					echo "<div id='$luz[0]' oncontextmenu='Eliminar($luz[0]);' onmouseup='Guardar($luz[0])' class='mover $luz[4]' style='transform: rotate(0rad); transform-origin: 50% 50% 0px; top: $luz[1]; left: $luz[2];'></div>"; echo "<script>$('#$luz[0]').rotatable( {angle: $luz[3]});</script>";
				}
			}
			?>
        </div>
        <div class="agregarbotones" id="agregarbotones" style="visibility: hidden;">
        	<div class="equis" id="equis" style="visibility: hidden;" OnClick="Mostrar('','agregarbotones'); Mostrar('','equis');"></div>
            <?php
				$luz = $BD->query("SELECT * FROM luz");
				$con = $luz->num_rows;
				for($i=1;$i<$con+1;$i++){
					$luces = $luz->fetch_array(MYSQLI_BOTH);
					if ($i >= 4){
						echo "<div class='$luces[1]$luces[0] posicionbarra p$luces[0]' OnClick='Agregar($luces[0])'></div>";
					} else {
						echo "<div class='$luces[1] posicionbarra p$luces[0]' OnClick='Agregar($luces[0])'></div>";
					}
				}
			?>
        </div>
		<div class="top">
            <div class="impresora" onclick="Mostrar('','agregarbotones'); Mostrar('','cerrarsesion'); print(document); Mostrar('cerrarsesion','');"></div>
            <div class="guardar" id="guardar"></div>
			<div class="agregar" id="agregar" onclick="Mostrar('agregarbotones',''); Mostrar('equis','');"></div>
            <div class="gmail" id="gmail" onClick="Resetear('prueba'); Mostrar('','enviando'); Mostrar('','enviado'); Mostrar('','noenviado'); Mostrar('contacto','');"></div>
            <div class="cuadros contacto Fuente" id="contacto" style="visibility: hidden;">
            	<form id="prueba">
                    <div class="textoRec">Contacto:</div><textarea name="recomendacion" maxlength="2500" autofocus class="recomendacion Fuente" id="recomendacion" placeholder="Escriba su mensaje aqui" type="text"></textarea>
                    <div class="equis equisRec" onclick="Mostrar('','contacto');"></div>
                    <input type="button" class="Botones Naranja enviar" value="OK" onClick="Recomendacion(recomendacion.value);">
                    <input type="reset" class="Botones Naranja borrar" value="Borrar" onClick="Resetear('prueba');">
                    <div id="enviando" class="enviando" style="visibility: hidden;">Enviando mensaje...</div>
                    <div id="enviado" class="enviando" style="visibility: hidden;">Mensaje enviado correctamente.</div>
                    <div id="noenviado" class="enviando" style="visibility: hidden;">Mensaje no enviado.</div>
                </form>
            </div>
        </div>
        <div id="panelm" class="panelm">
            <div class="Fuente panelma">
                <form action="modulos/login.php?op=Abrir" method="POST">
                    <div class="panelma-1">Cambiar:</div>
                    <div class="panelma-1 panelma-2">
                        <select name="proyectoa" class="panelma-2-1" id="proyectoa">
                          <?php
						  	  $consulta = $BD->query("SELECT id_pro, nm_pro FROM pro WHERE id_usr='$id'");
                              $num = $consulta->num_rows;
                              for($i=0;$i<$num;$i++){
                                  $fetch = $consulta->fetch_array(MYSQLI_BOTH);
								  /*MUESTRA EL NOMBRE DEL PROYECTO SELECCIONADO*/
								  /*Y SI NO TIENE UNO SELECCIONADO, MUESTRA LA LISTA DE PROYECTOS */
								  if (isset($_SESSION["proyectonm"]) || isset($_SESSION["proyectonro"])){
									  if ($proyectonro == $fetch[0] || $proyectonm == $fetch[1]){
								  		echo "<option selected value='$proyectonro'>$proyectonm</option>";
										} else { 
											echo "<option value='$fetch[0]'>$fetch[1]</option>";
										}} else { 
									    	echo "<option value='$fetch[0]'>$fetch[1]</option>";
										}
                              }
						  ?>
                        </select>
                    </div>
                    <div class="panelma-1 panelma-3"><input class="Botones Naranja BtnPequeno" type="submit" name="submit" id="submit" value="OK"></div>
                </form>
                <form action="modulos/login.php?op=Eliminar" method="POST">
	                <div class="panelma-1 panelma-4"><input class="Botones Rojo BtnPequenoRojo" type="submit" name="submit" id="submit" value="X"></div> 
                </form>
            </div>
            <div class="Fuente panelmb">
                <form action="modulos/login.php?op=Crear" method="POST">
                    <div class="panelmb-1">Crear nuevo: </div>
                    <div class="panelmb-1 panelmb-2"><input name="proyectob" class="panelmb-2-1" type="text" id="proyectob" placeholder="Nombre del proyecto" size="20" maxlength="70"></div>
                    <div class="panelmb-1 panelmb-3"><input class="Botones Naranja BtnPequeno" type="submit" name="submit" id="submit" value="OK"></div>
                </form>
            </div>
            <div class="Fuente panelmc">
                <div class="panelmc-1">Modificar nombre: </div>
                <div id="divpro" class="panelmc-1 panelmc-2"><input name="proyectoc" required class="panelmc-2-1" type="text" id="proyectoc" placeholder="Nombre del proyecto" size="20" maxlength="70" value="<?php if (isset($_SESSION["proyectonm"]) || isset($_SESSION["proyectonro"])){echo $proyectonm;}?>"></div>
                <div class="panelmc-1 panelmc-3"><input onclick="ModificarProyecto(proyectoc.value);" class="Botones Naranja BtnPequeno" type="submit" name="submit" id="submit" value="OK"></div>
                <div id="cambiado" style="visibility: hidden;" class="panelmc-1 panelmc-4">Se ha modificado correctamente.</div>
                <div id="espacios" style="visibility: hidden;" class="panelmc-1 panelmc-4">No debe dejar espacios vacíos.</div>
            </div>
        </div>
        <div onclick="Visualizar('panelm');" id="proyectonm" class="Fuente ProyectoNM"><?php if (isset($_SESSION["proyectonm"]) || isset($_SESSION["proyectonro"])){echo "Proyecto: ".$proyectonm;} else { echo "Seleccionar proyecto..."; }?></div>
        <form action="modulos/login.php?op=Salir" method="POST">
        	<input name="cerrarsesion" type="submit" id="cerrarsesion" class="CerrarSesion" value="" border="2">
        </form>
		<footer><br><br><br><br><br><br><br><br><br></footer>
    </body>
</html>