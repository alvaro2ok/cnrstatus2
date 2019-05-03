<?php
session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);

include("../conection/config.php");
include("../vendor/phpMailer/class.smtp.php");
include("../vendor/phpMailer/class.phpmailer.php");

//ini_set("display_errors", 1);
//error_reporting(E_ALL);
 
$error = ''; 
$sqlListHostZabbix = ""; 
$outputListHosts = array(); 
$queueStatus = isset($_GET["queueStatus"])? true: false;

if($queueStatus)
{
  $sqlListHostZabbix = 'SELECT
                          h.hostid,
                          hgp.groupid,
                          hgp.name AS proceso,
                          h.name as nombre,
                          h.host as nombremaquina,
                          (SELECT GROUP_CONCAT(ip) FROM interface si WHERE si.hostid = h.hostid) AS interface, 
                          (SELECT 
                            GROUP_CONCAT(DISTINCT t.description) 
                          FROM 
                            triggers t 
                            JOIN functions f ON f.triggerid = t.triggerid 
                            JOIN items i ON i.itemid = f.itemid 
                            JOIN events e ON e.objectid = t.triggerid 
                          WHERE 
                            1=1
                            AND (FROM_UNIXTIME(e.clock) > DATE_ADD(NOW(), INTERVAL -1 DAY))
                            AND e.object-0=0
                            AND e.severity >=4
                            AND t.priority >=4
                            AND h.status =0 
                            AND i.status =0 
                            AND t.status =0 
                            AND i.hostid = h.hostid
                          ) AS problema
                        FROM
                          hstgrp hgp
                          JOIN hosts_groups hg ON hg.groupid =hgp.groupid
                          JOIN `hosts` h ON hg.hostid = h.hostid
                        WHERE
                          hgp.name IN("Aplicaciones Web","Plataforma Virtual","DataCenter","Redes y Comunicaciones","Servidor","Zabbix servers")
                        ORDER BY proceso ASC;
                      ';
//echo var_dump($mysqli->errno);
//echo var_dump(mysqli_error($mysqliZabbix));
//echo var_dump($result->num_rows); 

  $mysqliZabbix->set_charset("utf8");
  $resultArrayZabbix=$mysqliZabbix->query($sqlListHostZabbix);

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = getenv("PHPMAILER_HOST");
  //$mail->Host = "smtp.gmail.com";
  $mail->Port = getenv("PHPMAILER_PORT");

  //$mail->SMTPDebug = 1;
  
  $mail->SMTPAuth = getenv("PHPMAILER_SMTPAuth");
  //$mail->SMTPAuth = true;
  $mail->Username = getenv("PHPMAILER_USERNAME");
  $mail->Password = getenv("PHPMAILER_PASSWORD");

  $mail->SMTPSecure = getenv("PHPMAILER_SMTPSecure");
  

  $mail->setFrom(getenv("PHPMAILER_SETFROM_1"), getenv("PHPMAILER_ADDRESS_1"));
  $mail->addAddress(getenv("PHPMAILER_SETFROM_2"), getenv("PHPMAILER_ADDRESS_2"));
  //$mail->addAddress("scasabonne@gmail.com", "CNR");
  $mail->isHTML(getenv("PHPMAILER_ISHTML"));
  $mail->Subject = "Estados de los Activos CNR - ".date("d-m-Y");

  $bodyResponse  = '<table class="table table-bordered table-hover" id="tblEstadoActivos">';
  $bodyResponse .= '<thead>';
  $bodyResponse .= '<tr>';
  $bodyResponse .= '<th>Proceso</th>';
  $bodyResponse .= '<th>Nombre</th>';
  $bodyResponse .= '<th>Host</th>';
  $bodyResponse .= '<th>Inteface</th>';
  $bodyResponse .= '<th>Problema</th>';
  $bodyResponse .= '<th>URL</th>';
  $bodyResponse .= '<th>Fecha</th>';
  $bodyResponse .= '</tr>';
  $bodyResponse .= '</thead>';
  $bodyResponse .= '<tbody>';
  while($rowZabbix = $resultArrayZabbix->fetch_assoc())
  {
    //$outputListHostsZabbix[]=$rowZabbix;
    $tmpProblema = empty($rowZabbix["problema"])? "ok": $rowZabbix["problema"];
    $bodyResponse .= '<tr>';
    $bodyResponse .= '<td>'.$rowZabbix["proceso"].'</td>';
    $bodyResponse .= '<td>'.$rowZabbix["nombre"].'</td>';
    $bodyResponse .= '<td>'.$rowZabbix["nombremaquina"].'</td>';
    $bodyResponse .= '<td>'.$rowZabbix["interface"].'</td>';
    $bodyResponse .= '<td>'.$tmpProblema.'</td>';
    $bodyResponse .= '<td>'.getenv("ZABBIX_URL").'</td>';
    $bodyResponse .= '<td>'.date("d-m-Y H:i:s").'</td>';
    $bodyResponse .= '</tr>';
    

    // Guardar en la base de datus de cnr status
    $sqlInsertCnrStatus = " INSERT INTO activos (hostid,groupid,proceso,subproceso,host,interface,problema,url,fecha) VALUES ";
    $sqlInsertCnrStatus .= " ('".$rowZabbix["hostid"]."','".$rowZabbix["groupid"]."','".$rowZabbix["proceso"]."','".$rowZabbix["nombre"]."','".$rowZabbix["nombremaquina"]."','".$rowZabbix["interface"]."','".$tmpProblema."','".getenv("ZABBIX_URL")."','".date("Y-m-d H:i:s")."'); ";
    //echo $sqlInsertCnrStatus."<br>";
    $mysqli->query($sqlInsertCnrStatus);
  
  } 
  $bodyResponse .= '</tbody>';
  $bodyResponse .= '</table>';

  $mail->Body    = $bodyResponse;
  $mail->AltBody = 'Clientes de correo electrónico no tiene habilitado HTML.';
  $mail->send();
  //echo $mail->ErrorInfo;
  //exit;
}
else
{

  $sqlListHostCnrStatus = 'SELECT
                             idactivo,
                             hostid,
                             groupid,
                             proceso,
                             subproceso,
                             host,
                             interface,
                             problema,
                             url,
                             DATE_FORMAT(fecha, "%d-%m-%Y") AS fecha
                           FROM
                             activos
                          ORDER BY proceso ASC;
                          ';
//echo var_dump($mysqli->errno);
//echo var_dump(mysqli_error($mysqliZabbix));
//echo var_dump($result->num_rows);  

  $mysqli->set_charset("utf8");
  $resultArrayCnrStatus=$mysqli->query($sqlListHostCnrStatus);
 
  while($rowCnrStatus = $resultArrayCnrStatus->fetch_assoc())
  {
    $outputListHostsCnrStatus[]=$rowCnrStatus;
  } 
  print json_encode(array("data"=>$outputListHostsCnrStatus));
}
?>
