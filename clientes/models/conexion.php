<?php 
	class Conexion{


		public function conectar(){
			$dsn = 'mysql:host=localhost;dbname=cmr';
			$usuario = 'root';
			$password = ''; 

			try {
			    $mbd = new PDO($dsn, $usuario, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			    $mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch (PDOException $e) {
				    echo 'Falló la conexión: ' . $e->getMessage();
				}


			return $mbd;
		}
	}
 ?>
 