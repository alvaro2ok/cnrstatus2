<?php 
 session_start();
if(isset($_SESSION["id"]))
{

}
else
{	
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="dashboard">
    <meta name="author" content="i-technology">
 

    <title>Monitoreo de Servicios CNR</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="bs/css/bootstrap-theme.min.css" rel="stylesheet">
    <link id="bsdp-css" href="bs/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap-clockpicker.min.css">
    <!-- Custom styles for this template -->
    <link href="bs/theme/theme.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="bs/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/AutoFill-2.3.3/css/autoFill.dataTables.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/ColReorder-1.5.0/css/colReorder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/FixedColumns-3.2.5/css/fixedColumns.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/FixedHeader-3.1.4/css/fixedHeader.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/KeyTable-2.5.0/css/keyTable.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/Responsive-2.2.2/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/RowGroup-1.1.0/css/rowGroup.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/RowReorder-1.2.4/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/Scroller-2.0.0/css/scroller.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="bs/datatables/Select-1.3.0/css/select.dataTables.min.css"/>
    
    <style>
        h1{
          word-wrap: break-word;
          -webkit-hyphens: auto;
          -moz-hyphens: auto;
          -ms-hyphens: auto;
          -o-hyphens: auto;
          hyphens: auto;
      }
        #dash{  }
      .badge-red {
        background-color: red;
      }
      .badge-red:hover {
        background-color: #880202;
      }

      .badge-yellow {
        background-color: yellow;
      }
      .badge-yellow:hover {
        background-color: #8c8c01;
      }
        .badge-error {
        background-color: #b94a48;
      }
      .badge-error:hover {
        background-color: #953b39;
      }
      .badge-warning {
        background-color: #f89406;
      }
      .badge-warning:hover {
        background-color: #c67605;
      }
      .badge-success {
        background-color: #468847;
      }
      .badge-success:hover {
        background-color: #356635;
      }
      .badge-info {
        background-color: #3a87ad;
      }
      .badge-info:hover {
        background-color: #2d6987;
      }
      .badge-inverse {
        background-color: #333333;
      }
      .badge-inverse:hover {
        background-color: #1a1a1a;
      }
    </style>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115898324-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-115898324-1');
    </script>
    
    <script  type="text/javascript" src="bs/js/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="bs/js/jquery-1.12.4.min.js"></script> -->
    <!-- <script type="text/javascript" src="bs/js/jquery-3.3.1.min.js"></script> -->

    <script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bs/assets/js/docs.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="bs/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="bs/js/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript" src="bs/js/globals.js"></script>
   
    <script type="text/javascript" src="bs/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="bs/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="bs/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="bs/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="bs/datatables/AutoFill-2.3.3/js/dataTables.autoFill.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="bs/datatables/ColReorder-1.5.0/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="bs/datatables/FixedColumns-3.2.5/js/dataTables.fixedColumns.min.js"></script>
    <script type="text/javascript" src="bs/datatables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="bs/datatables/KeyTable-2.5.0/js/dataTables.keyTable.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="bs/datatables/RowGroup-1.1.0/js/dataTables.rowGroup.min.js"></script>
    <script type="text/javascript" src="bs/datatables/RowReorder-1.2.4/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Scroller-2.0.0/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="bs/datatables/Select-1.3.0/js/dataTables.select.min.js"></script>  

    <script type="text/javascript" src="bs/js/adminDashboard.js"></script>
  </head>
  <body>
    <?php include("include/header.php"); ?>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" id="menu">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="navbar-brand" href="#"><span class=" glyphicon glyphicon-user"></span> <?php echo $_SESSION["usuario"];?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav  " id="menu">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active"><a href="#" onclick="servicios(this)"  id="m1" >Servicios</a> </li>
            <li><a href="#"  id="m2" onclick="estados(this)">Estados</a></li>
            <li><a href="#"  id="m3"  onclick="eventos(this)">Eventos</a></li>
            <li><a href="#"  id="m4"  onclick="usuarios(this)">Usuarios</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" onclick="activos(this)">Estado Activos</a></li>
                <!--
                <li role="separator" class="divider"></li>
                <li><a href="salir.php">Salir</a></li>
                -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="login.php">Administrador</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="salir.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container separation" role="main">
      <div class="page-header">
        <h3>Monitoreo de Servicios CNR Administrador</h3>
      </div>
      <div class="row" id="divservicios">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Servicios</h3></div>
     
     
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success  " onclick="add_servicio()"  >Nuevo</button></div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <table style="display:none" id="renderServicio"><tbody id="cuerpo"><tr>
            <td id="e1"></td>
                    <td id="e2"></td>
                    <td id="e3"></td>
                    <td id="e4"></td>
                    <td id="e5"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_servicio(this)"></span></td>
                  </tr>
                  </tbody>
                  </table>
                  <div class="table-responsive">
              <table class="table " id="dash">
                <thead>
                  <tr class="panel-footer">
                    <th>Codigo</th>
                    <th>Servicio</th>
                    <th>Estado  actual</th>
                    <th>Estado</th>
                    <th>Configuración</th>
                  </tr>
                </thead>
                <tbody id="cuerpotabla">           
                </tbody>
              </table>
              </div>
            </div>
          </div>
    <div class="row" id="divestados" style="display:none" >
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Estados</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success" onclick="add_estado()" >Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderEstado"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                <td id="e5"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_estado(this)"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Estado</th>
                <th>Configuración</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>
                     
    <div class="row" id="diveventos" style="display:none" >
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Eventos</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success" onclick="add_evento()">Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderEvento"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                 <td id="e5"></td>
                  <td id="e8"></td>
                 
                  
                <td id="e7"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_evento(this)"></span> <span class="btn btn-default glyphicon glyphicon-plus" onclick="form_evento_add(this)" id="plus"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Servicio</th>
                <th>Detalle</th>
                <th>Fecha</th>
                <th>Estado Evento</th>
                <th>Tipo</th>
                     
                <th>Configuracion</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>
          <div class="row" id="divusuarios" style="display:none" >
     <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Usuarios</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" ><button type="button" class="btn btn-success " onclick="add_usuario()"  >Nuevo</button></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <table style="display:none" id="renderUsuario"><tbody id="cuerpo"><tr>
        <td id="e1"></td>
                <td id="e2"></td>
                <td id="e3"></td>
                <td id="e4"></td>
                 <td id="e5"></td>
                <td id="e6"><span class="btn btn-default glyphicon glyphicon-cog" onclick="form_usuario(this)"></span></td>
              </tr>
              </tbody>
              </table>
              <div class="table-responsive">
          <table class="table " id="dash">
            <thead>
              <tr class="panel-footer">
                <th>Codigo</th>
                <th>Login</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Configuración</th>
              </tr>
            </thead>
            <tbody id="cuerpotabla">           
            </tbody>
          </table>
          </div>
        </div>
      </div>


      <!-- Start Estados Activos -->
      <div class="row" id="divactivos" style="display:none" >
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12"> <h3>Activos</h3></div>
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <table class="table table-bordered table-hover" id="tblEstadoActivos">
            <thead>
              <tr>
                <th>Proceso</th>
                <th>Nombre</th>
                <th>Host</th>
                <th>Inteface</th>
                <th>Problema</th>
                <th>Fecha Cargada</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!-- End Estados Activos -->

      
     	<div id="formservicio" style="display:none"> 
         <div class="col-md-12"> <h3>Servicios</h3></div>
          <div class="col-md-12">
         <form action="post/servicio.php" method="post" id="form"> <div class="form-group"> <label for="login">Nombre</label>
	      <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="servicio"> </div>   
            <div class="form-group update" > <label for="login">Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  >  
          <button type="button" class="btn btn-primary"  onClick="grabar_servicio()">Grabar</button>
           <button type="button" class="btn btn-deafult" onClick="servicios($('#m1'))">Cancelar</button></form>  
           </div>
           </div>  
          
     <div id="formestado" style="display:none"> 
        <div class="col-md-12"> <h3>Estados</h3></div>
          <div class="col-md-12">
        <form action="post/estado.php" method="post" id="form">
        <div class="form-group"> <label for="login">Nombre</label>
	      <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Nombre del estado"> </div>
        <div class="form-group"> <label for="">Color</label> <span  class="badge badge-error" onclick="fsc('error')" >&nbsp;</span> <span  class="badge badge-warning"  onclick="fsc('warning')" >&nbsp;</span> <span  class="badge badge-success"  onclick="fsc('success')">&nbsp;</span> <span  class="badge badge-info"  onclick="fsc('info')" >&nbsp;</span> <span  class="badge badge-inverse"  onclick="fsc('inverse')">&nbsp;</span> <span  class="badge badge-red"  onclick="fsc('red')">&nbsp;</span> <span  class="badge badge-yellow"  onclick="fsc('yellow')" >&nbsp;</span> <- click para seleccionar<br>
       seleccion: <span  class="badge badge-error"  id="selcolor" >&nbsp;</span> 
         <input type="hidden"  name="color"  class="form-control" id="color" placeholder="color" > 
          </div> 
          <div class="form-group update" > <label for="login">Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  >  
        <button type="button" class="btn btn-primary"  onClick="grabar_estado()">Grabar</button> 
        <button type="button" class="btn btn-deafult" onClick="estados($('#m2'))">Cancelar</button>
        </form>
        </div> 
        </div>
                
    <div id="formevento" style="display:none">
          <div class="col-md-12"> <h3>Eventos</h3></div>
          <div class="col-md-12">
           <form action="post/evento.php" method="post" id="form"> 
           <div class="form-group"> 
           <label for="login">Servicio</label>
	      <select class="form-control" id="servicio" name="servicio" onchange="cambioServicio(this)" ></select> </div> 
          <div class="form-group"> <label for="">Evento</label> <select name="evento"  class="form-control" id="evento" placeholder="evento"><option value="">Nuevo evento</option> </select></div> 
               <div class="form-group"> <label for="">Detalle</label> <textarea name="detalle"  class="form-control" id="detalle" placeholder="detalle"></textarea> </div>    
              <div class="form-group"> <label for="">Fecha</label> 
              (aaaa-mm-dd)
                <input type="text" name="fecha"   class="form-control" id="fecha"  > </div>
               <div class="form-group"> <label for="">Hora</label> 
               (hh:mm)
               <input type="text" name="hora"  class="form-control" id="hora"  > </div>
                 <div class="form-group"> 
           <label for="estado_servicio">Estado Evento</label>
	      <select class="form-control" id="estado_evento" name="estado_evento"   ></select> </div> 
           <div class="form-group update2"  style="display:none"> <label  >Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  > 
          <button type="button" class="btn btn-primary" onClick="grabar_evento()">Grabar</button>
          <button type="button" class="btn btn-deafult" onClick="eventos($('#m3'))">Cancelar</button> </form></div>      
      </div>  
      	<div id="formusuario" style="display:none"> 
         <div class="col-md-12"> <h3>Usuarios</h3></div>
          <div class="col-md-12">
         <form action="post/usuario.php" method="post" id="form"> 
         <div class="form-group"> <label for="login">Login</label>
	      <input type="text" class="form-control" id="login" name="login"  placeholder="login"> </div> 
          <div class="form-group"> <label for="password">Password</label>
	      <input type="text" class="form-control" id="password" name="password"  placeholder="contraseña"> </div> 
         <div class="form-group"> <label for="nombre">Nombre</label>
	      <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre"> </div>   
               <div class="form-group"> <label for="email">Email</label>
	      <input type="text" class="form-control" id="mail" name="mail"  placeholder="correo electronico"> </div>   
            <div class="form-group update" > <label for="login">Estado</label>
	      <select class="form-control" id="estado" name="estado">
          <option value="vigente">vigente</option>
          <option value="no vigente">no vigente</option>
          </select> </div>   
         <input type="hidden"  name="id"  class="form-control" id="id"  >  
          <button type="button" class="btn btn-primary"  onClick="grabar_usuario()">Grabar</button>
           <button type="button" class="btn btn-deafult" onClick="usuarios($('#m4'))">Cancelar</button></form>  
           </div>
           </div>
    </div> <!-- /container -->
  <div class="modal fade" id="alert" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="alert alert-succcess" id="msg">
		  </div>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
</div>
  
  
  </body>
</html>