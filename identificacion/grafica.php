<?php 
include 'dbcon/conectar_mysql.php';
$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);

$labels=array();
$col1=array();
$col2=array();
$col3=array();
$col4=array();
$col5=array();
$col6=array();

for ($i=0; $i < count($resultado); $i++) { 
	$labels[]=$resultado[$i][0];
	$col1[]=$resultado[$i][1];
	$col2[]=$resultado[$i][2];
	$col3[]=$resultado[$i][3];
	$col4[]=$resultado[$i][4];
	$col5[]=$resultado[$i][5];
	$col6[]=$resultado[$i][6];
}


// print_r($labels);
// echo "<br>".json_encode($labels);

$labels=json_encode($labels);
$col1=json_encode($col1);
$col2=json_encode($col2);
$col3=json_encode($col3);
$col4=json_encode($col4);
$col5=json_encode($col5);
$col6=json_encode($col6);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Grafica</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
	<canvas id="myChart"></canvas>
	<script>

		var datax = {
		  labels: <?php echo $labels; ?>,
		  datasets: [{
		      label: "Columna 1",
		      data: <?php echo $col1 ?>,
		      lineTension: 0,
		      borderColor: "red",
		      spanGaps: false,
		      backgroundColor: "transparent",
		    }, {
		      label: "Columna 2",
		      data: <?php echo $col2 ?>,
		      lineTension: 0,
		      borderColor: "blue",
		      spanGaps: false,
		      backgroundColor: "transparent",
		    }, {
		      label: "Columna 3",
		      data: <?php echo $col3 ?>,
		      lineTension: 0,
		      borderColor: "purple",
		      spanGaps: false,
		      backgroundColor: "transparent",
		    }, {
		      label: "Columna 4",
		      data: <?php echo $col4 ?>,
		      lineTension: 0,
		      borderColor: "green",
		      spanGaps: false,
		      backgroundColor: "transparent",
		    }, {
		      label: "Columna 5",
		      data: <?php echo $col5 ?>,
		      lineTension: 0,
		      borderColor: "black",
		      spanGaps: false,
		      backgroundColor: "transparent",
		    }, {
		      label: "Columna 6",
		      data: <?php echo $col6 ?>,
		      lineTension: 0,
		      borderColor: "yellow",
		      spanGaps: false,
		      backgroundColor: "transparent",
		    }

		  ]
		};
		
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    type: 'line',

		    // The data for our dataset
		    data: datax,

		    // Configuration options go here
		    options: {}
		});

	</script>
</body>
</html>