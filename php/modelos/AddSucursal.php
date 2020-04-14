<?php 
 
include '../conf/concxion.php';

if (!isset($_POST['operacion'])) {
	# code...
	die;
};

switch ($_POST['operacion']) {
	case 'nuevo':
		if (strlen($_POST['sucursal'])>0) {
			$sucursal = $_POST['sucursal'];
			$sql = "INSERT INTO sucursales (id_sucursal, n_sucursal) VALUES(null, '$sucursal')";
			if($mysqli->query($sql) === true){
    				echo "Sucursal creado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};
		break;
	case 'edit':
		if (strlen($_POST['sucursal'])>0 || strlen($_POST['id_sucursal'])>0 ) {
			$sucursal = $_POST['sucursal'];
			$id_sucursal = $_POST['id_sucursal'];
			$sql = "UPDATE `sucursales` SET `n_sucursal` = '$sucursal' WHERE `sucursales`.`id_sucursal` = '$id_sucursal'";
			if($mysqli->query($sql) === true){
    				echo "sucursal actualizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};	
			break;
	case 'eliminar':
		if (strlen($_POST['id_sucursal'])>0 ) {
			$id_sucursal = $_POST['id_sucursal'];
			$sql = "UPDATE sucursales SET estado_sucursal = 1 WHERE id_sucursal = $id_sucursal";
			if($mysqli->query($sql) === true){
    				echo "sucursal deshabilitada con exito con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
				}else{
					echo "error . cadena vacia......";
				};	
					# code...
					break;		

	case 'activar':
		if (strlen($_POST['id_sucursal'])>0 ) {
			$id_sucursal = $_POST['id_sucursal'];
			$sql = "UPDATE sucursales SET estado_sucursal = 0 WHERE id_sucursal = $id_sucursal";
			if($mysqli->query($sql) === true){
    				echo "sucursal Habilitada con exito con exito.";
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
};

  ?>