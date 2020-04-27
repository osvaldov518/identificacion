<script src="views/modules/js/app.js"></script>
<div class="container-fluid">
	<div class="row">
		<h3>&nbsp Analisis de Correlación (Entre 2 Columnas)</h3>
	</div>
	<hr>
	<div id="formConsultaAC">
			<label for="columna">Elija 2 columnas...</label>
			<hr>
			<select class="form-control" id="columnaParam1">
				<option value="" disabled selected>Columna...</option>
				<option value="col1">Columna 1</option>
				<option value="col2">Columna 2</option>
				<option value="col3">Columna 3</option>
				<option value="col4">Columna 4</option>
				<option value="col5">Columna 5</option>
				<option value="col6">Columna 6</option>
			</select>
			<hr>
			<select class="form-control" id="columnaParam2">
				<option value="" disabled selected>Columna...</option>
				<option value="col1">Columna 1</option>
				<option value="col2">Columna 2</option>
				<option value="col3">Columna 3</option>
				<option value="col4">Columna 4</option>
				<option value="col5">Columna 5</option>
				<option value="col6">Columna 6</option>
			</select>
			<hr>
			<button class="btn btn-success" onclick="calcularCorrelacion();tablaAnalisisCorrelacion();">Calcular Correlación</button>
			<hr>
			<div class="row">
				<div class="col-md-6" id="tabla">
					
				</div>
				<div class="col-md-6" id="analisis" style="display: none"></div>
			</div>
	</div>
</div>