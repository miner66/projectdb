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
			$queryResult2 = getQuery("
				SELECT product.productid, product.naam, SUM(orderproducten.hoeveelheid) AS 'aantal'
				FROM orderproducten
				JOIN product ON orderproducten.productid=product.productid
				WHERE orderproducten.backorder=0
				GROUP BY product.productid
				ORDER BY `aantal` DESC
				LIMIT 5;"
			);
		?>
	<!-- amCharts javascript code -->
	<script src="amcharts/amcharts.js" type="text/javascript"></script>
	<script src="amcharts/serial.js" type="text/javascript"></script>
	<script type="text/javascript">
		AmCharts.makeChart("chartdiv",
			{
					"type": "serial",
					"categoryField": "Naam",
					"startDuration": 1,
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
							"title": "graph 1",
							"type": "column",
							"valueField": "Aantal"
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
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "Chart Title"
						}
					],
					"dataProvider": [
					<?php while($row2 = $queryResult2->fetch_assoc()): ?>{
						"Naam": "<?php echo $row2['naam'];?>",
						"Aantal": <?php echo $row2['aantal'];?>
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
				"SELECT product.productid, product.naam, SUM(orderproducten.hoeveelheid) AS 'aantal'
				FROM orderproducten
				JOIN product ON orderproducten.productid=product.productid
				WHERE orderproducten.backorder=0
				GROUP BY product.productid
				ORDER BY `aantal` DESC
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
					<td>Aantal</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['prdouctid']; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['aantal']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width:100%; height:400px;"></div>
	</div>
</body>
</html>