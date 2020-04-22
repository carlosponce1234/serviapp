<?php 
include '../head y footer/head.php';
if ($_SESSION['tipo_usuario'] != 1 && $_SESSION['tipo_usuario'] != 4 ) {
  header("Location: ../home.php");
};
$sql = "SELECT * FROM conductores left JOIN flota_vehicular ON cod_vehiculo = id_vehiculo";
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
                      <th>Conductor</th>
                      <th>cat. licencia</th>
                      <th>Vehiculo asignado</th>
                      <th>Activo?</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		if ($rows > 0) {
                  			foreach ($result as $key => $value) {
                  				echo "<tr id=".$value['id_conductor'].">
                      			<td class='nombre'>".$value['n_conductor']."</td>
                      			<td class='nombre'>".$value['cat_lic']."</td>";
                      		if (!is_null($value['n_vehiculo'])) {
                      			echo "<td class='nombre'>".$value['n_vehiculo']."</td>";
                      		}else{
                      			echo "<td class=''>
                        		<i class='fas fa-ban' data-toggle='tooltip' data-placement='top' title='Sin vehiculo asignado'></i>
                      			</td>";
                      		};	
                      		if ($value['estado_conductor']>0){
                      			echo "<td class=''>
                        		<i class='fas fa-ban' data-toggle='tooltip' data-placement='top' title='conductor Desahabilitado'></i>
                      			</td>";
                      		}else{
                      			echo "<td class=''>
                        		<i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='conductor Habilitado'></i>
                    			</td>";
                      		};
                      		echo "<td><button class='btn btn-primary btn-circle' id='edit_con' data-toggle='tooltip' data-placement='top' title='Editar'><i class='fas fa-pen-fancy'></i></button>";
                      		if (is_null($value['n_vehiculo'])) {
                      			echo "<button class='btn btn-warning btn-circle' id='cond_vehiculo' data-toggle='tooltip' data-placement='top' title='Habilitar'><i class='fas fa-truck'></i></button>";
                      		}
                      		if ($value['estado_conductor']>0) {
                     	 		echo "<button class='btn btn-success btn-circle' id='cond_hab' data-toggle='tooltip' data-placement='top' title='Habilitar'><i class='fas fa-check'></i></button></td></tr>";
                      		}else{ 
                      			echo "<button class='btn btn-danger btn-circle' id='cond_elim' data-toggle='tooltip' data-placement='top' title='Deshabilitar'><i class='fas fa-ban'></i></button></td></tr>";
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
  	function prueba_notificacion() {
		if (Notification) {
			if (Notification.permission !== "granted") {
				Notification.requestPermission()
			}
		var title = "Xitrus"
		var extra = {
			icon: "http://xitrus.es/imgs/logo_claro.png",
			body: "Notificación de prueba en Xitrus"
		}
		var noti = new Notification( title, extra)
			noti.onclick = {
				// Al hacer click
			}
			noti.onclose = {	
			// Al cerrar
			}
		setTimeout( function() { noti.close() }, 10000)
		}
	};

$(document).ready(function(){
	//prueba_notificacion();
	var table1 = $('#servicios').DataTable(); 

  	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
})	
  </script>