<?php 
	include 'head.php';
	if ($_SESSION['tipo_usuario'] != 1) {
  header("Location: ../../home.php");};
$sql2 = "SELECT * FROM sucursales WHERE estado_sucursal = 0";
$result2=$mysqli->query($sql2);
$rows2= $result2->num_rows;
$row2 = $result2->fetch_assoc(); 


 ?>
	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Usuarios x Sucursal</h1>
            <div class="form-group col-md-4">
            	<select name="suc-user" id="suc-user" class="d-none d-sm-inline-block form-control shadow-sm">
            	<option value="0" disabled selected>Seleccionar Sucursal...</option>
            	<?php 
            		foreach ($result2 as $k => $suc) {
            			echo "<option value=".$suc['id_sucursal'].">".$suc['n_sucursal']."</option>";
            		}
            	 ?>
            </select>
            </div>
          </div>

	<div class="container-fluid">
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Usuarios registrados</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="usuarios" width="100%" cellspacing="0" >
                  <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>sucursal</th>
                      <th>Asignado?</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                  		   $sql = "SELECT * FROM usuarios u LEFT JOIN usuarioxsucursal q ON u.id_user = q.cod_user LEFT JOIN sucursales s ON s.id_sucursal = q.cod_suc ";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $row = $result->fetch_assoc();

    if ($rows > 0) {
    foreach ($result as $key => $value) {
      $sql2 = "SELECT count(id_usxsuc) as num ";

      if ($value['cod_suc'] == 1) {
        echo "<tr user=".$value['id_user']." id=".$value['id_usxsuc'].">
   <td class='nombre'>".$value['n_usuario']."</td>  
   <td class='nombre'>".$value['n_sucursal']."</td>";
   if ($value['asignado']>0) {
    echo "<td class=''>
     <i class='fas fa-ban' data-toggle='tooltip' data-placement='top' title='Usuario Desahabilitado'></i>
   </td>";
   }else{
    echo "<td class=''>
     <i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='Usuario Habilitado'></i>
 </td>";
   };
   echo "<td>";
   if ($value['asignado']>0) {
     echo "
   <button class='btn btn-success ' id='habilitar' data-toggle='tooltip' data-placement='top' title='Habilitar'>
     <i class='fas fa-check'></i> Asignar
   </button>
   </td>
 </tr>";
   }else{
     echo "
   <button class='btn btn-danger ' id='deshabilitar' data-toggle='tooltip' data-placement='top' title='Deshabilitar'>
     <i class='fas fa-ban'></i> Retirar
   </button>
   </td>
 </tr>";
      };
    }
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
$(document).ready(function(){

  	var table1 = $('#usuarios').DataTable({
        "pagingType": "full_numbers",
    }); 
  	$(document).on('change' , '#suc-user' , function(event){
  		$('#usuarios tbody').html('');
  		var suc = $(this).val();
  		/*console.log(suc);
  		console.log('----');
		*/
		var operacion = 'consulta';
		$.ajax({
			url: '../modelos/userxsucursal.php',
			type: 'POST',
			data: {
				suc : suc,
				operacion: operacion
			},
			success:function(data){
				$('#usuarios tbody').html(data);
			}
		});
  	});
  	$(document).on('click' , '#habilitar' , function(event){
  		//alert('click en abilitar');
  		var suc = $('#suc-user').val();
  		var operacion = 'asignar';
  		var cell = $(this).parent();
  		var fila = cell.parent();
  		var user = fila.attr('user')
  		//alert(user);
  		$.ajax({
  			url:'../modelos/userxsucursal.php',
  			type: 'POST',
  			data:{
  				suc : suc,
  				operacion : operacion,
  				user : user
  			},
  			success: function(data){
  				//alert(data);
  				var operacion = 'consulta';
				$.ajax({
					url: '../modelos/userxsucursal.php',
					type: 'POST',
				data: {
					suc : suc,
					operacion: operacion
				},
				success:function(data){
					$('#usuarios tbody').html(data);
				}
			});

  			}
  		});
  	});
  	$(document).on('click' , '#deshabilitar' , function(event){
  		//alert('click en deshabilitar');
  		//alert('click en abilitar');
  		var suc = $('#suc-user').val();
  		var operacion = 'retirar';
  		var cell = $(this).parent();
  		var fila = cell.parent();
  		var user = fila.attr('user')
  		//alert(user);
  		$.ajax({
  			url:'../modelos/userxsucursal.php',
  			type: 'POST',
  			data:{
  				suc : suc,
  				operacion : operacion,
  				user : user
  			},
  			success: function(data){
  				//alert(data);
  				var operacion = 'consulta';
				$.ajax({
					url: '../modelos/userxsucursal.php',
					type: 'POST',
				data: {
					suc : suc,
					operacion: operacion
				},
				success:function(data){
					$('#usuarios tbody').html(data);
				}
			});

  			}
  		});
  	});		
 });
  </script>