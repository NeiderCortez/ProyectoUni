<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>index</title>
</head>
<body>

<?php
if (isset($_SESSION['usuario'])) {
	echo "<a href='logout.php'>Cerrar sesion</a>";
}

else{

	echo "<a href='principal.html'>Debes loguearte</a> o <a href='register.php'>Registrate</a>";

}
?>

</body>
</html>