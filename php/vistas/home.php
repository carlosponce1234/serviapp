<?php 
require '../conf/concxion.php';
session_start();

if (!isset($_SESSION["id_usuario"])) {
	header("Location: ../../index.php");
}
/* echo $_SESSION["id_usuario"];
   echo $_SESSION["n_usuario"];
*/

switch ($_SESSION['tipo_usuario']) {
   	case '1':
   	#Administrdor
   	header("location: dashboard/dashboard.php ");
   		break;
   	
   	default:
   		# code...
   		break;
   }   
 ?>
