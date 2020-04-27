<?php 
$p_columnax=$_POST["param1"];
$p_columnay=$_POST["param2"];
include '../../../dbcon/conectar_mysql.php';
$db = new ConectarMySQL();
$resultado=$db->traer_matriz($db->sentencia("CALL analisis_correlacion('$p_columnax','$p_columnay');"));
$R=round($resultado[0][0],4);


if ($R>0.5) {
	$msj='La correlacion de datos es fuertemente positiva';
}elseif ($R<(-0.5)) {
	$msj='La correlacion de datos es fuertemente negativa';
}else{
	$msj='La correlacion de datos es nula';
}

?>
<br>
<div class="alert alert-dismissable alert-success">

<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	×
</button>
<h4>
	Mensaje
</h4> <strong>Resultado Obtenido! <br></strong> <?php echo "$msj"; ?> <br>
<strong><?php echo "Valor de R = $R"; ?></strong>
</div>