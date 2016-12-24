<!DOCTYPE html>
<html lang="nl">
<head>
	<title> B1b Schermen Timaflu </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/datatables.css"/>
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
		<?php
			include "include/functions.php"
		?>
	</header>
	<div class='content'>
		<?php
			//vul de query in
			$queryResult = getQuery(
					"SELECT klant.klantid, klant.naam, jaaromzet,
						CASE
							WHEN jaaromzet.jaaromzet < 10000 THEN '5'
							WHEN jaaromzet.jaaromzet >= 10000 AND jaaromzet.jaaromzet<20000 THEN '10'
							WHEN jaaromzet.jaaromzet >= 20000 THEN '15'
							ELSE '0'
						END AS percentage
					FROM jaaromzet
					RIGHT JOIN klant ON klant.klantid=jaaromzet.klantid;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>ID</td>
					<td>Naam</td>
					<td>Jaaromzet</td>
					<td>Korting</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row = $queryResult->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row['klantid']; ?></td>
					<td><?php echo $row['naam']; ?></td>
					<td><?php echo $row['jaaromzet']; ?></td>
					<td><?php echo $row['percentage']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		
	</div>
</body>
</html>
