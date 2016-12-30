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
					"SELECT robotid, orderid
					FROM bak
					WHERE status='producten worden opgehaald'
					GROUP BY robotid"
			);
		?>
	<!-- amCharts javascript sources -->
		<script src="amcharts/amcharts.js" type="text/javascript"></script>
		<script src="amcharts/serial.js" type="text/javascript"></script>
		

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "category",
					"rotate": true,
					"startDuration": 1,
					"theme": "light",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"chartCursor": {
						"enabled": true
					},
					"trendLines": [],
					"graphs": [
						{
							"fillAlphas": 1,
							"id": "AmGraph-1",
							"tabIndex": -1,
							"title": "graph 1",
							"type": "column",
							"valueField": "Winst"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": "",
							"titleFontSize": 5
						}
					],
					"allLabels": [],
					"balloon": {},
					"titles": [
						{
							"id": "fefae",
							"size": 15,
							"text": "Top 5 producten met hoogste winst"
						}
					],
					"dataProvider": [
						<?php while($row2 = $queryResult2->fetch_assoc()): ?>{
							"ProductID": "<?php echo $row2['ProductID'];?>",
							"Winst": <?php echo $row2['Winst'];?>
						},<?php endwhile;?>
					]
				}
			);
		</script>
</head>
<body>
	<header> w
		<?php
			include "include/nav.html"
		?>
	</header>
	<div class='content'>
		<?php
			//vul de query in
			$queryResult1 = getQuery(
					"SELECT robotid, orderid
					FROM bak
					WHERE status='producten worden opgehaald'
					GROUP BY robotid"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>RobotID</td>
					<td>OrderID</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['robotid']; ?></td>
					<td><?php echo $row1['orderid']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
	</div>
</body>
</html>
