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
					"SELECT naam, orderklant.orderid, factuur.`status`, factuur.datumlaatsteactie, telefoonklant.telefoonnr
					FROM orderklant
					JOIN factuur ON factuur.orderid=orderklant.orderid
					JOIN klant ON klant.klantid=orderklant.klantid
					JOIN telefoonklant ON telefoonklant.klantid=klant.klantid
					WHERE orderklant.status='afgehandeld'
					AND factuur.status<>'betaald'
					AND factuur.status<>'incassobureau ingeschakeld'
					AND DATEDIFF(NOW(),factuur.datumlaatsteactie)>=7
					GROUP BY klant.klantid,orderklant.orderid
					ORDER BY naam;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Naam klant</td>
					<td>Order ID</td>
					<td>status factuur</td>
					<td>Datum laatste actie</td>
					<td>Telefoonnummer</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['orderid']; ?></td>
					<td><?php echo $row1['status']; ?></td>
					<td><?php echo $row1['datumlaatsteactie']; ?></td>
					<td><?php echo $row1['telefoonnr']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width:100%; height:400px;"></div>
	</div>
</body>
</html>