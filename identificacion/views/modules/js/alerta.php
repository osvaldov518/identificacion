<?php



include '../../../dbcon/conectar_mysql.php';
$nomColumna=$_POST["nomColumna"];
$db = new ConectarMySQL();
$regTotal=$db->traer_matriz($db->sentencia("SELECT COUNT(*) FROM datosrandom;"));
if ($regTotal[0][0] == 0) {
	$val=$db->traer_matriz($db->sentencia("SELECT COUNT(*) FROM datosrandom WHERE $nomColumna IS NULL;"));
	if ($val[0][0] >= 1) { ?>
		<div class="alert alert-dismissable alert-danger">
		 
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			×
		</button>
		<h4>
			Alerta!
		</h4> <strong>Error!</strong> La columna seleccionada ya contiene información.
		</div>
<?php
	}else{ ?>
		<select class="form-control" id="tipoDato">
			<option value="" disabled >Tipo de dato a Insertar...</option>
			<option value="d">Discreto (Sin Decimales)</option>
			<option value="c">Continuo (Con Decimales)</option>
		</select>
		<br>
		<!-- <a class="btn btn-danger" href="./" >Atrás</a> -->
		<button class="btn btn-primary" onclick="insertar();">Enviar</button>
<?php
	} //continuacion IF
}else{ 	$val=$db->traer_matriz($db->sentencia("SELECT COUNT(*) FROM datosrandom WHERE $nomColumna IS NULL;"));
	if ($val[0][0] < 1) { ?>
		<div class="alert alert-dismissable alert-danger">
		 
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			×
		</button>
		<h4>
			Alerta!
		</h4> <strong>Error!</strong> La columna seleccionada ya contiene información.
		</div>
<?php
	}else{ ?>
		<select class="form-control" id="tipoDato">
			<option value="" disabled >Tipo de dato a Insertar...</option>
			<option value="d">Discreto (Sin Decimales)</option>
			<option value="c">Continuo (Con Decimales)</option>
		</select>
		<br>
		<!-- <a class="btn btn-danger" href="./" >Atrás</a> -->
		<button class="btn btn-primary" onclick="insertar();">Enviar</button>
<?php
	}

}



?>