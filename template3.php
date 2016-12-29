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
	<script src="amcharts/amcharts.js" type="text/javascript"></script>
	<script src="amcharts/pie.js" type="text/javascript"></script>
	<?php
		if(isset($_POST["medicijnnaam"])){
				$mednaam=$_POST["medicijnnaam"];
			}else{
				$mednaam='Concerta';
			}
	?>
	
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
			$queryResult1 = getQuery(
					"SELECT product.productid, product.naam, inkoopprijs.prijs, inkoopprijs.datum
					FROM product
					JOIN inkoopprijs ON inkoopprijs.productid=product.productid
					WHERE product.naam='" . $mednaam . "'
					ORDER BY product.productid, inkoopprijs.datum;"
			);
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->
		<table id='resultTable'>
			<thead>
				<tr>
					<td>Product ID</td>
					<td>Naam</td>
					<td>Prijs</td>
					<td>Datum</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row1['productid']; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td><?php echo $row1['prijs']; ?></td>
					<td><?php echo $row1['datum']; ?></td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>

	</div>
</body>
</html>