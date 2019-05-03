<?php 
session_start();
include("conection/config.php");

// login
if(!empty($_POST))
{
  $usuario = mysqli_real_escape_string($mysqli,$_POST['login']);
  $password = mysqli_real_escape_string($mysqli,$_POST['password']);
  $error = '';

  $sql = "SELECT id, login,nombre, mail, pass FROM  usuarios  WHERE login  = '$usuario' and estado='vigente'";
  $result=$mysqli->query($sql);
  $rows = $result->num_rows;

  if($rows > 0) {
    $row = $result->fetch_assoc(); 
    //	if (password_verify($password, $row['pass'])){
    if ($password ==  $row['pass'])
    {
      $_SESSION['id'] = $row['id'];
      $_SESSION['usuario'] = $row['login'];
      $_SESSION['nombre'] = $row['nombre'];
      $_SESSION['mail'] = $row['mail'];
      header('Location: adminDashboard.php');
    }
    else
    {
      $js = "<script type='text/javascript'>";
      $js .= "alert('El nombre o contraseña son incorrectos');";
      $js .= "</script>";
      echo $js;
    }
  }
  else 
  {
    $js = "<script type='text/javascript'>";
    $js .= "alert('El nombre o contraseña son incorrectos');";
    $js .= "</script>";
    echo $js;
  }
}

if(isset($_SESSION["id"]))
{
  if ($_SESSION["id"]*1>0)
  {
    header('Location: adminDashboard.php');
	}
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
      #dash{ display:1none;}
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
  </head>
  <body>
  <?php include("include/header.php"); ?>
  <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="login.php">Administrador</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container separation" role="main">
      <div class="page-header">
        <h2>Administrador</h2>
      </div>
	    <div> 
        <form action="login.php" method="post"> 
          <div class="form-group"> 
            <label for="login">Usuario</label>
            <input type="text" class="form-control" id="login" name="login"  placeholder="Usuario"> 
          </div> 
          <div class="form-group"> 
            <label for="password">Contraseña</label> 
            <input type="password" name="password"  class="form-control" id="password" placeholder="Contraseña"> 
          </div>    
          <button type="submit" class="btn btn-primary">Login</button> 
        </form> 
      </div> 
    </div> <!-- /container -->
<?php include("include/footer.php");?>

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bs/js/jquery.min.js"></script>
    <!-- <script>window.jQuery || document.write('<script src="bs/assets/js/vendor/jquery.min.js"><\/script>')</script> -->
    <script src="bs/js/bootstrap.min.js"></script>
    <script src="bs/assets/js/docs.min.js"></script>
 
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
  
  </body>
</html>
