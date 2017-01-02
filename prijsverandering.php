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
		$product_pid=1;
		if(isset($_GET["product"])){
			$product_pid=$_GET["product"];
		}
		
		$queryResult2 = getQuery(
			"SELECT *
			FROM prijzen
			WHERE productid=" . $product_pid . ";"
		);
		
	?>
				
	<script type="text/javascript" src="amcharts/amcharts.js"></script>
	<script type="text/javascript" src="amcharts/serial.js"></script>
	
	<!-- amCharts javascript code -->
	<script type="text/javascript">
		AmCharts.makeChart("chartdiv",
			{
				"type": "serial",
				"categoryField": "Datum",
				"dataDateFormat": "YYYY-MM-DD",
				"categoryAxis": {
					"parseDates": true,
					"axisAlpha": 0,
					"minHorzintalGap": 55
				},
				"chartCursor": {
					"enabled": true
				},
				"trendLines": [],
				"graphs": [
					{
						"bullet": "round",
						"id": "AmGraph-1",
						"title": "Inkoopprijs",
						"valueField": "Inkooppijs"
					},
					{
						"bullet": "Verkoopprijs",
						"id": "AmGraph-2",
						"title": "Verkoopprijs",
						"valueField": "Verkoopprijs"
					}
				],
				"guides": [],
				"valueAxes": [
					{
						"id": "ValueAxis-1",
						"title": "Prijs"
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
						"text": "<?php echo "Prijsverandering van" . $product_pid; ?>"
					}
				],
				"dataProvider": [
					<?php while($row2 = $queryResult2->fetch_assoc()): ?>
					{
						"Datum": "<?php echo $row2['datum'];?>",
						"Inkoopprijs": <?php echo $row2['inkoopprijs'];?>,
						"Verkoopprijs": <?php echo $row2['verkoopprijs'];?>
					},
					<?php endwhile;?>
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
				"SELECT productid, naam
				FROM product
				GROUP BY productid"
			);
			
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->		
		<table id='resultTable'>
			<thead>
				<tr>
					<td>ProductID</td>
					<td>Naam</td>
					<td>Select</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<?php $productProductid=$row1['productid'];  ?>
					<td><?php echo $productProductid; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td>
						<form action="prijsverandering.php">
							<input type="submit" value="<?php echo $productProductid; ?>" name="product">
						</form>
					</td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
		
	</div>
</body>
</html>
