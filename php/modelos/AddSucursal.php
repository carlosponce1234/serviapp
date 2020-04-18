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
				$sql2 = "SELECT @@identity as id From sucursales";
				$result2 = $mysqli->query($sql2);
				$row2 = $result2->fetch_assoc();
				$id = $row2['id'];
				$sql3 = "SELECT * FROM usuarios";
				$result3 = $mysqli->query($sql3);
				$row3 = $result3->fetch_assoc();
			  		foreach ($result3 as $k => $v) {
					$suc = $v['id_user'];
					$sq = "INSERT INTO usuarioxsucursal (id_usxsuc , cod_user, cod_suc , asignado) values (null , $suc , $id , 1)";
    					if($mysqli->query($sq) === true){
					
						}else{echo "ERROR: No se pudo realizar la asignacion de usuarios contactar administrador. " . $mysqli->error;};
					};
				echo "Usuario creado con exito.";
			} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
			};
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