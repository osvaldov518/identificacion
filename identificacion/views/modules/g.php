<?php

$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);

for ($i=0; $i < count($resultado); $i++) { 
	$labels[]=$resultado[$i][0];
	$col1[]=$resultado[$i][1];
	$col2[]=$resultado[$i][2];
	$col3[]=$resultado[$i][3];
	$col4[]=$resultado[$i][4];
	$col5[]=$resultado[$i][5];
	$col6[]=$resultado[$i][6];
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
	      label: "Columna 2",
	      data: <?php echo json_encode($col2) ?>,
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
	      label: "Columna 4",
	      data: <?php echo json_encode($col4) ?>,
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
	      label: "Columna 6",
	      data: <?php echo json_encode($col6) ?>,
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
	    options: {
	    	plugins: {
	    	      zoom: {
	    	        pan: {
	    	          enabled: true,
	    	          mode: 'x'
	    	        },
	    	        zoom: {
	    	          enabled: true,
	    	          mode: 'x'
	    	        }
	    	      }
	    	    },  
	    }
	});

</script>