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
				"SELECT klantid, naam
				FROM klant"
			);
			
		?>
		
		<!-- maak er een table van -->
		<!--<input type="text" id="searchInput" onkeyup="searchFunction1()" placeholder="Typ de naam...">-->		
		<table id='resultTable'>
			<thead>
				<tr>
					<td>KlantID</td>
					<td>Naam</td>
					<td>Select</td>
				</tr>
			</thead>
			<tbody>
				<?php   while($row1 = $queryResult1->fetch_assoc()): ?>
				<tr>
					<?php $klantKlantID=$row1['klantid'];  ?>
					<td><?php echo $klantKlantID; ?></td>
					<td><?php echo $row1['naam']; ?></td>
					<td>
						<form action="orderaanmaken.php">
							<input type="submit" value="<?php echo $klantKlantID; ?>" name="klant">
						</form>
					</td>
				</tr>
				<?php endwhile;?>
			</tbody>
		</table>
		
	</div>
</body>
</html>
