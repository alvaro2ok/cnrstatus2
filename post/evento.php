<?php
include("../conection/config.php");
session_start();
 date_default_timezone_set("America/Santiago");
if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();


		$evento_id = mysqli_real_escape_string($mysqli,$_REQUEST['evento'])*1;
		$id_servicio = mysqli_real_escape_string($mysqli,$_REQUEST['servicio']);
	    $fecha = mysqli_real_escape_string($mysqli,$_REQUEST['fecha']);
		$hora = mysqli_real_escape_string($mysqli,$_REQUEST['hora']);
		$estado_id = mysqli_real_escape_string($mysqli,$_REQUEST['estado_evento']);
		$detalle = mysqli_real_escape_string($mysqli,$_REQUEST['detalle']);
	
		
$sql = "INSERT INTO `servicio_eventos` ( `id_servicio`, `fecha`, `estado_evento`, `detalle`,`estado_id`, `evento_id`) VALUES ( '$id_servicio', '$fecha $hora', (SELECT nombre FROM `estados` where id=$estado_id), '$detalle',  '$estado_id', '$evento_id')";
        
		$result=$mysqli->query($sql);
		$id=$mysqli->insert_id ;
		if ($id>0) {
			
		$sql = "update  `servicio_eventos`  set evento_id=$id where id=$id and evento_id=0";
		$result=$mysqli->query($sql);
		// revisar si fecha es anterior a la actual, si es asi se cambi ael estado del servicio
		// sino el estado queda tal como esta 
		$target = new DateTime($fecha.' '.$hora);
		$now = new DateTime;
		$diff = $target->diff($now);

		if ($target < $now) {
			$sql = "update  `servicios`  set estado_id=$estado_id, estado_servicio=(SELECT nombre FROM `estados` where id=$estado_id) where id=$id_servicio ";
			$result=$mysqli->query($sql);
		}
		
		 echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha ingresado el evento  exitosamente!","tipo"=>"success")); 
		 if (strlen($app_email)>0) {
			 //Al agregar un nuevo evento o un nuevo detalle del evento, que envie un  correo a cnrappstatus@cnr.gob.cl con la sgte. información el sistema, evento, fecha y hora desde, fecha y hora hasta, usuario,  mensaje.
				 	 $sql="SELECT se.id,evento_id,nombre, fecha, servicio,detalle,estado_evento, estado_servicio FROM `servicio_eventos` se,estados e,servicios s WHERE se.id=".$id." and se.id_servicio= s.id and e.id=se.estado_id";
				 	$result=$mysqli->query($sql);
					$rows = $result->num_rows;
		$txt="";
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				if ($row["evento_id"]==$row["id"]) {
					$txt = "\r\n NUEVO EVENTO \r\n  ";
				}else
				{
					$txt = "\r\n DETALLE EVENTO \r\n ";
				}
				
				$txt =$txt."\r\nSERVICIO: ".$row["servicio"];
			 $txt = $txt."\r\nFECHA: ".$row["fecha"];
			 $txt = $txt."\r\nUSUARIO: ".$_SESSION['usuario'];
			 $txt = $txt."\r\nESTADO: ".$row["estado_evento"];
			 $txt = $txt."\r\nMENSAJE: ".$row["detalle"];
			 $txt = $txt."\r\n\r\n CNRStatus ";
			 $subject = "CNRStatus: Evento ID ".$row["evento_id"];
				} 
		}
			  
	 
			
	 
			 
			 $headers  = "";
			 if (strlen($app_email)>7) {
			 $mail = mail($app_email,$subject,$txt,$headers); 
			 }
		 }
		}else{
			 echo json_encode(array("respuesta"=>"Error al grabar a la base de datos","tipo"=>"danger")); 
			}
		
?>