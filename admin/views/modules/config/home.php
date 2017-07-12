<?php 
        $esistema= "";
        $nsistema= "";
        $txtaviso= "";
        $txtbancarios = "";

    if( mysql_real_escape_string(isset($_POST["ntickets"]))==1 ||  
        mysql_real_escape_string(isset($_POST["npagos"]))==1 || 
        mysql_real_escape_string(isset($_POST["ncliente"]))==1 || 
        mysql_real_escape_string(isset($_POST["naviso"]))==1 || 
        mysql_real_escape_string(isset($_POST["esistema"])) || 
        mysql_real_escape_string(isset($_POST["nsistema"])) || 
        mysql_real_escape_string(isset($_POST["txtaviso"])) || 
        mysql_real_escape_string(isset($_POST["txtaviso"]))|| 
        mysql_real_escape_string(isset($_POST["txtbancarios"])) ){
        if(!isset($_POST["ntickets"])) {
            $ntickets=0;
        }else{
            $ntickets=1;
        }
        if(!isset($_POST["npagos"])) {
            $npagos=0;
        }else{
            $npagos=1;
        }
        if(!isset($_POST["ncliente"])) {
            $ncliente=0;
        }else{
            $ncliente=1;
        }
        if(!isset($_POST["naviso"])) {
            $naviso=0;
        }else{
            $naviso=1;
        }
        if(empty($_POST["esistema"])) {
            $esistema="contacto@internetya.com.mx";
        }else{
            $esistema= mysql_real_escape_string($_POST["esistema"]);
        }
        $nsistema= mysql_real_escape_string($_POST["nsistema"]);
        $txtaviso= mysql_real_escape_string($_POST["txtaviso"]);
        $txtbancarios = mysql_real_escape_string($_POST["txtbancarios"]);

        $datos = ["ntickets" => $ntickets, "npagos" => $npagos, "nclientes" => $ncliente, "naviso" => $naviso, "esistema" => $esistema, "nsistema" => $nsistema, "txtaviso"=> $txtaviso, "txtbancarios" => $txtbancarios];

       
        $w = new MvcController();
        $w -> actualizarSistemacontroller($datos);
        
    }
    else{
        $a = new MvcController();
        $a -> sistemaController();
    }
        




