<html>
<head>
 <link type="text/css" rel="stylesheet" href="views/css/bootstrap.css" />
 <link type="text/css" rel="stylesheet" href="views/css/bootstrap-theme.css" />
 <link type="text/css" rel="stylesheet" href="views/css/style.css" /> 

 <script
  src="https://code.jquery.com/jquery-1.12.4.js"
  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 <script type='text/javascript' src='views/js/myjs.js'></script>
</head>

<body>


<div class="container">    
        
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
        
        <div class="row">                
            <div class="iconmelon">
			     <img src="views/img/logo.png" class="img-responsive">
            </div>
        </div>
        
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Panel de Administración</div>
            </div>     

            <div class="panel-body" >

                <form name="form" method="post" id="form" class="form-horizontal" autocomplete="off">
                   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="usuarioIngreso"  placeholder="Usuario">                                        
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="passwordIngreso" placeholder="Contraseña">
                    </div>                                                                  

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit"  name="login" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i>Entrar</button>                          
                        </div>
                    </div>
                    <?php 
                        require_once "models/crud.php";
                        require_once "controller/controller.php";

                        $a = new MvcController();
                        $a -> ingresoAdminController();
                     ?>
                </form>     

            </div>                     
        </div>  
    </div>
</div>

<div id="particles"></div>


<div class="container-fluid footer">
	<p> Sistema de Gestión de Pagos Powered by: <span>yo.com</span> © 2017</p>
</div>
</body>


</html>