<?php 
include '../head y footer/head.php';
if ($_SESSION['tipo_usuario'] != 1 && $_SESSION['tipo_usuario'] != 4 ) {
  header("Location: ../home.php");
};
  $id_cond = $_GET['id_cond'];
  $sql = "SELECT * FROM conductores left JOIN flota_vehicular ON cod_vehiculo = id_vehiculo WHERE id_conductor = '$id_cond'";
$result = $mysqli->query($sql);
$rows = $result->num_rows;
$row = $result->fetch_assoc();

$flota = "SELECT * FROM flota_vehicular";
$vehiculos = $mysqli->query($flota);
$vehiculo = $vehiculos->fetch_assoc();
 ?>
<div class="container-fluid">
<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Editar Usuario</h1>
		<a href="verusuarios.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Ver Todos Los usuarios</a>
	</div>
<form action="" method="POST" id="edit_conductor">
	<div class="card-heade py-3">
		<h4 class="identificador m-0 font-weight-bold text-primary">Conductor : <?php echo $row['n_conductor']; ?></h4>
	</div>
	<br>
	<fieldset>
		<div class="form-row">
			<div class="form-group col-md-5">
				<label for="Nombre">Nombre completo del usuario</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellidos" required value="<?php echo $row['n_conductor']; ?>" conductor="<?php echo $row['id_conductor']; ?>"  >
			</div>
			<div class="form-group col-md-5">
				<label for="cat">Categoria de licencia</label>
				<input type="text" class="form-control" id="cat" name="cat" required value="<?php echo $row['cat_lic']; ?>">
			</div>
		</div>
	</fieldset>
	<fieldset>
		<div class="form-row">
			<div class="form-group col-md-5">
				<label for="vehiculo">Vehiculo Asignado</label>
				<select name="vehiculo" id="vehiculo" class="form-control">
					<?php if (!is_null($row['cod_vehiculo'])): ?>
						<option value="<?php echo $row['cod_vehiculo']; ?>"><?php echo $row['n_vehiculo']; ?></option>
					<?php endif ?>
					<?php if (is_null($row['cod_vehiculo'])): ?>
						<option value="0" selected disabled>Asigna un vehiculo..</option>
						<?php foreach ($vehiculos as $k => $v): ?>	
							<?php
								$id = $v['id_vehiculo'] ;
								$tt = "SELECT * FROM conductores WHERE cod_vehiculo = $id";
							 	$res = $mysqli->query($tt);
							  	$con = $res->fetch_assoc();
							   	$cont = $res->num_rows;
							 ?>
							 <?php echo $cont; ?>
							<?php if ($cont == 0): ?>
								<option value="<?php echo $v['id_vehiculo']; ?>"> <?php echo $v['n_vehiculo'];?></option>
							<?php endif ?>
						<?php endforeach ?>
					<?php endif ?>
				</select>
			</div>
			<div class="form-group col-md-2">
				<br>
				<br>
				<button id="limpiar" class="btn btn-warning" type="reset">Limpiar Formulario</button>
			</div>
			<div class="form-group col-auto">
				<br>
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
$(document).ready(function(){
	
	$(document).on('click' , '#guardar' , function(event){
		var nombre = $('#nombre').val();
		var cat = $('#cat').val();
		var vehiculo = $('#vehiculo').val();
		var id = $('#nombre').attr('conductor');
		var operacion = 'edit';
		$.ajax({
			url : '../../modelos/conductores.php',
			type : 'POST',
			data : {
				nombre : nombre,
				cat : cat,
				vehiculo : vehiculo,
				operacion : operacion,
				id : id,
			}
			success:function(data){
				alert(data);
				var url = 'conductores.php';
				window.location.assign(url);
			}
		});
	});
 })
</script>