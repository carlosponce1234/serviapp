<?php 
include '../head y footer/head.php';
if ($tipo_user === 3) {
	echo "<script>alert(' No tienes permisos para modificar clientes.'); var url = '../../index.php';window.location.assign(url);</script>";
};
$sql = "SELECT * FROM servicios";
$result = $mysqli->query($sql);
$rows = $result->num_rows;
$row = $result->fetch_assoc();
 ?>

 <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Servicios</h1>
          </div>
          <div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listado Servicios</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="servicios" >
                  <thead>
                    <tr>
                      <th>Servicios</th>
                      <th>precio</th>
                      <th>Descripcion</th>
                      <th>Activo?</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		if ($rows > 0) {
                  			foreach ($result as $key => $value) {
                  				echo "<tr id=".$value['id_servicio'].">
                      			<td class='nombre'>".$value['n_servicio']."</td>
                      			<td class='nombre'>".$value['precio_servicio']."</td>
                      			<td class='nombre'>".$value['descripcion']."</td>";
                      		if ($value['estado_servicio']>0){
                      			echo "<td class=''>
                        		<i class='fas fa-ban' data-toggle='tooltip' data-placement='top' title='servicio Desahabilitado'></i>
                      			</td>";
                      		}else{
                      			echo "<td class=''>
                        		<i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='servicio Habilitado'></i>
                    			</td>";
                      		};
                      		echo "<td><button class='btn btn-primary btn-circle' id='user_servicio' data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-pen-fancy'></i></button>";
                      		if ($value['estado_servicio']>0) {
                     	 		echo "<button class='btn btn-success btn-circle' id='serv_hab' data-toggle='tooltip' data-placement='top' title='Habilitar'><i class='fas fa-check'></i></button></td></tr>";
                      		}else{ 
                      			echo "<button class='btn btn-danger btn-circle' id='ser_elim' data-toggle='tooltip' data-placement='top' title='Deshabilitar'><i class='fas fa-ban'></i></button></td></tr>";
                      			};
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
  	$(document).ready(function() {
  		var table1 = $('#servicios').DataTable(); 

  	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
	$(document).on('click' , '#user_servicio' , function(event){
		var cell = $(this).parent();
      	var fila = cell.parent();
      	var idFila = fila.attr('id');
      	var url = 'edit_servicio.php?id_serv='+idFila+'';
      	window.location.assign(url);
	});
	$(document).on('click', '#ser_elim', function(event){
	var cell = $(this).parent();
    var fila = cell.parent();
    var idFila = fila.attr('id');
    var operacion = 'eliminar';
    //console.log (cell);
    //console.log (fila);
    //console.log(idFila);
    var r = confirm('Seguro desea deshabilitar este Usuario?');
    if (r == true) { 
    $.ajax({
    	url: '../../modelos/servicios.php',
		type: 'POST',
		data:{
			id_serv : idFila,
			operacion : operacion,
		},
		success:function(data){
			alert(data);
			window.location.reload();
		}
    });
      };
});   
$(document).on('click', '#serv_hab', function(event){
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
    	url: '../../modelos/servicios.php',
		type: 'POST',
		data:{
			id_serv : idFila,
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