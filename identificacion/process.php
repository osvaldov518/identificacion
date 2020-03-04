<?php 
include 'dbcon/conectar_mysql.php';
$db = new ConectarMySQL();

for ($i=1; $i <= 1500; $i++) { 
	$val1 = number_format((mt_rand(1,100)/5),3);
	$val2 = number_format((mt_rand(1,100)/5),3);
	$val3 = number_format((mt_rand(1,100)/5),3);
	$val4 = number_format((mt_rand(1,100)/5),3);
	$val5 = number_format((mt_rand(1,100)/5),3);
	$val6 = number_format((mt_rand(1,100)/5),3);
	$sql="INSERT INTO datosrandom VALUES ($i, $val1, $val2, $val3, $val4, $val5, $val6)";
	$registros=$db->sentencia($sql);
}
?>
