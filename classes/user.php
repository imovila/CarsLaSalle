<?php 
require_once "dbdata.php";

class User extends Dbdata{
	private $userid;
	private $username;
	private $pwdmd5;
	private $email;
    private $status;
	
	function __construct($uname, $pwd, $email, $status = 0, $uid = null){
        $this->userid = $uid;
		$this->username = $uname;
	    $this->pwdmd5 = md5($pwd);
	    $this->email = $email;
        $this->status = $status;
	}

	public function Save(){
		if (isset($this->userid))
            $this->Update();
        else 
            return $this->Create();        
	}

	public function Update(){
		$this->UpdatePassword();
	}
	
	public function UpdatePassword(){
        try{
            self::InitConnection();
            self::$myDB->Connection->beginTransaction();
            
            $sql = "UPDATE users SET pwdmd5 = ? WHERE email = ?";

            $stmt = self::$myDB->Connection->prepare($sql);
            $stmt->bindParam(1, md5($this->password));
            $stmt->bindParam(2, $this->userid);
            $stmt->execute();        

            self::$myDB->Connection->commit();
            
            if ($stmt->rowCount() > 0)
                return "Password successfully updated";
            else
                return "0The user does not exist or the email is incorrect";
        }
        catch(PDOException $e){
            self::$myDB->Connection->rollback();
            return "Error: " . $e->getMessage();
        }        
	}
	
    public static function UpdPwd($email, $newpwd){
        try{
            self::InitConnection();
            self::$myDB->Connection->beginTransaction();
            
            $sql = "UPDATE users SET pwdmd5 = ? WHERE email = ?";

            $stmt = self::$myDB->Connection->prepare($sql);
            $stmt->bindParam(1, md5($newpwd));
            $stmt->bindParam(2, $email);
            $stmt->execute();        

            self::$myDB->Connection->commit();
            
            if ($stmt->rowCount() > 0)
                return "Password successfully updated";
            else
                return "0The user does not exist or the email is incorrect";
        }
        catch(PDOException $e){
            self::$myDB->Connection->rollback();
            return "Error: " . $e->getMessage();
        }
	}
    
	public function Create(){
		try{
            self::InitConnection();
            self::$myDB->Connection->beginTransaction();

            $sql = "INSERT INTO users (username, pwdmd5, email) VALUES (?, ?, ?);";

            $stmt = self::$myDB->Connection->prepare($sql);
            $stmt->bindParam(1, $this->username);
            $stmt->bindParam(2, $this->pwdmd5);
            $stmt->bindParam(3, $this->email);
            $stmt->execute();        

            self::$myDB->Connection->commit();
            return "User successfully created. Please log in !";
        }
        catch(PDOException $e){
            self::$myDB->Connection->rollback();
            if ($e->errorInfo[0]==23000)
                return "0A user with such data already exists. Please log in !";
            else
                return "Error: " . $e->getMessage();
        }
	}
	
	public static function UserExists($uname, $password){
        try{
            self::InitConnection();
            $sql = "SELECT userid FROM users WHERE username = ? AND pwdmd5 = ?";

            $stmt = self::$myDB->Connection->prepare($sql);
            $stmt->bindParam(1, $uname);
            $stmt->bindParam(2, md5($password));
            $stmt->execute();  

            if ($stmt->rowCount() > 0){
                $uid = $stmt->fetch(PDO::FETCH_ASSOC);
                return $uid['userid'];
            }
            else
                return 0;
        }
        catch(PDOException $e){
            return "Error: " . $e->getMessage();
        }
	}

}

?>