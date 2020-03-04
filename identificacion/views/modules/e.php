<script src="views/modules/js/app.js"></script>
<?php 
	$db = new ConectarMySQL();
	$totalRegistros=$db->traer_matriz($db->sentencia("SELECT COUNT(*) FROM datosrandom;"));
?>
<?php if ($totalRegistros[0][0]>0){ ?>
	<button class="btn btn-danger" id="btnEliminar" onclick="eliminar();">Eliminar Datos</button>	
<?php }else{ ?>
	<div class="alert alert-dismissable alert-warning">

	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
		×
	</button>
	<strong>Alerta.</strong> No hay datos para borrar.
	</div>
<?php } ?>
<div id="exito" style="display: none"></div>