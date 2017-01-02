<!DOCTYPE html>
<html lang="nl">
<head>
	<title> B1b Schermen Timaflu </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/datatables.css"/>
	<?php
		include "include/functions.php"
	?>
	<script type="text/javascript" src="js/jquery-2.2.4.js"></script>
	<script type="text/javascript" src="js/datatables.js"></script>
	<script src='js/search.js'></script>
	<script>
		$(document).ready( function () {
			$('#resultTable').DataTable();
		} );
	</script>
	<?php
			//vul de query in
			$queryResult2 = getQuery(
					"SELECT YEARWEEK(datumtijd) AS 'week', CONCAT('Week ' , DATE_FORMAT(datumtijd, '%V') , ' van ' , DATE_FORMAT(datumtijd, '%x')) AS 'datum', CONCAT(((COUNT(locatiecode)/(SELECT COUNT(*) FROM locatiecodes))*100) , '%') AS 'percentage gevuld'
					FROM magazijntotaal
					GROUP BY YEARWEEK(datumtijd)
					HAVING SUM(hoeveelheid)>0
					AND `week` >=YEARWEEK(DATE_SUB(NOW(),INTERVAL 52 WEEK))
ORDER BY `week` ASC;"
			);
		?>
	<!-- amCharts javascript code -->
	<script src="amcharts/amcharts.js" type="text/javascript"></script>
	<script src="amcharts/pie.js" type="text/javascript"></script>
	<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "category",
					"startDuration": 1,
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"bullet": "round",
							"id": "AmGraph-1",
							"title": "graph 1",
							"valueField": "column-1"
						},
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"bullet": "square",
							"id": "AmGraph-2",
							"title": "graph 2",
							"valueField": "column-2"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": "Axis title"
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true,
						"useGraphSettings": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "Magazijn bezetting"
						}
					],
					"dataProvider": [
					<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
					
					
						{
							"category": "<?php echo $row1['datum']; ?>",
							"column-1": <?php echo $row1['percentage gevuld']; ?>
						},
						<?php endwhile;?>
						{
							"category": "category 2",
							"column-1": 6
						},
						{
							"category": "category 3",
							"column-1": 2
						},
						{
							"category": "category 4",
							"column-1": 1
						},
						{
							"category": "category 5",
							"column-1": 2
						},
						{
							"category": "category 6",
							"column-1": 3
						},
						{
							"category": "category 7",
							"column-1": 6
						}
					]
				}
			);
		</script>
	</head>
	<body>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</body>
</html>
</head>
<body>
	<header> 
		<?php
			include "include/nav.html"
		?>
	</header>
	<div class='content'>
		<?php
			//vul de query in
			$queryResult1 = getQuery(
					"SELECT YEARWEEK(datumtijd) AS 'week', CONCAT('Week ' , DATE_FORMAT(datumtijd, '%V') , ' van ' , DATE_FORMAT(datumtijd, '%x')) AS 'datum', CONCAT(((COUNT(locatiecode)/(SELECT COUNT(*) FROM locatiecodes))*100) , '%') AS 'percentage gevuld'
					FROM magazijntotaal
					GROUP BY YEARWEEK(datumtijd)
					HAVING SUM(hoeveelheid)>0
					AND `week` >=YEARWEEK(DATE_SUB(NOW(),INTERVAL 52 WEEK))
					ORDER BY `week` ASC;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Datum</td>
					<td>Percentage gevuld</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['datum']; ?></td>
					<td><?php echo $row1['percentage gevuld']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width:100%; height:400px;"></div>
	</div>
</body>
</html>