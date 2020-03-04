<?php
$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);
?>
<script>
	$(document).ready(function() {
	    $('#tablaDatos').DataTable({
	    	"dom" : "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
					"t<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
	    	"language": {
	    	                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
	    	            }
	    });
	} );
</script>
<div class="container-fluid">
	<div class="row">
			<table id="tablaDatos" class="table table-bordered table-sm table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Columna 1</th>
						<th>Columna 2</th>
						<th>Columna 3</th>
						<th>Columna 4</th>
						<th>Columna 5</th>
						<th>Columna 6</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < COUNT($resultado); $i++) {?>
					<tr>
						<td ><?php echo $resultado[$i][0];?></td>
						<td ><?php echo $resultado[$i][1];?></td>
						<td ><?php echo $resultado[$i][2];?></td>
						<td ><?php echo $resultado[$i][3];?></td>
						<td ><?php echo $resultado[$i][4];?></td>
						<td ><?php echo $resultado[$i][5];?></td>
						<td ><?php echo $resultado[$i][6];?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
	</div>
</div>