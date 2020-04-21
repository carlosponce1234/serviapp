<?php 
	include '../head y footer/head.php';

	if ($_SESSION['tipo_usuario'] != 1) {
        header("Location: ../home.php");
};
 ?>
	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agregar Servicios</h1>
            <a href="verservicios.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Ver Todos Los servicios</a>
          </div>
		<form action="" method="POST" id="serviciosform">
			<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Datos de Servicio</h6>
            </div>
            <br>
            <fieldset>
            	<div class="form-row">
                <div class="form-group  col-md-5">
                  <label for="nombre">Servicio</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Servicio" required>
                </div>
                <div class="form-group col-md-5">
                  <label for="precio">precio Servicio</label>
                  <div class="input-group">
                  	<div class="input-group-prepend">
   					 <span class="input-group-text">$</span>
 					 </div>
                  <input type="number" class="form-control" id="precio" name="precio" placeholder="10.50" required>
                  </div>
                </div>
              </div>
            </fieldset>
            <fieldset>
            	<div class="form-row">
            		<div class="form-group col-md-10">
            			<label for="des">Descripcion Servicio</label>
            			<textarea name="des" id="des" class="form-control"></textarea>
            		</div>
            	</div>
            </fieldset>
            <fieldset>
              <div class="form-row">
                <div class="form-group col-md-2">
                  <br>
                    <button id="limpiar" class="btn btn-warning" type="reset">Limpiar Formulario</button>
                </div>
                <div class="form-group col-auto">
                   <br>
                   <button id="guardar" class="btn btn-primary" type="submit">Guardar Servicio</button>
                </div>
              </div>
            </fieldset>
		</form>



  <?php 
 	include '../head y footer/footer.php';
  ?>
  <script>
  	$(document).ready(function(){

  		$(document).on('click', '#guardar' , function(event){
  		event.preventDefault(); 
        var nombre = $('#nombre').val().trim();
        var precio = $('#precio').val().trim();
        var des = $('#des').val().trim();
        if ($.isNumeric(precio)) {
        	if (precio >= 0) {
        		if (nombre.length == 0) {
        			alert('El formulario posee errores,  debe ingresar un nombre de cliente');  
        		}else{
        			var operacion = 'nuevo';
        			$.ajax({
            			url : '../../modelos/servicios.php',
           				type : 'POST',
            			data : {
              					nombre : nombre,
              					precio : precio,
              					des : des,
              					operacion : operacion,
            					},
            			success:function(data){
            				alert(data);
            				$('#serviciosform').trigger("reset");
          				}
          			});
        		}
        	}else{
        		alert('El precio debe ser un valor numerico positivo ó 0');
        	}
        }else{
        	alert('El precio debe ser un valor numerico positivo ó 0');
        }
  		});
  	})
  </script>