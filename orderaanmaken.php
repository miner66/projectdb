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
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript" src="js/jquery-2.2.4.js"></script>
	<script type="text/javascript" src="js/datatables.js"></script>
	<script src='js/search.js'></script>
	<script>
		$(document).ready( function () {
			$('#resultTable').DataTable({
				paging: false,
				scrollY: 400
			});
		} );
	</script>
	<?php
		//vul de query in
		$klant=1;
		if(isset($_GET["klant"])){
			$klant=$_GET["klant"];
		}
		
		$queryResult2 = getQuery(
			"SELECT
				CASE
					WHEN jaaromzet.jaaromzet < 10000 THEN '5'
					WHEN jaaromzet.jaaromzet >= 10000 AND jaaromzet.jaaromzet<20000 THEN '10'
					WHEN jaaromzet.jaaromzet >= 20000 THEN '15'
					ELSE '0'
				END AS percentage
			FROM jaaromzet
			RIGHT JOIN klant ON klant.klantid=jaaromzet.klantid
			WHERE klant.klantid=" . $klant . ";"
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
					"SELECT product.bestelcode, product.naam, product.aantalperverpakking, product.minimaalaantal, prijs.prijs
					FROM product
					INNER JOIN
						(SELECT verkoopprijs.*
						FROM verkoopprijs
						INNER JOIN
							(SELECT productid, MAX(datum) AS MaxDateTime
							FROM verkoopprijs
							GROUP BY productid) AS tijd 
						ON verkoopprijs.productid= tijd.productid
						AND verkoopprijs.datum = tijd.MaxDateTime) AS prijs
					ON product.productid=prijs.productid
					WHERE inverkoop=1;"
			);
		?>
		
		<!-- maak er een table van -->
		<table id='resultTable'>
			<thead>
				<tr>
					<th>Bestelcode</th>
					<th>Naam product</th>
					<th>Aantal per verpakking</th>
					<th>Minimale hoeveelheid</th>
					<th>Hoeveelheid</th>
					<th>Prijs</th>
					<th>Totaalprijs</th>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><span name='bestelCode'><?php echo $row1['bestelcode']; ?></span></td>
					<td><span name='prodNaam'><?php echo $row1['naam']; ?></span></td>
					<td><?php echo $row1['aantalperverpakking']; ?></td>
					<td><span name='minNum'><?php echo $row1['minimaalaantal']; ?></span></td>
					<td><input name="numArtikel" type="number" maxlength="3" class="amountField" placeholder='0' value='0' onkeyup="doCalc()"></td>
					<td><span>&euro;</span><span name='linePrice'><?php echo $row1['prijs']; ?></span></td>
					<td><span>&euro;</span><span name='lineCost'>0.00</span></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
				
		<hr>
		
		<table id= 'outcomeTable'>
			<thead>
				<tr>
					<th>Bestelcode</th>
					<th>Naam</th>
					<th>Hoeveelheid</th>
					<th>Totaalprijs</th>
				</tr>
			</thead>
			<tbody id="orderLines">
				
			</tbody>
		</table>
		
		<hr>
		<div><span>&euro;</span><span id='costWithout'>0.00</span></div>
		<?php 
			$percentage = mysqli_fetch_assoc($queryResult2);
			$percentage = $percentage['percentage'];
		?>
		<div><span id='percentage'><?php echo $percentage; ?></span><span>%</span></div>
		<hr id='calculationBar'>
		<div><span>&euro;</span><span id='costWith'>0.00</span></div>
	</div>
</body>
</html>
