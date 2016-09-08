<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"

header('Content-type: text/html; charset=UTF-8');  
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=pruebas.czsf3gnrfqtq.us-west-2.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SID=ORCL)))";
$conn = oci_connect("pruebas", "ninise92", $tns);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

/*
$conn = oci_connect('AUTOMOTOR', 'automotor', '192.168.1.89/automotor');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}*/
$claseVehiculo1= $_POST['claseVehiculo'];
//Tabla con informacion de las ciudades
$stid = oci_parse($conn, "SELECT CODIGO, NOMBRE FROM AC_P_MARCA M WHERE CLASE_VEHICULO= '${claseVehiculo1}' ORDER BY M.NOMBRE ASC");
oci_execute($stid);

$rows = [];

while($row = oci_fetch_assoc($stid))
{
	$rows[] = $row;
}
 echo (json_encode($rows));

?>
