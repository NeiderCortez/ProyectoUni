<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre_apellido'])) {
           $errors[] = "nombre_apellido esta vacío";
        }else if (empty($_POST['ocupacion'])) {
           $errors[] = "ocupacion esta vacío";
        } else if (empty($_POST['correo'])) {
           $errors[] = "correo esta vacío";
        } else if (empty($_POST['telefono'])) {
           $errors[] = "telefono esta vacío";
        } else if (empty($_POST['salario'])) {
           $errors[] = "salario esta vacío";
        } else if (empty($_POST['idioma'])) {
           $errors[] = "idioma esta vacío";
        } else if (empty($_POST['ciudad'])) {
           $errors[] = "ciudad esta vacío";
        }   else if (
			!empty($_POST['nombre_apellido']) &&
			!empty($_POST['ocupacion']) &&
			!empty($_POST['correo']) &&
			!empty($_POST['telefono']) &&
			!empty($_POST['salario']) &&
			!empty($_POST['idioma']) &&
			!empty($_POST['ciudad']) 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre_apellido=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_apellido"],ENT_QUOTES)));
		$ocupacion=mysqli_real_escape_string($con,(strip_tags($_POST["ocupacion"],ENT_QUOTES)));
		$correo=mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$salario=mysqli_real_escape_string($con,(strip_tags($_POST["salario"],ENT_QUOTES)));
		$idioma=mysqli_real_escape_string($con,(strip_tags($_POST["idioma"],ENT_QUOTES)));
		$ciudad=mysqli_real_escape_string($con,(strip_tags($_POST["ciudad"],ENT_QUOTES)));
		$expectativa=mysqli_real_escape_string($con,(strip_tags($_POST["expectativa"],ENT_QUOTES)));
		$codigo_postal=mysqli_real_escape_string($con,(strip_tags($_POST["codigo_postal"],ENT_QUOTES)));
		
		$sql="UPDATE perfil SET nombre_apellido='".$nombre_apellido."', ocupacion='".$ocupacion."', correo='".$correo."', telefono='".$telefono."', salario='".$salario."', idioma='".$idioma."', ciudad='".$ciudad."', expectativa='".$expectativa."', codigo_postal='$codigo_postal' WHERE id_perfil='1'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>