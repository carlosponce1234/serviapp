<?php 
include '../conf/concxion.php';
if (!isset($_POST['operacion'])) {
	echo "ERROR : operacion no definida";
};
switch ($_POST['operacion']) {
	case 'nuevo':
			$nombre = $_POST['nombre'];
			$ruc = $_POST['ruc'];
			$tel = $_POST['tel'];
			$dir = $_POST['dir'];
		if (strlen($nombre)>0) {
			$sql = "INSERT INTO clientes (id_cliente , n_cliente , ruc_cliente , dir_cliente , tel_cliente , fecha_cliente)
					VALUES (Null , '$nombre' , '$ruc' , '$dir' , '$tel', CURRENT_TIMESTAMP )";
				if($mysqli->query($sql) === true){
					echo "Cliente creado con exito.";
				} else{
   					echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
				}
		}else {
			echo "ERROR: NO SE ENVIO NINGUN DATO AL SERVIDOR";
		};
		break;
	case 'edit':
		$nombre = $_POST['nombre'];
		$ruc = $_POST['ruc'];
		$tel = $_POST['tel'];
		$dir = $_POST['dir'];
		$id = $_POST['id'];
		if (strlen($nombre)>0) {
			$sql = "UPDATE clientes SET n_cliente = '$nombre' , ruc_cliente = '$ruc' ,  dir_cliente = '$dir' , tel_cliente = '$tel' WHERE id_cliente = '$id'";
			if ($mysqli->query($sql) === true) {
					echo "Informacion actualizada con exito.";	
					}else{
   					echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
   					}
		}else {
			echo "ERROR: NO SE ENVIO NINGUN DATO AL SERVIDOR";		
		};
		break;		
	default:
		# code...
		break;
};
 ?>