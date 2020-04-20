<?php 
	include '../head y footer/head.php';

if (!isset($_GET['id_user'])) {
  header("Location: verusuarios.php");
};
$id_user = $_GET['id_user'];  
$sql = "SELECT * FROM usuarios u INNER JOIN tipos_usuarios t ON u.cod_tipo = t.id_tipo WHERE u.id_user = $id_user";
$result=$mysqli->query($sql);
$rows = $result->num_rows;
$row = $result->fetch_assoc();

 ?>

	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Editar Usuario</h1>
            <a href="verusuarios.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Ver Todos Los usuarios</a>
          </div>

        <form action="" method="Post" id="addusuarioform">
        	<div class="card-header py-3">
              <h6 class="identificador m-0 font-weight-bold text-primary" id="<?php echo $id_user; ?>">DATOS DE USUARIO: <?php echo $row['n_usuario']; ?> </h6>
            </div>
            <br>
			<fieldset>
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="Nombre">Nombre completo del usuario</label>
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellidos" required value="<?php echo $row['n_usuario']; ?>" >
						<div id="n_error" class=" border-bottom-danger"><div class="">Este campo esta vacio</div>
              </div>
					</div>
					<div class="form-group col-md-4">
						<label for="alias"> Alias de Usuario</label>
						<input type="text" class="form-control" id="alias" name="alias" placeholder="Alias.." required value="<?php echo $row['alias_usuario']; ?>">
						<small>Alias para iniciar secion, su usara para recuperar contraseña.</small>
						<div id="a_error" class=" border-bottom-danger"><div class="">Este campo esta vacio</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="correo">Correo electronico</label>
						<input type="email" class="form-control" id="correo" name="correo" placeholder="micorreo@micorreo.com" required value="<?php echo $row['correo']; ?>">
						<small>Este correo se usara para la recuperacion de contraseña y Reportes</small>
						<div id="c_error" class=" border-bottom-danger"><div class="">Este campo esta vacio</div></div>
						<div id="co_error" class=" border-bottom-danger"><div class="">Introcuce una direccion de correo valida</div></div>
					</div>
					<div class="form-group col-md-4">
						<label for="contraseña">Contraseña</label>
						<input type="password" class="form-control" id="contraseña" name="contraseña" required value="<?php echo $row['pass_usuario']; ?>">
						<div id="p_error" class=" border-bottom-danger"><div class="">Este campo esta vacio</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-row">
					<div class="form-group col-md-5">
						<label for="inputState">Tipo de usuario</label>
     					 <select id="tipo" class="form-control">
        					<option selected value="<?php echo $row['id_tipo']; ?>"> <?php echo $row['n_tipo']; ?></option>
        					<?php 
        						$sql = "SELECT * FROM tipos_usuarios";
        						$result=$mysqli->query($sql);
								$rows = $result->num_rows;
								$row = $result->fetch_assoc();

								foreach ($result as $key => $tipo) {
								 	echo "<option value=".$tipo['id_tipo'].">".$tipo['n_tipo']."</option>";
								 } 
        					 ?>
      					</select>
					</div>
					<div class="form-group col-md-2">
						<br>
						<button id="limpiar" class="btn btn-warning" type="reset">Limpiar Formulario</button>
					</div>
					<div class="form-group col-auto">
						<br>
						<button id="guardar" class="btn btn-primary" type="submit">Guardar Cambios</button>
					</div>
				</div>
			</fieldset>
        </form>  



 <?php 
 	include '../head y footer/footer.php';
  ?>

  <script>
  	$(document).ready(function() {
$('#n_error').hide();
$('#a_error').hide();
$('#c_error').hide();
$('#co_error').hide();
$('#p_error').hide();
  		
  		$(document).on('click', '#guardar' , function(event){
  			event.preventDefault(); 
  			var nombre = $('#nombre').val().trim();
  			var alias = $('#alias').val().trim();
  			var correo = $('#correo').val().trim();
  			var contraseña = $('#contraseña').val().trim();
  			var tipo = $('#tipo').val();
        var id_usuario = $('h6.identificador').attr('id');
        console.log (id_usuario);
  			/*console.log(nombre);
  			console.log(alias);
  			console.log(correo);
  			console.log(contraseña);
  			console.log(tipo);*/
  			if (nombre.length == 0) {
  				$('#n_error').show();
  			};
  			if (alias.length == 0) {
  				$('#a_error').show();
  			};
  			if (correo.length == 0) {
  				$('#c_error').show();
  			};
  			if (contraseña.length == 0) {
  				$('#p_error').show();
  			};
  			if (nombre.length == 0 || alias.length == 0 || correo.length == 0 || contraseña.length == 0 || tipo < 0 ) {
  				alert('El formulario posee errores,  no se puede procesar');	
  			}else{
  				var operacion = 'editar';
  				//console.log(operacion);	
  				$.ajax({
  					url : '../../modelos/usuarios.php',
  					type : 'POST',
  					data : {
  						nombre : nombre,
  						alias : alias,
  						correo : correo,
  						contraseña : contraseña,
  						tipo : tipo,
  						operacion : operacion,
              id_usuario : id_usuario,
  					},
  					success:function(data){
						alert(data);
						var url = 'verusuarios.php';
            window.location.assign(url);
					}
  				});
  			}; 
  			//console.log('se previno el default');
  		});

  	});
  </script>