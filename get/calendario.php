<?php

$dia=$_REQUEST["dia"];
//$test=date("Y-m-d",strtotime('last monday', strtotime('tomorrow')));
$hoy=new DateTime(date('Y-m-d'));
if (strlen($dia)==0){
	$f=date('Y-m-d');
	$lunes=date( 'Y-m-d',strtotime('last Monday',strtotime("tomorrow")));
	$f=$lunes;
	$dia=$f;
	$fo=date("d/m/y",strtotime("$f"));
	
}else{
   $f=date($dia);
   $lunes=date( 'Y-m-d',strtotime('last Monday',strtotime("$f +1 day ")));
   $f=date("Y-m-d",strtotime("$f"));
   $fo=date("d/m/y",strtotime("$f"));
	}
$salida=array();
// se cambia para que el primer dia sea hoy
	$default=0;
	$compare=new DateTime(date("Y-m-d", strtotime($f)));
	
	if ($hoy>=$compare){
	$default=1;
	}
	
$salida[]=array("fecha"=>$fo,"original"=>$f,"default"=>$default);
for( $i = 1; $i < 7; $i++ ){
	$default=0;
	$compare=new DateTime(date("Y-m-d", strtotime("$f   +$i day")));
	
	if ($hoy>=$compare){
	$default=1;
	}
	
	$salida[]=array("fecha"=>date("d/m/y", strtotime("$f   +$i day")),"original"=>date("Y-m-d", strtotime("$f   +$i day")),"default"=>$default);
}



if (date("Y-m-d")==$f){
	echo json_encode(array("calendario"=>$salida,
                 "fechas"=>array(
				  "lunes"=>$lunes,
				 "dia"=>$dia,
				 "hoy"=>date("Y-m-d"),
				 "anterior"=>date("Y-m-d", strtotime("$f -1 day")),
				 "siguiente"=>date("Y-m-d", strtotime("$f +1 day"))
				 ))
				 );
}else{
echo json_encode(array("calendario"=>$salida,
                 "fechas"=>array(
				 "lunes"=>$lunes,
				 "dia"=>$dia,
				 "hoy"=>date("Y-m-d"),
				 "anterior"=>date("Y-m-d", strtotime("$f -1 day")),
				 "siguiente"=>date("Y-m-d", strtotime("$f +1 day"))
				 ))
				 );
}
?>