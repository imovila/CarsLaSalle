<?php 
require_once "dbdata.php";

class Car extends Dbdata{
	private $caid;
	private $make;
	private $model;
	private $status;
	private $year;
	private $body;
	private $engine;
	private $drivertrain;
    private $transmission;
    private $fuel;
    private $mileage;
    private $doors;
    private $seats;
    private $incolor;
    private $outcolor;
    private $price;
    private $oldprice;
	
	function __construct($make, $model, $status, $year, $body, $engine, $drivertrain, $transmission,
                         $fuel, $mileage, $doors, $seats, $incolor, $outcolor, $price, $oldprice, $id = null){
		$this->carid = $id;
        $this->make = $make;
        $this->model = $model;
        $this->status = $status;
        $this->year = $year;
        $this->body = $body;
        $this->engine = $engine;
        $this->drivertrain = $drivertrain;
        $this->transmission = $transmission;
        $this->fuel = $fuel;
        $this->mileage = $mileage;
        $this->doors = $doors;
        $this->seats = $seats;
        $this->incolor = $incolor;
        $this->outcolor = $outcolor;
        $this->price = $price;
        $this->oldprice = $oldprice;
	}
    
	public static function ReadCars(){
        return self::QueryAll("SELECT * FROM cars;");
	}
    
    public static function ReadCar($carid){
        return self::QueryAll("SELECT * FROM cars where carid = $carid");
	}
  
    public static function ReadRecentlyCars(){
        return self::QueryAll("SELECT * FROM cars ORDER BY carid DESC LIMIT 10;");
	}
    
    public static function ReadCarWithCriteria($criteria){
        return self::QueryAll( "SELECT * FROM cars where ".$criteria);
	}
    
    public static function ReadPics($carid){
        return self::QueryAll("SELECT * FROM carpics WHERE carid = $carid;");
	}
    
    public static function ReadPic($carid){
        return self::QueryAll("SELECT pic FROM carpics WHERE carid = $carid LIMIT 1;", false)["pic"];
	}
	
}
?>