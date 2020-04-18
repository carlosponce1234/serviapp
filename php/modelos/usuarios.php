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
			$sql2 = "SELECT @@identity as id From usuarios";
			$result2 = $mysqli->query($sql2);
			$row2 = $result2->fetch_assoc();
			$id = $row2['id'];
			$sql3 = "SELECT * FROM sucursales";
			$result3 = $mysqli->query($sql3);
			$row3 = $result3->fetch_assoc();
			  foreach ($result3 as $k => $v) {
				$suc = $v['id_sucursal'];
				$sq = "INSERT INTO usuarioxsucursal (id_usxsuc , cod_user, cod_suc , asignado) values (null , $id , $suc , 1)";
				if($mysqli->query($sq) === true){
					
				}else{echo "ERROR: No se pudo realizar la asignacion de sucursales contactar administrador. " . $mysqli->error;}
			}echo "Usuario creado con exito.";

		} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}



	}else {echo "ERROR: NO SE ENVIO NINGUN DATO AL SERVIDOR";}
		# code...
		break;

	case 'editar':
	$nombre = $_POST['nombre'];
	$alias = $_POST['alias'];
	$correo = $_POST['correo'];
	$contraseña = $_POST['contraseña'];
	$tipo = $_POST['tipo'];
	$id_usuario = $_POST['id_usuario'];

	if (strlen($nombre)>0 || strlen($alias) >0 || strlen($correo) > 0 || strlen($contraseña) > 0) {
		if (filter_var($correo, FILTER_VALIDATE_EMAIL) === FALSE) {

			echo "ERROR:  ingresar una direccion de correo valida";
			# code...
			break;
		}
		$sql = "UPDATE usuarios SET n_usuario = '$nombre' , alias_usuario = '$alias' , correo = '$correo' , pass_usuario = '$contraseña' , cod_tipo = '$tipo' , fecha = CURRENT_TIMESTAMP WHERE id_user = '$id_usuario'" ;
		if($mysqli->query($sql) === true){
    				echo "Usuario EDITADO con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}



	}else {echo "ERROR: NO SE ENVIO NINGUN DATO AL SERVIDOR";}
		# code...
		break;

		case 'eliminar':
		if (strlen($_POST['id_usuario'])>0 ) {
			$id_usuario = $_POST['id_usuario'];
			$sql = "UPDATE usuarios SET estado_usuario = 1 WHERE id_user = $id_usuario";
			if($mysqli->query($sql) === true){
    				echo "Usuario deshabilitado con exito .";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};	
					# code...
					break;	
		case 'activar':
		if (strlen($_POST['id_usuario'])>0 ) {
			$id_usuario = $_POST['id_usuario'];
			$sql = "UPDATE usuarios SET estado_usuario = 0 WHERE id_user = $id_usuario";
			if($mysqli->query($sql) === true){
    				echo "Usuario Habilitado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};	
					# code...
					break;						
	default:
		# code...
		break;
}

 ?>