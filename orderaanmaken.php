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
		if(isset($_GET["klant"])){
			$product_pid=$_GET["klant"];
		}
		
		$queryResult2 = getQuery(
			"SELECT klant.klantid, klant.naam, 
				CASE
					WHEN jaaromzet.jaaromzet IS NULL THEN '0'
					ELSE jaaromzet
				END AS 'jaaromzet'
				,
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
					"SELECT klant.klantid, klant.naam, 
						CASE
							WHEN jaaromzet.jaaromzet IS NULL THEN '0'
							ELSE jaaromzet
						END AS 'jaaromzet'
						,
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
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['klantid']; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['jaaromzet']; ?></td>
					<td><?php echo $row1['percentage']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		<hr>
		<div id="chartdiv" style="width:100%; height:400px;"></div>
	</div>
</body>
</html>