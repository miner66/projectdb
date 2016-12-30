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
					"SELECT product.productid,product.naam, inkoopprijs.prijs AS 'inkoopprijs', verkoopprijs.prijs AS 'verkoopprijs', (verkoopprijs.prijs-inkoopprijs.prijs) AS 'winst'
					FROM product
					JOIN verkoopprijs ON verkoopprijs.productid=product.productid
					JOIN inkoopprijs ON inkoopprijs.productid=product.productid
					WHERE verkoopprijs.prijs IS NOT NULL
					GROUP BY product.productid
					HAVING MAX(verkoopprijs.datum)
					AND MAX(inkoopprijs.datum)
					ORDER BY `winst` DESC
					LIMIT 5;"
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
					"categoryField": "ProductID",
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
							"ProductID": "<?php echo $row2['productid'];?> <?php echo $row2['naam'];?>",
							"Winst": <?php echo $row2['winst'];?>
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
					"SELECT product.productid,product.naam, inkoopprijs.prijs AS 'inkoopprijs', verkoopprijs.prijs AS 'verkoopprijs', (verkoopprijs.prijs-inkoopprijs.prijs) AS 'winst'
					FROM product
					JOIN verkoopprijs ON verkoopprijs.productid=product.productid
					JOIN inkoopprijs ON inkoopprijs.productid=product.productid
					WHERE verkoopprijs.prijs IS NOT NULL
					GROUP BY product.productid
					HAVING MAX(verkoopprijs.datum)
					AND MAX(inkoopprijs.datum)
					ORDER BY `winst` DESC
					LIMIT 5;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>ID</td>
					<td>Naam</td>
					<td>Inkoopprijs</td>
					<td>Verkoopprijs</td>
					<td>Winst</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['productid']; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['inkoopprijs']; ?></td>
					<td><?php echo $row1['verkoopprijs']; ?></td>
					<td><?php echo $row1['winst']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</div>
</body>
</html>
