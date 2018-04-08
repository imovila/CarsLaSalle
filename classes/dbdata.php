<?php 
require_once "dbconnection.php";
	
class Dbdata{
    
    protected static $myDB;
    
    public static function InitConnection(){
		if(!isset(self::$myDB)){
			self::$myDB = new DB();
		}
	}
	
    protected static function QueryAll($query, $all = true){
		try{
            self::InitConnection();
			$stmt = self::$myDB->Connection->prepare($query);	
			$stmt->execute();
            
			return $all ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch();
			
		}catch(PDOException $e){
			echo "Failed: ".$e->getMessage();
		}
	}

    protected static function NonQuery($nonquery, $param = null){
        try{
            self::InitConnection();
            self::$myDB->Connection->beginTransaction();

            $stmt = self::$myDB->Connection->prepare($nonquery);
            
            for ($i = 0; $i < count($param); $i++)    
                $stmt->bindParam($i + 1, $param[$i]);

            $stmt->execute();
            
            self::$myDB->Connection->commit();
            return true;
        }
        catch(PDOException $e){
            self::$myDB->Connection->rollback();
            return "Failed: " . $e->getMessage();
        }
	}
    
}

?>