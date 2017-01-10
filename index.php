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
		<h1> Welkom bij het Timaflu systeem!</h1>
		<p> Gebruik het menu rechts om naar de gewenste pagina te navigeren</p>
	</div>
</body>
</html>
