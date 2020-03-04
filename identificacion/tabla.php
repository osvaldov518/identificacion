<?php 
include 'dbcon/conectar_mysql.php';
$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>Mockup</title>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<table class="table table-bordered table-sm table-hover">
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
	</div>
</body>
</html>