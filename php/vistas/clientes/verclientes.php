<?php 
include '../head y footer/head.php';
if ($tipo_user === 3) {
echo "<script>alert(' No tienes permisos para modificar clientes.'); var url = '../../index.php';window.location.assign(url);</script>";
};
$sql = "SELECT * FROM clientes";
$result = $mysqli->query($sql);
$rows = $result->num_rows;
$row = $result->fetch_assoc();
 ?>
<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
          </div>
          <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado Clientes registrados</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="clientes" >
                  <thead>
                    <tr>
                      <th>Nombre Cliente</th>
                      <th>N° RUC</th>
                      <th>Telefono</th>
                      <th>Direccion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		if ($rows > 0) {
                  			foreach ($result as $key => $value) {
                  				echo "<tr id=".$value['id_cliente'].">
                      					<td class='nombre'>".$value['n_cliente']."</td>
                      					<td class='nombre'>".$value['ruc_cliente']."</td>
                      					<td class='nombre'>".$value['tel_cliente']."</td>
                      					<td class='nombre'>".$value['dir_cliente']."</td>
                      					<td><button class='btn btn-primary btn-circle' id='cliente_edit' data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-pen-fancy'></i></button></td>
                      				</tr>";
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
 	include '../head y footer/footer.php';
  ?>
  <script>
  	$(document).ready(function(){
  		var table1 = $('#clientes').DataTable({}); 
  	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
	$(document).on('click' , '#cliente_edit' , function(event){
		var cell = $(this).parent();
      	var fila = cell.parent();
      	var idFila = fila.attr('id');
      	var url = 'edit_cliente.php?id_cliente='+idFila+'';
      	window.location.assign(url);
	});
  	})
  </script>