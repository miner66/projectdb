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
					"SELECT orderklant.orderid, klant.naam AS 'klantnaam', medewerkers.naam AS 'medewerkernaam', datumorder, `status`
					FROM orderklant
					JOIN klant ON klant.klantid=orderklant.klantid
					JOIN medewerkers ON medewerkers.medewerkerid=orderklant.medewerkerid
					WHERE orderklant.backorder IS NOT NULL
					AND DATEDIFF(DATE(NOW()),DATE(orderklant.datumorder))<183;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>OrderID</td>
					<td>Naam klant</td>
					<td>Naam medewerker</td>
					<td>Datum van order</td>
					<td>Status order</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['orderid']; ?></td>
					<td><?php echo $row1['klantnaam']; ?></td>
					<td><?php echo $row1['medewerkernaam']; ?></td>
					<td><?php echo $row1['datumorder']; ?></td>
					<td><?php echo $row1['status']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
	</div>
</body>
</html>