<style>
#chartdiv {
  width: 100%;
  height: 500px;
  max-width: 100%;
}
</style>

<?php

$db = new ConectarMySQL();
$sql="SELECT * FROM datosrandom";
$registros=$db->sentencia($sql);
$resultado=$db->traer_matriz($registros);
$labels=[];$col1=[];$col2=[];$col3=[];$col4=[];$col5=[];$col6=[];

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

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_spiritedaway);
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingRight = 20;


var datasets = [
		  [{
		      label: "Columna 1",
		      data: <?php echo json_encode($col1) ?>,
		    }, {
		      label: "Columna 2",
		      data: <?php echo json_encode($col2) ?>,
		    }, {
		      label: "Columna 3",
		      data: <?php echo json_encode($col3) ?>,
		    }, {
		      label: "Columna 4",
		      data: <?php echo json_encode($col4) ?>,
		    }, {
		      label: "Columna 5",
		      data: <?php echo json_encode($col5) ?>,
		    }, {
		      label: "Columna 6",
		      data: <?php echo json_encode($col6) ?>,
	        }]
	  ];

chart.data = datasets;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.grid.template.location = 0;
dateAxis.minZoomCount = 5;


// this makes the data to be grouped
dateAxis.groupData = true;
dateAxis.groupCount = 500;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.dateX = "date";
series.dataFields.valueY = "value";
series.tooltipText = "{valueY}";
series.tooltip.pointerOrientation = "vertical";
series.tooltip.background.fillOpacity = 0.5;

chart.cursor = new am4charts.XYCursor();
chart.cursor.xAxis = dateAxis;

var scrollbarX = new am4core.Scrollbar();
scrollbarX.marginBottom = 20;
chart.scrollbarX = scrollbarX;

}); // end am4core.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>