<?php
session_start();

require("consulta.php");
$disenador = $_SESSION["disenador"];
$id        = $_SESSION["id"];
if (isset($_REQUEST["senal"])){
	$senal = $_REQUEST["senal"];
	/***********************************************AÑADIR SWITCH*/
	if ($senal == "eliminar"){
		$codigo = $_REQUEST["id"];
		if ($BD->query("DELETE FROM pos WHERE id_p='$codigo'") == TRUE){
			echo "Se ha guardado.";}}
	/************************************************/
	elseif ($senal == "guardar"){
		$id       = $_SESSION["id"];
		$ang      = $_REQUEST["ang"];
		$codigo   = $_REQUEST["id"];
		$top      = $_REQUEST["top"];
		$left     = $_REQUEST["left"];
		if ($BD->query("UPDATE pos SET p_x = '$top', p_y = '$left', ang = '$ang' WHERE id_usr='$id' AND id_p='$codigo'") == TRUE){
			echo "Se ha guardado.";
		}
	}
	/************************************************/
	elseif ($senal == "insertar"){
		$luces    = $_REQUEST["aceptar"];
		$proyecto = $_SESSION["proyectonro"];
		$id       = $_SESSION["id"];
		$idl      = consulta("SELECT nm_luz FROM luz WHERE id_luz = $luces","fetch-array");
		if ($BD->query("INSERT INTO pos VALUES (NULL, $id, $luces,'$proyecto','9px','6px','90px','90px', '0.000')") == TRUE){
			if ($idn = $BD->query("SELECT id_p FROM pos WHERE id_usr = '$id' ORDER BY id_p DESC")){
				$ida = $idn->fetch_array(MYSQLI_BOTH);
				echo "$ida[0]+$idl[0]";
			}
		}
	}
	/************************************************/
} else {
	echo "<meta charset='utf-8'>";
	echo "<script>alert('Usted no ha iniciado sesión'); window.location.assign('index.php');</script>";
}
?>