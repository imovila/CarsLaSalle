<?php 
require_once "dbdata.php";

class Comment extends Dbdata{
	private $carid;
	private $userid;
    private $comment;
	
	function __construct($carid, $userid, $comment){
        $this->carid = $carid;
		$this->userid = $userid;
		$this->comment = $comment;
	}

	public function Set(){
        $param = array($this->carid, $this->userid, $this->comment);
        
        if (self::NonQuery("INSERT INTO carcomments (carid, userid, comment) VALUES(?, ?, ?);", $param) === true)
            return "Comment successfully added";     
	}

    
    public static function Get($carid){
        return self::QueryAll("SELECT comment, (select username from users u where u.userid = c.userid) username FROM carcomments c where carid = ".$carid);
	}

}

?>