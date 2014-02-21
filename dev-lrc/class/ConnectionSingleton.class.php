<?php

class ConnectionSingleton{
	protected static $_connection;
	protected static $PARAM_host = 'localhost';
	protected static $PARAM_port = '3306';
	protected static $PARAM_db = 'cite17';
	protected static $PARAM_user = 'lrc17';
	protected static $PARAM_pass = '6fLfCUnpCZAN4ARA';

	public static function connect(){
		if(!isset(self::$_connection)){
			try{
				self::$_connection = new PDO('mysql:host='.self::$PARAM_host.';port='.self::$PARAM_port.';dbname='.self::$PARAM_db, self::$PARAM_user, self::$PARAM_pass);
			} catch(Exception $e){
				echo 'Erreur : '.$e->getMessage().'<br />';
        		echo 'N° : '.$e->getCode();
        		die();
			}
		}
		return self::$_connection;
	}
}
?>