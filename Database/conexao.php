<?php 

class Conexao {

private static $instance;

  public static function getConnect() {

	if(!isset(self::$instance)){
		self::$instance = new \PDO('mysql:host=localhost;dbname=estoque;charset=utf8','root','root');
	}

		return self::$instance;
  }
}




?>