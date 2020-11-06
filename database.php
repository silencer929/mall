<?php
require_once "define.php";
class database
{
	private $dbname="";
	private $server="";
	private $username="";
	private $password="";
	private $dbOpen="";
	public ?object $pdo;
	private ?object $stmt;
	private array $data=[];
	private int $rows=0;
	public static $instance;

	private function __construct()
	{
		$this->server=server;
		$this->username=username;
		$this->password=password;
		$this->dbname=db;
	}
	public static function getInstance()
	{
		try {
			if(!self::$instance){
			self::$instance= new database();
		}
		else{
			throw new Exception("another instance is already running");
		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	public function execQuery($query,$arr=[])
	{
		$options=array(
			PDO::ATTR_PERSISTENT=>true,
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
		);
		try {
			$this->pdo= new PDO("mysql:host=$this->server;dbname=$this->dbname",$this->username,$this->password,$options);
			$this->stmt=$this->pdo->prepare($query);
			foreach ($arr as $key => &$value) {
				$this->stmt->bindparam($key,$value);
			}
			$this->stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	//--------function to retrieve data from a table in a databse;---------------
	public function load_data()
	{
		$data=[];
		if($this->stmt){
			$this->rows= $this->stmt->rowCount();
		}
		if($this->rows < 1){
			return [];
		}
		if($this->rows == 1){
			$data[0]=$this->stmt->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		if($this->rows > 1){
			$data=$this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}
	public function getRows() :int
	{
		return $this->rows;
	}
	public function fetchObject($entity=""):array
	{
		$this->stmt->setFetchMode(PDO::FETCH_CLASS,$entity);
		 return $this->stmt->fetchAll();
	}
    
}
 ?>
