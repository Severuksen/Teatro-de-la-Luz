<?php
$BD = new mysqli("localhost", "root", "thennet", "iluminacion");
function consulta($query,$mod){
	$BD = new mysqli("localhost", "root", "thennet", "iluminacion");
	$consulta = $BD->query($query);
	if ($mod == "num-rows"){
		$modo = $consulta->num_rows;}
	elseif ($mod == "fetch-assoc"){
		$modo = $consulta->fetch_assoc();}
	elseif ($mod == "fetch-array"){
		$modo = $consulta->fetch_array(MYSQLI_BOTH);}
	return $modo;
}
?>