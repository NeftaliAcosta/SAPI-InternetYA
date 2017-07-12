<?php
	session_start();
	if(!$_SESSION["validar"]){
		header("location:index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Gestión de Pagos</title>
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="views/css/style.css" /> 

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="views/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="panel.php">Sistema de Gestión de Pagos</a>
            </div>
            <!-- /.navbar-header -->

            <!-- <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                   <ul class="dropdown-menu dropdown-user">

                       <li><a href="panel.php?modulo=perfil"><i class="fa fa-user fa-fw"></i>Perfil</a>
                        </li>
                        <li><a href="panel.php?modulo=config"><i class="fa fa-cog fa-fw"></i>Configuración</a>
                        </li>
                        <li><a href="salir.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                        </li>
                    </ul
                   
                </li>
              
            </ul>-->
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="panel.php"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
                        </li>
                        <li>
                            <a href="panel.php?modulo=clientes"><i class="fa fa-user fa-fw"></i>Clientes</a>
                        </li>
                        <li>
                            <a href="panel.php?modulo=pagos"><i class="fa fa-money fa-fw"></i>Pagos Pendientes</a>
                        </li>
                        <li>
                            <a href="panel.php?modulo=facturas"><i class="fa fa-shopping-cart fa-fw"></i>Facturas Pagadas</a>
                        </li>
						<li>
                            <a href="panel.php?modulo=cancelaciones"><i class="fa fa-minus-circle fa-fw"></i>pagos Cancelados</a>
                        </li>
                        <li>
                            <a href="panel.php?modulo=tickets"><i class="fa fa-support fa-fw"></i>Tickets</a>
                        </li>

                       <li><a href="panel.php?modulo=perfil"><i class="fa fa-user fa-fw"></i>Mi Perfil</a>
                        </li>
                        <li><a href="panel.php?modulo=config"><i class="fa fa-cog fa-fw"></i>Configuración</a>
                        </li>
                        <li><a href="salir.php"><i class="fa fa-sign-out fa-fw"></i>Salir</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper"><br>
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">Bienvenido <pan>Neftalí Acosta</pan></h1>-->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            	<?php 
					/*error_reporting(E_ALL);
					ini_set('display_errors', 1);*/
					require_once "models/enlaces.php"; 
					require_once "models/crud.php";
					require_once "controller/controller.php";

					$mvc = new MvcController();
					$mvc -> pagina();
            	 ?>
            <!-- /.row -->
			<br>
            <div class="container-fluid footer">
			<?php 
                $w = Datos::detalleSistema();
                echo '<p>'.$w["nSistema"].' Versión '.$w["vSistema"].' Powered by: <span>Gubynetwork.com</span> © 2017</p>';
             ?>
			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script type='text/javascript' src='views/js/myjs.js'></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="views/js/bootstrap-select.min.js"></script>
    <script src="views/js/tinymce.min.js"></script>
     <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Comprobante</h4>
          </div>
          <div class="modal-body">
            <img src="" class="img-responsive" id="ipago">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- fin Modal-->


        <!-- Modal -->
    <div id="notificacion" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">¡Alerta del sistema!</h4>
          </div>
          <div class="modal-body">
             Está a punto de eliminar información del sistema que no será posible recuperar. ¿Está seguro de realizar esta acción?.
          </div>
          <div class="modal-footer">
            <a  href="" id="btncontinuar" class="btn btn-danger">Continuar</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
    </div>
    <!-- fin Modal-->



<script>
var data = {
  labels: ['Enero', 'Febero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agost', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    series: [
    [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
    [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
  ]
};

var options = {
  seriesBarDistance: 15
};

var responsiveOptions = [
  ['screen and (min-width: 641px) and (max-width: 1024px)', {
    seriesBarDistance: 10,
    axisX: {
      labelInterpolationFnc: function (value) {
        return value;
      }
    }
  }],
  ['screen and (max-width: 640px)', {
    seriesBarDistance: 5,
    axisX: {
      labelInterpolationFnc: function (value) {
        return value[0];
      }
    }
  }]
];

new Chartist.Bar('.ct-chart', data, options, responsiveOptions);
</script>


</body>

</html>
