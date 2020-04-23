<?php 
include '../conf/concxion.php';
if (!isset($_POST['operacion'])) {
	echo "ERROR : operacion no definida";
};
switch ($_POST['operacion']) {
	case 'edit':
		$nombre = $_POST['nombre'];
		$cat = $_POST['cat'];
		$vehiculo = $_POST['vehiculo'];
		$id = $_POST['id'];
		$sql = "UPDATE conductores SET n_conductor = '$nombre' , cat_lic = '$cat' , cod_vehiculo = '$vehiculo' WHERE id_conductor = '$id'";
		if ($mysqli->query($sql) === true) {
			echo "Conductor editado con exito";
		}else{
			echo "ERROR : No se pudo realizar la operacion ";
		}
		break;
	
	default:
		# code...
		break;
}
 ?>