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
					"SELECT product.naam AS naamProduct, SUM(magazijn.hoeveelheid) AS Hoeveelheid, fabrikant.naam AS naamFabrikant, inkoopprijs.prijs, fabrikant.telefoonnummer
					FROM inkoopprijs
					INNER JOIN
						(SELECT productid, MAX(datum) AS MaxDateTime
						FROM inkoopprijs
						GROUP BY productid) AS inkoopData
					ON  inkoopprijs.productid= inkoopData.productid
					AND inkoopprijs.datum = inkoopData.MaxDateTime
					JOIN magazijn
					ON magazijn.productid = inkoopprijs.productid
					INNER JOIN
						(SELECT productid, MAX(datumtijd) AS MaxDateTime
						FROM magazijn
						GROUP BY productid) AS magazijnData
					ON  magazijn.productid= magazijnData.productid
					AND magazijn.datumtijd = magazijnData.MaxDateTime
					JOIN product
					ON product.productid = inkoopprijs.productid
					JOIN fabrikant
					ON fabrikant.fabrikantid = product.fabrikantid
					GROUP BY product.naam
					HAVING SUM(magazijn.hoeveelheid)<10
					AND MIN(inkoopprijs.prijs) = inkoopprijs.prijs;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Naam Product</td>
					<td>Hoeveelheid</td>
					<td>Naam Fabrikant</td>
					<td>Prijs</td>
					<td>Telefoonnummer</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['naamProduct']; ?></td>
					<td><?php echo $row1['Hoeveelheid']; ?></td>
					<td><?php echo $row1['naamFabrikant']; ?></td>
					<td><?php echo $row1['prijs']; ?></td>
					<td><?php echo $row1['telefoonnummer']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
	</div>
</body>
</html>
