<?php
include("../conection/config.php");

$salida=array();
$codigo=mysqli_real_escape_string($mysqli,$_REQUEST['codigo']);
$codigo=$codigo*1;
if ($codigo>0) {
$sql = "  SELECT color, date_format(fecha,'%d/%m/%Y %H:%i') fecha, detalle,(select servicio from servicios where servicios.id=id_servicio ) servicio , servicio_eventos.estado FROM `servicio_eventos`, estados  WHERE  estado_id=estados.id and (servicio_eventos.evento_id=".$codigo." or servicio_eventos.id=".$codigo.")  order by fecha desc";
}else {
	$sql = "select id,id_servicio,date_format(fecha,'%d/%m/%Y %H:%i') fecha, estado_evento,detalle,estado,estado_id,evento_id,last  FROM `servicio_eventos` order by servicio_eventos.evento_id desc ";
	}
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida[]=$row;
				} 
		}
		
		print json_encode(array("eventos"=>$salida));
		
?>