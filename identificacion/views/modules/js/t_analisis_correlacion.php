<?php 
$param1=$_POST["param1"];
$param2=$_POST["param2"];
$etiquetaP1=$_POST["label1"];
$etiquetaP2=$_POST["label2"];
include '../../../dbcon/conectar_mysql.php';
$db = new ConectarMySQL();
$resultado=$db->traer_matriz($db->sentencia("SELECT $param1, $param2 FROM identificacion.datosrandom order by id asc;"));
?>
<script>
	$(document).ready(function() {
	    $('#tablaAnalisis').DataTable({
	    	"dom" : "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
					"t<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
	    	"language": {
	    	                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
	    	            }
	    });
	} );
</script>
<br>
<div class="container-fluid">
	<div class="row">
			<table id="tablaAnalisis" class="table table-bordered table-sm table-hover">
				<thead>
					<tr>
						<th><?php echo $etiquetaP1; ?></th>
						<th><?php echo $etiquetaP2; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < COUNT($resultado); $i++) {?>
					<tr>
						<td ><?php echo $resultado[$i][0];?></td>
						<td ><?php echo $resultado[$i][1];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
	</div>
</div>