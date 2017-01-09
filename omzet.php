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
					"SELECT medewerkers.naam, SUM(verkoopprijs.prijs*orderproducten.hoeveelheid) AS 'totaleomzetmedewerker'
					FROM medewerkers
					JOIN orderklant ON orderklant.medewerkerid=medewerkers.medewerkerid
					JOIN orderproducten ON orderproducten.orderid=orderklant.orderid
					JOIN product ON product.productid=orderproducten.productid
					JOIN verkoopprijs ON verkoopprijs.productid=product.productid
					WHERE verkoopprijs.datum<orderklant.datumorder
					GROUP BY medewerkers.medewerkerid
					HAVING MAX(verkoopprijs.datum)
					ORDER BY `totaleomzetmedewerker` DESC;"
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
							"valueField": "totaleomzetmedewerker"
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
							"text": "Omzet per medewerker"
						}
					],
					"dataProvider": [
						<?php while($row2 = $queryResult2->fetch_assoc()): ?>{
							"Naam": "<?php echo $row2['naam'];?>",
							"totaleomzetmedewerker": <?php echo $row2['totaleomzetmedewerker'];?>
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
					"SELECT medewerkers.naam, SUM(verkoopprijs.prijs*orderproducten.hoeveelheid) AS 'totaleomzetmedewerker'
					FROM medewerkers
					JOIN orderklant ON orderklant.medewerkerid=medewerkers.medewerkerid
					JOIN orderproducten ON orderproducten.orderid=orderklant.orderid
					JOIN product ON product.productid=orderproducten.productid
					JOIN verkoopprijs ON verkoopprijs.productid=product.productid
					WHERE verkoopprijs.datum<orderklant.datumorder
					GROUP BY medewerkers.medewerkerid
					HAVING MAX(verkoopprijs.datum)
					ORDER BY `totaleomzetmedewerker` DESC;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Naam</td>
					<td>Totale omzet medewerker</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['totaleomzetmedewerker']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
		
	</div>
</body>
</html>
