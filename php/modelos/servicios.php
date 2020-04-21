<?php 
include '../conf/concxion.php';
if (!isset($_POST['operacion'])) {
	echo "ERROR : operacion no definida";
};
switch ($_POST['operacion']) {
	case 'nuevo':
		$nombre = $_POST['nombre'];
			$precio = $_POST['precio'];
			$des = $_POST['des'];
			if (strlen($nombre)>0) {
				if (is_numeric($precio)) {
					$sql = "INSERT INTO servicios (id_servicio , n_servicio , precio_servicio , descripcion , estado_servicio)
					VALUES (Null , '$nombre' , '$precio' , '$des' , 0)";
					if ($mysqli->query($sql) === true) {

						echo "Servicio creado con exito.";
					}else{
   					echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
   				       }
				}else{
					echo "ERROR: VALOR DEL PRECIO NO ES NUMERICO";
				}
			}else{
				echo "ERROR: No ha escrito el nombre del servicio";
			}
		break;
	case 'activar':
		if (strlen($_POST['id_serv'])>0 ) {
			$id_usuario = $_POST['id_serv'];
			$sql = "UPDATE servicios SET estado_servicio = 0 WHERE id_servicio = $id_usuario";
			if($mysqli->query($sql) === true){
    				echo "Servicio Habilitado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};	
					# code...
					break;
	case 'eliminar':
		if (strlen($_POST['id_serv'])>0 ) {
			$id_usuario = $_POST['id_serv'];
			$sql = "UPDATE servicios SET estado_servicio = 1 WHERE id_servicio = $id_usuario";
			if($mysqli->query($sql) === true){
    				echo "Servicio deshabilitado con exito .";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};	
					# code...
					break;
	case 'editar':
		$nombre = $_POST['nombre'];
		$precio = $_POST['precio'];
		$des = $_POST['des'];
		$id = $_POST['id'];
		if (strlen($nombre)>0 || strlen($precio) >0 || strlen($des) > 0 || strlen($id) > 0) {
			$sql = "UPDATE servicios SET n_servicio = '$nombre' , precio_servicio = '$precio' , descripcion = '$des' WHERE id_servicio = '$id'" ;
				if($mysqli->query($sql) === true){
    				echo "Servicio EDITADO con exito.";
				} else{
   					echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
		}else {echo "ERROR: NO SE ENVIO NINGUN DATO AL SERVIDOR";}
		break;															
	default:
		# code...
		break;
}
 ?>