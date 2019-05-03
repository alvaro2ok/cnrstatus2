<?php
include("../conection/config.php");

$salida=array();
$id=mysqli_real_escape_string($mysqli,$_REQUEST['id']);
// se revisa queno existan eventos futuros activos 
$sql="update servicio_eventos,servicios set servicios.estado_id=servicio_eventos.estado_id ,servicios.estado_servicio=servicio_eventos.estado_evento  where    fecha< now() and servicio_eventos.estado='vigente'   and servicios.id=servicio_eventos.id_servicio and servicio_eventos.id = (select max(x.id) from servicio_eventos x where servicio_eventos.id_servicio=x.id_servicio   and x.fecha < now() )  ";

$mysqli->query($sql);

$sql="update servicio_eventos,servicios set servicios.estado_id=servicio_eventos.estado_id ,servicios.estado_servicio=servicio_eventos.estado_evento  where  servicio_eventos.estado_id=1 and  fecha < now()  and servicio_eventos.estado='vigente' and servicio_eventos.id<> servicio_eventos.evento_id and servicios.id=servicio_eventos.id_servicio and estado_servicio <> estado_evento and servicio_eventos.id = (select max(x.id) from servicio_eventos x where servicio_eventos.id_servicio=x.id_servicio and x.id<>x.evento_id and x.fecha < now() ) ";

//$mysqli->query($sql);
// fin revision
if (strlen($id)>0){
	$sql = "SELECT *  from servicios where id=$id";
}else{
$sql = "SELECT servicios.id, servicios.servicio,estados.color,servicios.estado_servicio,servicios.estado, servicios.estado_id  from servicios,estados where estados.id=estado_id order by servicio asc";
}
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$salida[]=$row;
				} 
		}
		
		print json_encode(array("servicios"=>$salida));
		

?>