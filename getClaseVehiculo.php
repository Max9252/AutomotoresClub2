<?php
// Conectar al servicio XE (es deicr, la base de datos) en la máquina "localhost"

header('Content-type: text/html; charset=UTF-8');  
$tns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=pruebas.czsf3gnrfqtq.us-west-2.rds.amazonaws.com)(PORT=1521))(CONNECT_DATA=(SID=ORCL)))";
$conn = oci_connect("pruebas", "ninise92", $tns);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
//Tabla con informacion de los usuarios
$claseVehiculo= $_POST['clase_vehiculo'];
$stid = oci_parse($conn, "SELECT NOMBRE FROM AC_P_CLASE_VEHICULO WHERE Codigo= '${claseVehiculo}'");
oci_execute($stid);

$rows = [];

while($row = oci_fetch_assoc($stid))
{
	$rows[] = $row;
}
 echo (json_encode(utf8ize($rows)));

 
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
?>
