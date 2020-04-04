<?php 

require 'php/conf/concxion.php';

session_start();

if (isset($_SESSION["id_usuario"])) {
	header("location: php/vistas/home.php");
}
$error = '';
if(!empty($_POST))
	{
		$usuario = mysqli_real_escape_string($mysqli,$_POST['n_usuario']);
		$password = mysqli_real_escape_string($mysqli,$_POST['pass_usuario']);
		
		
		//$sha1_pass = sha1($password);
		
		$sql =  "SELECT * FROM `usuarios` WHERE `n_usuario`= '$usuario' OR alias_usuario = '$usuario' AND `pass_usuario`= '$password' And estado_usuario = 0 ";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['id_usuario'] = $row['user_id'];
			$_SESSION['tipo_usuario'] = $row['tipo_usuario'];
			$_SESSION['n_usuario'] = $row['n_usuario'];
			
			header("location: php/vistas/home.php");
			} else {
			$error = '<div class="card mb-4 py-3 border-bottom-danger">
                <div class="card-body">
                  El nombre o contraseña son incorrectos o el usuario se encuentra deshabilitado.
                </div>
              </div>';
		}
	}

 ?>
 <!DOCTYPE html>
<html lang="eS">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Serviapp - Login</title>

  <!-- Custom fonts for this template-->
  <link href="PLANTILLA/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="PLANTILLA/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
           <!--   <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido-Serviapp</h1>
                  </div>
                  <form class="user" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="n_usuarios" aria-describedby="emailHelp" placeholder="Nombre de usuario o alias." name="n_usuario">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="pass_usuario" placeholder="Contraseña" name="pass_usuario">
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="php/vistas/recuperarpass.php">olvide mi contraseña</a>
                  </div>
                  <?php echo $error; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="PLANTILLA/vendor/jquery/jquery.min.js"></script>
  <script src="PLANTILLA/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="PLANTILLA/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="PLANTILLA/js/sb-admin-2.min.js"></script>

</body>

</html>
