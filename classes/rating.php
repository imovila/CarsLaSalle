<?php 
require_once "dbdata.php";

class Rating extends Dbdata{
	private $carid;
	private $userid;
    private $rating;
	
	function __construct($carid, $userid, $rating){
        $this->carid = $carid;
		$this->userid = $userid;
		$this->rating = $rating;
	}

    public function Set(){
        $param = array($this->carid, $this->userid, $this->rating);
        
        if (self::NonQuery("INSERT INTO carratings (carid, userid, rating) VALUES(?, ?, ?);", $param) === true)
            return "Rating successfully added";     
	}
    
    public static function Get($carid, $userid){
        return self::QueryAll("SELECT rating FROM carratings where carid = ".$carid." and userid = ".$userid, false)['rating'];
	}

}

?>