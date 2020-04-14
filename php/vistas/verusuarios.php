<?php 
include 'head.php';
	if ($_SESSION['tipo_usuario'] != 1) {
  header("Location: ../../home.php");
};
$sql = "SELECT * FROM usuarios  u INNER JOIN tipos_usuarios t ON  u.cod_tipo = t.id_tipo ";
$result=$mysqli->query($sql);
$rows = $result->num_rows;
$row = $result->fetch_assoc(); 		
 ?>
<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
          </div>
          <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado Usuarios registrados</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="usuarios" >
                  <thead>
                    <tr>
                      <th>Nombre Y apellido</th>
                      <th>Alias</th>
                      <th>Correo</th>
                      <th>Tipo usuario</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		if ($rows > 0) {
                  			foreach ($result as $key => $value) {
                  			echo "<tr id=".$value['id_user'].">
                      <td class='nombre'>".$value['n_usuario']."</td>
                      <td class='nombre'>".$value['alias_usuario']."</td>
                      <td class='nombre'>".$value['correo']."</td>
                      <td class='nombre'>".$value['n_tipo']."</td>";
                      if ($value['estado_usuario']>0) {
                      	echo "<td class=''>
                        <i class='fas fa-info' data-toggle='tooltip' data-placement='top' title='Usuario Desahabilitado'></i>
                      </td>";
                      }else{
                      	echo "<td class=''>
                        <i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='Usuario Habilitado'></i>
                    </td>";
                      };
                      echo "
                      <td><button class='btn btn-primary btn-circle' id='user_edit' data-toggle='tooltip' data-placement='top' title='Editar'>
                        <i class='fas fa-pen-fancy'></i>
                      </button>";
                      if ($value['estado_usuario']>0) {
                     	 echo "
                      <button class='btn btn-success btn-circle' id='user_info' data-toggle='tooltip' data-placement='top' title='Habilitar'>
                        <i class='fas fa-info'></i>
                      </button>
                      </td>
                    </tr>";
                      }else{
                      	 echo "
                      <button class='btn btn-danger btn-circle' id='user_eliminar' data-toggle='tooltip' data-placement='top' title='Deshabilitar'>
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
 <?php 
 include 'footer.php';

  ?>
  <script>
  	$(document).ready(function() {
  		var table1 = $('#usuarios').DataTable({
        "pagingType": "full_numbers"
    }); 

  	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
	$(document).on('click' , '#user_edit' , function(event){
		var cell = $(this).parent();
      	var fila = cell.parent();
      	var idFila = fila.attr('id');
      	var url = 'edit_user.php?id_user='+idFila+'';
      	window.location.assign(url);
	});
	$(document).on('click', '#user_eliminar', function(event){
	var cell = $(this).parent();
    var fila = cell.parent();
    var idFila = fila.attr('id');
    var operacion = 'eliminar';
    console.log (cell);
      	console.log (fila);
      	console.log(idFila);
    var r = confirm('Seguro desea dehabilitar este Usuario?');
    if (r == true) { 
    $.ajax({
    	url: '../modelos/usuarios.php',
		type: 'POST',
		data:{
			id_usuario : idFila,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		}
    });
      };
});   
$(document).on('click', '#user_info', function(event){
	var cell = $(this).parent();
    var fila = cell.parent();
    var idFila = fila.attr('id');
    var operacion = 'activar';
    console.log (cell);
      	console.log (fila);
      	console.log(idFila);
    var r = confirm('Seguro desea Habilitar este Usuario?');
    if (r == true) { 
    $.ajax({
    	url: '../modelos/usuarios.php',
		type: 'POST',
		data:{
			id_usuario : idFila,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		}
    });
      };
});        
  	});
  </script>