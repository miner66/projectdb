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
	</div>
</body>
</html>