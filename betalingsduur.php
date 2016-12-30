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
					"SELECT klant.klantid, klant.naam, AVG(DATEDIFF(factuur.datumlaatsteactie, orderklant.datumlaatsteactie)) AS 'betalingsduur in dagen'
					FROM orderklant
					JOIN factuur ON orderklant.orderid=factuur.orderid
					JOIN klant ON klant.klantid=orderklant.klantid
					WHERE factuur.status='betaald'
					AND orderklant.status='afgehandeld'
					GROUP BY klant.klantid;"
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
					"categoryAxis": {
						"gridPosition": "start"
					},
					"chartCursor": {
						"enabled": true
					},
					"chartScrollbar": {
						"enabled": true
					},
					"trendLines": [],
					"graphs": [
						{
							"fillAlphas": 1,
							"id": "AmGraph-1",
							"title": "graph 1",
							"type": "column",
							"valueField": "betalingsduur in dagen"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": ""
						}
					],
					"allLabels": [],
					"balloon": {},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "Gemiddelde betalingsduur van factuur"
						}
					],
					"dataProvider": [
						<?php while($row2 = $queryResult2->fetch_assoc()): ?>{
							"Naam": "<?php echo $row2['naam'];?>",
							"Duur": <?php echo $row2['betalingsduur in dagen'];?>
						},<?php endwhile;?>
					]
				}
			);
		</script>
</head>
<body>
	<header> 
		<h1> To dodelydo </h1>
	
	
	
		<?php
			include "include/nav.html"
		?>
	</header>
	<div class='content'>
		<?php
			//vul de query in
			$queryResult1 = getQuery(
					"SELECT klant.klantid, klant.naam, AVG(DATEDIFF(factuur.datumlaatsteactie, orderklant.datumlaatsteactie)) AS 'betalingsduur in dagen'
					FROM orderklant
					JOIN factuur ON orderklant.orderid=factuur.orderid
					JOIN klant ON klant.klantid=orderklant.klantid
					WHERE factuur.status='betaald'
					AND orderklant.status='afgehandeld'
					GROUP BY klant.klantid;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>KlantID</td>
					<td>Naam</td>
					<td>Betalingsduur in dagen</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['klantid']; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['betalingsduur in dagen']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</div>
</body>
</html>