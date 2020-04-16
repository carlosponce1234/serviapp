<?php 

include '../conf/concxion.php';

if (!isset($_POST['operacion'])) {
  # code...
  echo "ERROR : operacion no definida";
};

switch ($_POST['operacion']) {
  case 'consulta':
  $suc = $_POST['suc'];
    $sql = "SELECT * FROM usuarios u LEFT JOIN usuarioxsucursal q ON u.id_user = q.cod_user LEFT JOIN sucursales s ON s.id_sucursal = q.cod_suc ";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    $row = $result->fetch_assoc();

    if ($rows > 0) {
    foreach ($result as $key => $value) {
      $sql2 = "SELECT count(id_usxsuc) as num ";

      if ($value['cod_suc'] == $suc) {
        echo "<tr user=".$value['id_user']." id=".$value['id_usxsuc'].">
   <td class='nombre'>".$value['n_usuario']."</td>  
   <td class='nombre'>".$value['n_sucursal']."</td>";
   if ($value['asignado']>0) {
    echo "<td class=''>
     <i class='fas fa-ban' data-toggle='tooltip' data-placement='top' title='Usuario Desahabilitado'></i>
   </td>";
   }else{
    echo "<td class=''>
     <i class='fas fa-check' data-toggle='tooltip' data-placement='top' title='Usuario Habilitado'></i>
 </td>";
   };
   echo "<td>";
   if ($value['asignado']>0) {
     echo "
   <button class='btn btn-success ' id='habilitar' data-toggle='tooltip' data-placement='top' title='Habilitar'>
     <i class='fas fa-check'></i> Asignar
   </button>
   </td>
 </tr>";
   }else{
     echo "
   <button class='btn btn-danger ' id='deshabilitar' data-toggle='tooltip' data-placement='top' title='Deshabilitar'>
     <i class='fas fa-ban'></i> Retirar
   </button>
   </td>
 </tr>";
      };
    }
      };
  };
    break;

    case 'asignar':

    $suc = $_POST['suc'];
    $user = $_POST['user'];

    $sql = "UPDATE usuarioxsucursal SET asignado = 0 WHERE cod_user = $user AND cod_suc = $suc";
    if($mysqli->query($sql) === true){
            echo "Usuario asignado con exito.";
        } else{
          echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
          }
      # code...
      break;
    case 'retirar':
       $suc = $_POST['suc'];
    $user = $_POST['user'];

    $sql = "UPDATE usuarioxsucursal SET asignado = 1 WHERE cod_user = $user AND cod_suc = $suc";
    if($mysqli->query($sql) === true){
            echo "Usuario asignado con exito.";
        } else{
          echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
          }
        break;  
  
  default:
    # code...
    break;
}
	
 ?>