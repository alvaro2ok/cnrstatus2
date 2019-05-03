<?php
include("../conection/config.php");
session_start();

if ($_SESSION['id']*1<1) {
	echo json_encode(array("respuesta"=>"Sin permisos","tipo"=>"danger"));
	}
$salida=array();


		$evento_id = mysqli_real_escape_string($mysqli,$_REQUEST['evento']);
		$id_servicio = mysqli_real_escape_string($mysqli,$_REQUEST['servicio']);
	    $fecha = mysqli_real_escape_string($mysqli,$_REQUEST['fecha']);
		$hora = mysqli_real_escape_string($mysqli,$_REQUEST['hora']);
		$estado_id = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		$detalle = mysqli_real_escape_string($mysqli,$_REQUEST['detalle']);
		$estado_evento = mysqli_real_escape_string($mysqli,$_REQUEST['estado_evento']);
		$id = mysqli_real_escape_string($mysqli,$_REQUEST['id']);
		$estado = mysqli_real_escape_string($mysqli,$_REQUEST['estado']);
		
$sql = "update  `servicio_eventos`  set `fecha`='$fecha $hora', `estado_evento`= (SELECT nombre FROM `estados` where id=$estado_evento), `detalle`='$detalle',`estado_id`='$estado_evento', estado='$estado' where id=$id ";
        
		$result=$mysqli->query($sql);
	    
 if ($mysqli->affected_rows>0){
		
		 echo json_encode(array("respuesta"=>"<strong>Exito!!</strong> Se ha actualizado el estado exitosamente!","tipo"=>"success")); 
		 
		 		 if (strlen($app_email)>0) {
			 //Al agregar un nuevo evento o un nuevo detalle del evento, que envie un  correo a cnrappstatus@cnr.gob.cl con la sgte. información el sistema, evento, fecha y hora desde, fecha y hora hasta, usuario,  mensaje.
			 	 $sql="SELECT evento_id,nombre, fecha, servicio,detalle,estado_evento, estado_servicio FROM `servicio_eventos` se,estados e,servicios s WHERE se.id=".$evento_id." and se.id_servicio= s.id and e.id=se.estado_id";
				 	$result=$mysqli->query($sql);
					$rows = $result->num_rows;
		$txt="";
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				
				$txt = "\r\nSERVICIO: ".$row["servicio"];
			 $txt = $txt."\r\nFECHA: ".$row["fecha"];
			 $txt = $txt."\r\nUSUARIO: ".$_SESSION['usuario'];
			 $txt = $txt."\r\nESTADO: ".$row["estado_evento"];
			 $txt = $txt."\r\nMENSAJE: ".$row["detalle"];
			 $txt = $txt."\r\n\r\n CNRStatus ";
				} 
		}
			 $subject = "CNRStatus: Edicion de evento id ".$evento_id;
		 
			 
			
			 $headers="";
			 $mail = mail($app_email,$subject,$txt,$headers); 
			  if (strlen($app_email)>7) 
			  {
				   $mail = mail($app_email,$subject,$txt,$headers); 
				}
 }else
 {
	  echo json_encode(array("respuesta"=>"No se ha realizado ninguna actualizacion","tipo"=>"info")); 
	 }
	 
	   
		 
		
?>