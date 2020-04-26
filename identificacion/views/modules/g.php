<?php

$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);
$labels=[];$col1=[];$col2=[];$col3=[];$col4=[];$col5=[];$col6=[];
$tendencia1=[];$tendencia2=[];$tendencia3=[];$tendencia4=[];$tendencia5=[];$tendencia6=[];

for ($i=0; $i < count($resultado); $i++) { 
	$labels[]=$resultado[$i][0];
	$col1[]=$resultado[$i][1];
	$col2[]=$resultado[$i][2];
	$col3[]=$resultado[$i][3];
	$col4[]=$resultado[$i][4];
	$col5[]=$resultado[$i][5];
	$col6[]=$resultado[$i][6];
	$tendencia1[]=$resultado[$i][7];
	$tendencia2[]=$resultado[$i][8];
	$tendencia3[]=$resultado[$i][9];
	$tendencia4[]=$resultado[$i][10];
	$tendencia5[]=$resultado[$i][11];
	$tendencia6[]=$resultado[$i][12];
}

?>

<canvas id="myChart"></canvas>
<script>

	var datax = {
	  labels: <?php echo json_encode($labels); ?>,
	  datasets: [{
	      label: "Columna 1",
	      data: <?php echo json_encode($col1) ?>,
	      lineTension: 0,
	      borderColor: "red",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Tendencia 1",
	      data: <?php echo json_encode($tendencia1) ?>,
	      borderDash: [10,5],
	      hidden: true,
	      lineTension: 0,
	      borderColor: "red",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Columna 2",
	      data: <?php echo json_encode($col2) ?>,
	      lineTension: 0,
	      borderColor: "blue",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Tendencia 2",
	      data: <?php echo json_encode($tendencia2) ?>,
	      borderDash: [10,5],
	      hidden: true,
	      lineTension: 0,
	      borderColor: "blue",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Columna 3",
	      data: <?php echo json_encode($col3) ?>,
	      lineTension: 0,
	      borderColor: "purple",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Tendencia 3",
	      data: <?php echo json_encode($tendencia3) ?>,
	      borderDash: [10,5],
	      hidden: true,
	      lineTension: 0,
	      borderColor: "purple",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Columna 4",
	      data: <?php echo json_encode($col4) ?>,
	      lineTension: 0,
	      borderColor: "green",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Tendencia 4",
	      data: <?php echo json_encode($tendencia4) ?>,
	      borderDash: [10,5],
	      hidden: true,
	      lineTension: 0,
	      borderColor: "green",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Columna 5",
	      data: <?php echo json_encode($col5) ?>,
	      lineTension: 0,
	      borderColor: "black",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Tendencia 5",
	      data: <?php echo json_encode($tendencia5) ?>,
	      borderDash: [10,5],
	      hidden: true,
	      lineTension: 0,
	      borderColor: "black",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Columna 6",
	      data: <?php echo json_encode($col6) ?>,
	      lineTension: 0,
	      borderColor: "yellow",
	      spanGaps: false,
	      backgroundColor: "transparent",
	    }, {
	      label: "Tendencia 6",
	      data: <?php echo json_encode($tendencia6) ?>,
	      borderDash: [10,5],
	      hidden: true,
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