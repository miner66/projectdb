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
				"SELECT orderklant.orderid, GROUP_CONCAT(bakid SEPARATOR ', ') AS 'bakken', orderklant.`status`, klant.naam, klant.adres, klant.plaatsnaam, klant.postcode
				FROM orderklant
				JOIN bak ON bak.orderid=orderklant.orderid
				JOIN klant ON klant.klantid=orderklant.klantid
				WHERE orderklant.`status` IN('distributiehoek','order wordt opgehaald')
				GROUP BY klant.klantid
				ORDER BY orderklant.`status`, klant.klantid;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Order ID</td>
					<td>Bakken bij order</td>
					<td>Status order</td>
					<td>Naam klant</td>
					<td>Adres klant</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['orderid']; ?></td>
					<td><?php echo $row1['bakken']; ?></td>
					<td><?php echo $row1['status']; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['adres'] . "\n" . echo $row1['postcode'] . " " . echo $row1['plaatsnaam']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width:100%; height:400px;"></div>
	</div>
</body>
</html>