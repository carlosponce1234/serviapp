<?php 
include '../head y footer/head.php';
if ($_SESSION['tipo_usuario'] != 1) {
  header("Location: ../home.php");
};

$sql = "SELECT * FROM sucursales";
$result=$mysqli->query($sql);
$rows = $result->num_rows;
$row = $result->fetch_assoc(); 
 ?>
 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sucursales</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addsucursal"><i class="fas fa-file fa-sm text-white-50"></i> Nueva Sucursal</a>
          </div>
          <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado Sucursales registradas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="sucursales" >
                  <thead>
                    <tr>
                      <th>Sucursal</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		if ($rows > 0) {
                  			foreach ($result as $key => $value) {
                  			echo "<tr id=".$value['id_sucursal'].">
                      <td class='nombre'>".$value['n_sucursal']."</td>";
                      if ($value['estado_sucursal']>0) {
                      	echo "<td class=''>
                        <i class='fas fa-info' data-toggle='tooltip' data-placement='right' title='Sucursal Desahabilitada'></i>
                      </td>";
                      }else{
                      	echo "<td class=''>
                        <i class='fas fa-check' data-toggle='tooltip' data-placement='right' title='Sucursal Habilitada'></i>
                    </td>";
                      };
                      echo "
                      <td><button class='btn btn-success btn-circle' id='suc_edit' data-toggle='tooltip' data-placement='top' title='Editar'>
                        <i class='fas fa-pen-fancy'></i>
                      </button>";
                      if ($value['estado_sucursal']>0) {
                     	 echo "
                      <button class='btn btn-warning btn-circle' id='suc_info' data-toggle='tooltip' data-placement='top' title='Habilitar'>
                        <i class='fas fa-info'></i>
                      </button>
                      </td>
                    </tr>";
                      }else{
                      	 echo "
                      <button class='btn btn-danger btn-circle' id='suc_eliminar' data-toggle='tooltip' data-placement='top' title='Deshabilitar'>
                        <i class='fas fa-trash'></i>
                      </button>
                      </td>
                    </tr>";};
                     		};
                  		};
                  	 ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="addsucursal" tabindex="-1" role="dialog" aria-labelledby="addsucursal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Añadir Sucursal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="" method="POST">
        	<div class="form-group row col-md-10">
        	<label for="sucursal"> Nombre de la sucursal</label>
        	<input id="n_sucursal" class="form-control" type="text" name="n_sucursal" placeholder="Nueva Sucursal">
        	</div>	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="guardarSucursal" type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editsucursal" tabindex="-1" role="dialog" aria-labelledby="addsucursal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">editar  Sucursal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="" method="POST">
        	<div class="form-group row col-md-10">
        	<label for="sucursal"> Nombre de la sucursal</label>
        	<input id="e_sucursal" class="form-control" type="text" name="e_sucursal" placeholder="Nueva Sucursal">
        	</div>	
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="guardarSucursal1" type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
 <?php 
 	include '../head y footer/footer.php';
  ?>


  <script>
  	 $(document).ready(function() {

      var table = $('#sucursales').DataTable();

      $(document).on('click', '#suc_edit', function(event){

      	var cell = $(this).parent();
      	var fila = cell.parent();
      	var idFila = fila.attr('id');
      	console.log (cell);
      	console.log (fila);
      	console.log(idFila);
      	var no = fila.find('.nombre');
      	var nombre = no.html();
      	console.log(nombre);
      	$('#e_sucursal').val(nombre);
      	$('#editsucursal').modal('toggle');
      	$(document).on('click', '#guardarSucursal1', function(event){
	 event.preventDefault();
	var sucursal = $('#e_sucursal').val();
	var operacion = 'edit'; 
	console.log (sucursal);
	$.ajax({
		url: '../../modelos/AddSucursal.php',
		type: 'POST',
		data:{
			id_sucursal : idFila,
			sucursal : sucursal,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		},
	});
});
      });

$(document).on('click', '#suc_eliminar', function(event){
	var cell = $(this).parent();
    var fila = cell.parent();
    var idFila = fila.attr('id');
    var operacion = 'eliminar';
    console.log (cell);
      	console.log (fila);
      	console.log(idFila);
    var r = confirm('Seguro desea dehabilitar esta Sucursal?');
    if (r == true) { 
    $.ajax({
    	url: '../../modelos/AddSucursal.php',
		type: 'POST',
		data:{
			id_sucursal : idFila,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		}
    });
      };
});      

$(document).on('click', '#suc_info', function(event){
	var cell = $(this).parent();
    var fila = cell.parent();
    var idFila = fila.attr('id');
    var operacion = 'activar';
    console.log (cell);
      	console.log (fila);
      	console.log(idFila);
    var r = confirm('Seguro desea Habilitar esta Sucursal?');
    if (r == true) { 
    $.ajax({
    	url: '../../modelos/AddSucursal.php',
		type: 'POST',
		data:{
			id_sucursal : idFila,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		}
    });
      };
});      

$(document).on('click', '#guardarSucursal', function(event){
	 event.preventDefault();
	var sucursal = $('#n_sucursal').val();
	var operacion = 'nuevo'; 
	console.log (sucursal);
	$.ajax({

		url: '../../modelos/AddSucursal.php',
		type: 'POST',
		data:{
			sucursal : sucursal,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		},
	});
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


} );
  </script>