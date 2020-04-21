<?php 
include '../head y footer/head.php';
if ($_SESSION['tipo_usuario'] != 1 || $_SESSION['tipo_usuario'] != 4 ) {
  header("Location: ../home.php");
};
 ?>







 <?php 
    include '../head y footer/footer.php';
  ?>
  <script>
  	function prueba_notificacion() {
		if (Notification) {
			if (Notification.permission !== "granted") {
				Notification.requestPermission()
			}
		var title = "Xitrus"
		var extra = {
			icon: "http://xitrus.es/imgs/logo_claro.png",
			body: "Notificación de prueba en Xitrus"
		}
		var noti = new Notification( title, extra)
			noti.onclick = {
				// Al hacer click
			}
			noti.onclose = {	
			// Al cerrar
			}
		setTimeout( function() { noti.close() }, 10000)
		}
	};

$(document).ready(function(){
	prueba_notificacion();
})	
  </script>