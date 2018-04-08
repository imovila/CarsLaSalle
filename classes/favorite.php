<?php 
require_once "dbdata.php";

class Favorite extends Dbdata{
    private $id;
	private $carid;
	private $userid;
	
	function __construct($carid, $userid, $id = null){
        $this->id = $id;
        $this->carid = $carid;
		$this->userid = $userid;
	}
    
    //Without Dbdata (needed error 23000)
	public function Set(){
        try{
            self::InitConnection();

            self::$myDB->Connection->beginTransaction();

            $sql = "INSERT INTO carfavorits (carid, userid) ";
            $sql .= "VALUES(?, ?);";

            $stmt = self::$myDB->Connection->prepare($sql);
            $stmt->bindParam(1, $this->carid);
            $stmt->bindParam(2, $this->userid);
            $stmt->execute();
            
            self::$myDB->Connection->commit();
            return "Favorite successfully added";
        }
        catch(PDOException $e){
            self::$myDB->Connection->rollback();
            if ($e->errorInfo[0]==23000)
                return "0It's already in the favorites list !";
            else
                return "Error: " . $e->getMessage();
        }
	}
    
    public static function Get($userid){
        return self::QueryAll("SELECT id, carid FROM carfavorits where userid = ".$userid);
	}

    public static function Delete($favoritid){
        if (self::NonQuery("DELETE FROM carfavorits where id = ".$favoritid) === true)
            return "Favorite successfully deleted";  
	}
}

?>