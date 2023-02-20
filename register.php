<!DOCTYPE html>
<html>
<head>
	<title></title>
	<title></title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<form method="POST" action="">
	
	Usuario: <br>
	<input type="text" name="user"> <br>
	Clave: <br>
	<input type="password" name="pass"> <br>
	Correo: <br>
	<input type="email" name="corr"> <br>
	<input type="submit" name="reg" value="Registrarse">
	<?php echo "<a href='principal.html'>Volver al inicio</a>";?>
</form>

<?php

if (isset($_POST['reg'])) {

	require ("config/config.php");

	$user=$_POST['user'];
	$pass=md5($_POST['pass']);
	$corr=$_POST['corr'];

	$consultar = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$user'");
	$contar = $consultar->num_rows;

	if ($contar > 0) {
		echo "Usuario ya utilizado, Vuelve registrarte nuevamente";
	}

	else{
		$insertar=$conexion->query("INSERT INTO usuarios(usuario,clave,correo) VALUES ('$user','$pass','$corr')");

		if ($insertar) {
			echo "Te has registrado";
			echo "<a href='login.php'>Iniciar sesion</a>";
		}
	}

	

}

?>
</body>
</html>