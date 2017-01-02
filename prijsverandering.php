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
			if(isset($_GET["product"])){
				$queryResult2 = getQuery(
					"SELECT product.productid, product.naam, inkoopprijs.prijs, inkoopprijs.datum
					FROM product
					JOIN inkoopprijs ON inkoopprijs.productid=product.productid
					WHERE product.productid =" . $_GET["product"] . "
					ORDER BY product.productid, inkoopprijs.datum;"
					);
			}	
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
					"chartScrollbar": {
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
							"valueField": "Openstaande Orders"
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
							"text": "Aantal openstaande orders"
						}
					],
					"dataProvider": [
						<?php while($row2 = $queryResult2->fetch_assoc()): ?>{
							"Naam": "<?php echo $row2['naam'];?>",
							"Aantal": <?php echo $row2['Aantal'];?>
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
			if(isset($_GET["product"]))
			{
				$queryResult1 = getQuery(
					"SET @productnaam=$_GET["product"]);
					SELECT product.productid, product.naam, inkoopprijs.prijs, inkoopprijs.datum
					FROM product
					JOIN inkoopprijs ON inkoopprijs.productid=product.productid
					WHERE product.naam = @productnaam
					ORDER BY product.productid, inkoopprijs.datum;"
				);
			} else {
				
				$queryResult1 = getQuery(
					"SELECT productid, naam
					FROM product
					GROUP BY productid;"
				);
					
					
			}
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<?php
			if(isset($_GET["product"])){



			} else {
				echo "
				<table id='resultTable'>
					<thead>
						<tr>
							<td>ProductID</td>
							<td>Naam</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
						<tr>
							<?php $product=$row1['productid']?>
							<td><?php echo $product; ?></td>
							<td><?php echo $row1['naam']; ?></td>
							<td> <input type="submit" name="product" value = <?php echo $product; ?> > </td>
						</tr>
						<?php endwhile;?>
					</tbody>
				</table>
				
		<hr>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>";
		}
		?>
		
		
	</div>
</body>
</html>
