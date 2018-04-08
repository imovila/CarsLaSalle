<?php 
include "../includes/dbconfig.php";

class DB{
	
	public $Connection;
	
	function __construct(){
		
		$this->OpenConnection();
	}

	function __destruct(){
		
		$this->CloseConnection();
	}

	function OpenConnection(){
		global $USER, $PASSWD, $DBNAME, $DBSERVER;
		
		try{
			$this->Connection =  new PDO("mysql:host=$DBSERVER; dbname=$DBNAME", $USER, $PASSWD);
			$this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $ex){
			echo "Connection Failed. Error: ".$ex->getMessage();
		}		
	}
    
	function CloseConnection(){
		$this->Connection = null;
	}

}

?>