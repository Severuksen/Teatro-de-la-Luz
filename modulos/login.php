<?php
session_start();
if (!isset($_GET["op"])){
	echo "<meta charset='utf-8'>";
	echo "<script>alert('Usted no ha iniciado sesión'); window.location.assign('../index.php');</script>";
} elseif ($_GET["op"] == "Registro"){
	Registro();
} elseif ($_GET["op"] == "Entrar"){
	Entrar();
} elseif ($_GET["op"] == "Abrir"){
	Abrir();
} elseif ($_GET["op"] == "Crear"){
	Crear();
} elseif ($_GET["op"] == "Modificar"){
	Modificar();
} elseif ($_GET["op"] == "Eliminar"){
	Eliminar();
} elseif ($_GET["op"] == "Salir"){
	Salir();
} else {
	echo "<meta charset='utf-8'>";
	echo "<script>alert('Usted no ha iniciado sesión'); window.location.assign('../index.php');</script>";
}

/*////////////////////////////////////////////////////////////////////////////*/

function Registro(){
	require("consulta.php");
	$disenador  = $_REQUEST["disenador"];
    $contrasena = $_REQUEST["contrasena"];
	$ip         = $_SERVER["REMOTE_ADDR"];
	$correo     = $_REQUEST["correo"];
	date_default_timezone_set('America/Caracas');
	$fecha      = date("Y-m-d H:i:s");
	$contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
	/**********************************************************/
	$consultauno = consulta("SELECT id_usr,nm_usr FROM usr WHERE nm_usr = '".strtolower($disenador)."'","fetch-array");
	$consultados = consulta("SELECT cor_usr FROM usr WHERE cor_usr = '".strtolower($correo)."'","fetch-assoc");
	/**********************************************************/
	if ($consultauno["nm_usr"] == strtolower($disenador)){
		$_SESSION["mensajeregistro"] = "Nombre en uso.";
		echo "<script>window.location.assign('../index.php')</script>";
	} elseif ($consultados["cor_usr"] == strtolower($correo)){
		$_SESSION["mensajeregistro"] = "Correo en uso.";
		echo "<script>window.location.assign('../index.php')</script>";
	} else {
		if ($BD->query("INSERT INTO usr VALUES (NULL,'".strtolower(addslashes($disenador))."','".addslashes($contrasena)."','".strtolower(addslashes($correo))."')") == TRUE){
			$id = consulta("SELECT id_usr FROM usr WHERE nm_usr='$disenador'","fetch-array");
			if ($BD->query("INSERT INTO ssn VALUES (NULL, '$id[0]','1','$fecha','$ip')") == TRUE){
				$_SESSION["disenador"]  = $disenador;
				$_SESSION["contrasena"] = $contrasena;
				$_SESSION["id"] = $id[0];
				echo "<script>alert('Se ha creado la cuenta.'); window.location.assign('../main.php')</script>";
			}
		}
	}
}

/*////////////////////////////////////////////////////////////////////////////*/

function Entrar(){
	require("consulta.php");
	$disenador  = $_REQUEST["disenador"];
    $contrasena = $_REQUEST["contrasena"];
	$ip         = $_SERVER["REMOTE_ADDR"];
	date_default_timezone_set('America/Caracas');
	$fecha      = date("Y-m-d H:i:s");
	$resultado  = consulta("SELECT id_usr,clv_usr FROM usr WHERE nm_usr = '".addslashes($disenador)."'","fetch-array");
	if ($resultado["clv_usr"] == NULL) {
		$_SESSION["mensajeentrar"] = "La cuenta no existe";
		echo "<script>window.location.assign('../index.php');</script>";}
	elseif (!password_verify($contrasena,$resultado["clv_usr"])){
		echo "<meta charset='utf-8'>";
		$_SESSION["mensajeentrar"] = "Contraseña incorrecta";
		echo "<script>window.location.assign('../index.php');</script>";}
	else {
		if ($BD->query("INSERT INTO ssn VALUES (NULL, '$resultado[0]','1','$fecha','$ip')") == TRUE){
			$id = consulta("SELECT id_usr FROM usr WHERE nm_usr = '".addslashes($disenador)."'","fetch-array");
			$_SESSION["disenador"]  = $_REQUEST["disenador"];
			$_SESSION["contrasena"] = $_REQUEST["contrasena"];
			$_SESSION["id"] = $id[0];
			echo "<script>window.location.assign('../main.php')</script>";
		}
	}
}

/*////////////////////////////////////////////////////////////////////////////*/

function Abrir(){
	require("consulta.php");
	$proyecto = $_REQUEST["proyectoa"]; /*NUMERO DEL PROYECTO*/
	$id       = $_SESSION["id"]; /*ID DEL USUARIO*/
	$proyectonm = consulta("SELECT nm_pro FROM pro WHERE id_pro='$proyecto'","fetch-array");
	$_SESSION["proyectonm"]  = $proyectonm[0]; 
	$_SESSION["proyectonro"] = $proyecto;
	header('Location: ../main.php');
}

/*////////////////////////////////////////////////////////////////////////////*/

function Crear(){
	require("consulta.php");
	$proyecto = $_REQUEST["proyectob"]; //NOMBRE DEL PROYECTO
	$id = $_SESSION["id"]; //ID DEL USUARIO
	$insertar = $BD->query("INSERT INTO pro VALUES (NULL,'$id','$proyecto')"); 
	$consulta = consulta("SELECT id_pro FROM pro WHERE nm_pro='$proyecto'","fetch-array");
	$_SESSION["proyectonm"]  = $proyecto; 
	$_SESSION["proyectonro"] = $consulta[0];
	header('Location: ../main.php');
}

/*////////////////////////////////////////////////////////////////////////////*/

function Modificar(){
	require("consulta.php");
	$proyecto = $_REQUEST["proyectoc"];
	$sesion = $_SESSION["proyectonro"];
	$consulta = $BD->query("UPDATE pro SET nm_pro = '$proyecto' WHERE id_pro = '$sesion'");
	if ($consulta){
		$_SESSION["proyectonm"] = $proyecto;
		echo $proyecto;
	}
}

/*////////////////////////////////////////////////////////////////////////////*/

function Eliminar(){
	require("consulta.php");
	$proyecto = $_REQUEST["proyectoc"];
	$sesion = $_SESSION["proyectonro"];
	$consulta1 = $BD->query("DELETE FROM pro WHERE id_pro = '$proyecto'");
	$consulta2 = $BD->query("DELETE FROM pos WHERE id_pro = '$proyecto'");
	if ($consulta1 && $consulta2){
		header('Location: ../main.php');
	}

}

/*////////////////////////////////////////////////////////////////////////////*/

function Salir(){
	require("consulta.php");
	$disenador  = $_SESSION["disenador"];
	$ip         = $_SERVER["REMOTE_ADDR"];
	$id         = $_SESSION["id"];
	date_default_timezone_set('America/Caracas');
	$fecha      = date("Y-m-d H:i:s");
	if ($BD->query("INSERT INTO ssn VALUES (NULL, '$id','0','$fecha','$ip')") == TRUE){
		unset($_SESSION["disenador"]);
		unset($_SESSION["contrasena"]);
		unset($_SESSION["id"]);
		unset($_SESSION["proyectonm"]);
		unset($_SESSION["proyectonro"]);
		session_destroy();
		header('Location: ../index.php');
	}
}
?>