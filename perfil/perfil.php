<?php
	/*-------------------------
	<!-- 
* Copyright 2018 Jhonatan cardona

//Chiphysi programación suscribete 
//V 0.1 original
//Autor: Chiphysi  Autor: Jhonatan Cardona  
//Derechos de autor(Suscribete)


-->
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_perfil="active";	
	$title="Perfil";
	
	$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
	$row=mysqli_fetch_array($query_empresa);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
<br>
	<br>

	<div class="container">
      <div class="row">
      <form method="post" id="perfil">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
   
   
          <div class="panel panel-success"><br>
              <h2 class="panel-title"><center><font size="5"><i class='glyphicon glyphicon-user'></i>PERFIL</font></center></h2>

            <div class="panel-body">
              <div class="row">
			  
                <div class="col-md-3 col-lg-3 " align="center"> 
				<div id="load_img">
					<img class="img-responsive" src="<?php echo $row['logo_url'];?>" alt="Logo">
					
				</div>
				<br>				
					<div class="row">
  						<div class="col-md-12">
							<div class="form-group">
								<input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
							</div>
						</div>
						
					</div>
				</div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-condensed">
                    <tbody>
                      <tr>
                        <td class='col-md-3'>Nombres y Apellidos:</td>
                        <td><input type="text" class="form-control input-sm" name="nombre_apellido" value="<?php echo $row['nombre_apellido']?>" required></td>
                      </tr>
                      <tr>
                        <td>Ocupación:</td>
                        <td><input type="text" class="form-control input-sm" name="ocupacion" value="<?php echo $row['ocupacion']?>" required></td>
                      </tr>
                      <tr>
                        <td>Correo electrónico:</td>
                        <td><input type="email" class="form-control input-sm" name="correo" value="<?php echo $row['correo']?>" ></td>
                      </tr>
					  <tr>
                        <td>Telefono:</td>
                        <td><input type="text" class="form-control input-sm" required name="telefono" value="<?php echo $row['telefono']?>"></td>
                      </tr>

                      <tr>
                        <td>salario que desea:</td>
                        <td><input type="text" class="form-control input-sm" required name="salario" value="<?php echo $row['salario']?>"></td>
                      </tr>

					  <tr>
                        <td>Idiomas:</td>
                        <td><input type="text" class="form-control input-sm" name="idioma" value="<?php echo $row["idioma"];?>" required></td>
                      </tr>
					  <tr>
                        <td>Ciudad:</td>
                        <td><input type="text" class="form-control input-sm" name="ciudad" value="<?php echo $row["ciudad"];?>" required></td>
                      </tr>
					  <tr>
                        <td>Codigo Postal:</td>
                        <td><input type="text" class="form-control input-sm" name="codigo_postal" value="<?php echo $row["codigo_postal"];?>"></td>
                      </tr>
					  <tr>
                        <td>Expectativas</td>
                        <td><input type="text" class="form-control input-sm" name="expectativa" value="<?php echo $row["expectativa"];?>"></td>
                      </tr>
                   
                        
                     
                    </tbody>
                  </table>
                  
                  
                </div>
				<div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
                 <div class="panel-footer text-center">
                    
                     
                <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-refresh"></i> Actualizar hoja de vida</button>

                       
                       
                    </div>
            
          </div>
        </div>
		</form>
      </div>

	
	<?php
	include("footer.php");
	?>
  </body>
</html>
<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
<script>
$( "#perfil" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_perfil.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();
})





		
</script>

<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "ajax/imagen_ajax.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>

