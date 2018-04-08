<?php 
require_once "dbdata.php";

class Message extends Dbdata{
    private $id;
	private $name;
	private $email;
    private $phone;
    private $message;
    private $userid;
    
	function __construct($name, $email, $phone, $message, $userid = null, $id = null){
        $this->id = $id;
        $this->name = $name;
		$this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->userid = $userid;
	}

    public function Set(){
        $param = array($this->name, $this->email, $this->phone, $this->message, $this->userid);
        
        if (self::NonQuery("INSERT INTO messages (name, email, phone, message, userid) VALUES(?, ?, ?, ?, ?);", $param) === true)
            return "Messages successfully added";     
	}
    
}

?>