<?php 
$p_columna=$_POST["nomColumna"];
$p_tipodato=$_POST["tipoDato"];
include '../../../dbcon/conectar_mysql.php';
$db = new ConectarMySQL();
$totalRegistros=$db->traer_matriz($db->sentencia("SELECT COUNT(*) FROM datosrandom;"));

if ($totalRegistros[0][0]>0) {
	for ($i=1; $i <= 500; $i++) {
		
		if ($p_tipodato=='d') {
			$val=number_format(mt_rand(99,500));
		}else{
			$val=number_format((mt_rand(99,500)/1.01),3);
		}
		$sql="UPDATE datosrandom SET $p_columna = $val WHERE id = $i";
		$registros=$db->sentencia($sql);
	}
}else{
	for ($i=1; $i <= 500; $i++) {
		
		if ($p_tipodato=='d') {
			$val=number_format(mt_rand(99,500));
		}else{
			$val=number_format((mt_rand(99,500)/1.01),3);
		}
		$sql="INSERT INTO datosrandom (id ,$p_columna) VALUES ($i, $val);";
		$registros=$db->sentencia($sql);
	}
}

// 
	$sql = "CALL generar_tendencia('$p_columna');";
	$registros=$db->sentencia($sql);

	$sql = "CALL corte_de_picos('$p_columna');";
	$registros=$db->sentencia($sql);
// 
?>
<br>
<div class="alert alert-dismissable alert-success">

<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	×
</button>
<h4>
	Mensaje
</h4> <strong>Correcto!</strong> Los datos se insertaron correctamente
</div>