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
					"SELECT klant.naam, klant.klantid, COUNT(orderklant.orderid) AS 'Aantal'
					FROM orderklant
					JOIN factuur ON factuur.orderid=orderklant.orderid
					JOIN klant ON klant.klantid=orderklant.klantid
					WHERE orderklant.status='afgehandeld'
					AND factuur.status<>'betaald'
					GROUP BY klant.klantid"
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
					"categoryField": "Naam",
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
							"valueField": "Aantal"
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
							"text": "Aantal onbetalde orders"
						}
					],
					"dataProvider": [
						<?php while($row2 = $queryResult2->fetch_assoc()): ?>{
							"Naam": "<?php echo $row2['naam'];?>",
							"Aantal": "<?php echo $row2['Aantal'];?>"
						},<?php endwhile;?>
					]
				}
			);
		</script>
	
	
	
	
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
					"SELECT naam, orderklant.orderid, factuur.`status`, factuur.datumlaatsteactie
					FROM orderklant
					JOIN factuur ON factuur.orderid=orderklant.orderid
					JOIN klant ON klant.klantid=orderklant.klantid
					WHERE orderklant.status='afgehandeld'
					AND factuur.status<>'betaald'
					ORDER BY naam;"
			);
		?>
		
		<!-- maak er een table van -->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Naam</td>
					<td>Order ID</td>
					<td>Status betaling</td>
					<td>Datum laatste actie</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['orderid']; ?></td>
					<td><?php echo $row1['status']; ?></td>
					<td><?php echo $row1['datumlaatsteactie']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</div>
</body>
</html>
