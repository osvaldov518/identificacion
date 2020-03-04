<?php 
include '../../../dbcon/conectar_mysql.php';
$db = new ConectarMySQL();
$totalRegistros=$db->traer_matriz($db->sentencia("SELECT COUNT(*) FROM datosrandom;"));
$db->sentencia("TRUNCATE TABLE datosrandom;");
?>
<br>
<div class="alert alert-dismissable alert-info">

<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	×
</button>
<h4>
	Información
</h4> <strong>Finalizado!</strong> Se han eliminado <?php echo $totalRegistros[0][0]; ?> Registros
</div>