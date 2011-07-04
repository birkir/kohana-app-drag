<script type="text/javascript">
	var chart;
	var chartData = [<?php

	foreach ($matches as $i => $match)
	{
		$time = ($competitor_id == $match->competitor_a) ? $match->a_time : $match->b_time;
		$time = $time->as_array();

		$time['date'] = date('d.m.y H:i', strtotime($time['date']));

		if ($time['60ft'] == '0.000' AND $time['660ft'] == '0.000' AND $time['1320ft'] == '0.000')
		{
			continue;
		}

		if ($i > 0)
		{
			echo ",";
		}

		echo json_encode($time);
	}

?>];
	var newValueAxis;
	var addAxis;
	var removeAxis;

	window.onload = function(){
		chart = new AmCharts.AmSerialChart();
		chart.pathToImages = "/media/img/amcharts/";
		chart.addListener("dataUpdated", zoom);
		chart.marginTop = 15;
		chart.marginLeft = 35;
		chart.marginRight = 35;
		chart.dataProvider = chartData;
		chart.categoryField = "date";

		var timeAxis = new AmCharts.ValueAxis();
		timeAxis.axisColor = "#FF6600";
		timeAxis.axisThickness = 2;
		chart.addValueAxis(timeAxis);

		var speedAxis = new AmCharts.ValueAxis();
		speedAxis.position = "right";
		speedAxis.gridAlpha = 0;
		speedAxis.axisColor = "#FCD202";
		speedAxis.axisThickness = 2;
		speedAxis.minimum = 50;
		chart.addValueAxis(speedAxis);

		var graph0 = new AmCharts.AmGraph();
		graph0.valueAxis = timeAxis;
		graph0.valueField = "60ft";
		graph0.type = "smoothedLine";
		graph0.bullet = "none";
		graph0.lineThickness = 2;
		graph0.hideBulletsCount = 30;
		graph0.balloonText = '[[value]] - 60ft';
		chart.addGraph(graph0);

		var graph1 = new AmCharts.AmGraph();
		graph1.valueAxis = timeAxis;
		graph1.valueField = "660ft";
		graph1.type = "smoothedLine";
		graph1.bullet = "none";
		graph1.lineThickness = 2;
		graph1.hideBulletsCount = 30;
		graph1.balloonText = '[[value]] - 660ft';
		chart.addGraph(graph1);

		var graph2 = new AmCharts.AmGraph();
		graph2.valueAxis = speedAxis;
		graph2.valueField = "660mph";
		graph2.type = "smoothedLine";
		graph2.bullet = "none";
		graph2.lineThickness = 2;
		graph2.hideBulletsCount = 30;
		graph2.balloonText = '[[value]] - 660mph';
		chart.addGraph(graph2);

		var graph3 = new AmCharts.AmGraph();
		graph3.valueAxis = timeAxis;
		graph3.valueField = "1320ft";
		graph3.type = "smoothedLine";
		graph3.bullet = "none";
		graph3.lineThickness = 2;
		graph3.hideBulletsCount = 30;
		graph3.balloonText = '[[value]] - 1320ft';
		chart.addGraph(graph3);

		var graph4 = new AmCharts.AmGraph();
		graph4.valueAxis = speedAxis;
		graph4.valueField = "1320mph";
		graph4.type = "smoothedLine";
		graph4.bullet = "none";
		graph4.lineThickness = 2;
		graph4.hideBulletsCount = 30;
		graph4.balloonText = '[[value]] - 1320mph';
		chart.addGraph(graph4);

		var graph5 = new AmCharts.AmGraph();
		graph5.valueAxis = timeAxis;
		graph5.valueField = "rt";
		graph5.type = "smoothedLine";
		graph5.bullet = "none";
		graph5.lineThickness = 2;
		graph5.hideBulletsCount = 30;
		graph5.balloonText = '[[value]] - RT';
		chart.addGraph(graph5);

		var graph6 = new AmCharts.AmGraph();
		graph6.valueAxis = timeAxis;
		graph6.valueField = "index";
		graph6.type = "smoothedLine";
		graph6.bullet = "none";
		graph6.lineThickness = 2;
		graph6.hideBulletsCount = 30;
		graph6.balloonText = '[[value]] - Index';
		chart.addGraph(graph6);

		var chartCursor = new AmCharts.ChartCursor();
		chart.addChartCursor(chartCursor);

		var chartScrollbar = new AmCharts.ChartScrollbar();
		chartScrollbar.graph = graph0;
		chart.addChartScrollbar(chartScrollbar);

		chart.write("times_chart");
	}
	
	function zoom(){
		chart.zoomToIndexes(0,10);
	}
</script>
<div id="times_chart" style="width: 100%; height: 300px;"></div>