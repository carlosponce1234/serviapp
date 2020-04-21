<?php 
	include '../head y footer/head.php';
 ?>
	
	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Agregar Cliente</h1>
            <a href="verclientes.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Ver Todos Los clientes</a>
          </div>

          <form action="" method="Post" id="addclienteform">
          	<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DATOS DE CLIENTES</h6>
            </div>
            <br>
            <fieldset>
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="nombre">Nombre completo del cliente</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre cliente" required>
                </div>
                <div class="form-group col-md-5">
                  <label for="ruc">N° RUC cliente</label>
                  <input type="text" class="form-control" id="ruc" name="ruc" placeholder="RUC...">
                  <small>Este campo es opcional y se puede cambiar para cada pre-factura</small>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label for="tel"># de contacto telefonico</label>
                  <input type="text" class="form-control" id="tel" name="tel" placeholder="2233-2521 / 3322-5514">
                  <small>Este campo es opcional y se puede cambiar para cada pre-factura</small>
                </div>
                <div class="form-group col-md-5">
                  <label for="dir">Direccion cliente</label>
                  <textarea name="dir" id="dir" class="form-control"></textarea>
                  <small>Esta no necesariamente sera la direccion de entrega de los servicios</small>
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
                   <button id="guardar" class="btn btn-primary" type="submit">Guardar y Crear Cliente</button>
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
        var ruc = $('#ruc').val().trim();
        var tel = $('#tel').val().trim();
        var dir = $('#dir').val().trim();
      /*  console.log('nomb '+nombre);
        console.log('ali '+alias);
        console.log('corr '+correo);
        console.log('pass '+contraseña);
        console.log('tip '+tipo);
        console.log('suc '+suc);*/
        if (nombre.length == 0) {
          alert('El formulario posee errores,  debe ingresar un nombre de cliente');  
        }else{
          var operacion = 'nuevo';
          //console.log('-------------------------'); 
        $.ajax({
            url : '../../modelos/clientes.php',
            type : 'POST',
            data : {
              nombre : nombre,
              ruc : ruc,
              tel : tel,
              dir : dir,
              operacion : operacion,
            },
            success:function(data){
            alert(data);
            $('#addclienteform').trigger("reset");
          }
          });
        }; 
        //console.log('se previno el default');
      });
   });
 </script>