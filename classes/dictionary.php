<?php
require_once "dbdata.php";

class Dict extends Dbdata{
	private $id;
	private $name;
		
	function __construct($name, $id = null){
		$this->id = $id;
        $this->name = $make;
	}

    public static function ReadDicData($dic, $id){
        return self::QueryAll("SELECT name FROM $dic where id = $id", false)['name'];
	}
    
	public static function GetData($dictName){
        return self::QueryAll("SELECT * FROM $dictName;");
	}
 
    public static function GetModel($dictIDP){
        return self::QueryAll("SELECT id, name FROM dicmodel where makeid = $dictIDP");
	}

}
?>
