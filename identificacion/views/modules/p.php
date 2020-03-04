<?php
$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);
?>
<script src="views/modules/js/app.js"></script>
<div class="container-fluid">
	<div class="row">
		<h3>Insertar Datos</h3>
	</div>
	<hr>
	<div id="formInsert">
			<label for="columna">Elija una Opción</label>
			<select class="form-control" id="columna" onchange="validaInsert(this.value)">
				<option value="" disabled selected>Columna a Insertar...</option>
				<option value="col1">Columna 1</option>
				<option value="col2">Columna 2</option>
				<option value="col3">Columna 3</option>
				<option value="col4">Columna 4</option>
				<option value="col5">Columna 5</option>
				<option value="col6">Columna 6</option>
			</select>
			<hr>
			<div id="mensaje">
				
			</div>

			<div id="exito" style="display: none"></div>
	</div>
</div>