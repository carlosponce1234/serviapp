<?php 
include '../conf/concxion.php';

if (!isset($_POST['operacion'])) {
	# code...
	echo "ERROR : operacion no definida";
};

switch ($_POST['operacion']) {
	case 'nuevo':
	$nombre = $_POST['nombre'];
	$alias = $_POST['alias'];
	$correo = $_POST['correo'];
	$contraseña = $_POST['contraseña'];
	$tipo = $_POST['tipo'];

	if (strlen($nombre)>0 || strlen($alias) >0 || strlen($correo) > 0 || strlen($contraseña) > 0) {
		if (filter_var($correo, FILTER_VALIDATE_EMAIL) === FALSE) {

			echo "ERROR:  ingresar una direccion de correo valida";
			# code...
			break;
		}
		$sql = "INSERT INTO usuarios (id_user , n_usuario , alias_usuario , correo , pass_usuario , cod_tipo , fecha , estado_usuario)
		VALUES (Null , '$nombre' , '$alias' , '$correo' , '$contraseña' , '$tipo' , CURRENT_TIMESTAMP , 0)";
		if($mysqli->query($sql) === true){
    				echo "Usuario creado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}



	}else {echo "ERROR: NO SE ENVIO NINGUN DATO AL SERVIDOR";}
		# code...
		break;
	
	default:
		# code...
		break;
}

 ?>