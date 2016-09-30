<?php

require_once 'config.php';

/** 
* PDO class(Singletone)
*  
* @author alex(answer3ster@gmail.com) 
* @version 1.0 
* @since 2016-09-30 
*/

class DBConnector{
	
	private static $_instance = null;
	private $_pdo;
	public $table;
	
	/** 
	* Instance method
	*   
	* @return DBConnector
	*/
	public static function getInstance(){
		if(is_null(self::$_instance)){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/** 
	* Construct
	*   
	* @return void
	*/
	private function __construct() {
		$dsn = DB_ENGINE . ":host=" . DB_HOST .";dbname=" . DB_NAME;
		$opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
		$this->_pdo = new PDO($dsn, DB_USER, DB_PASS,$opt);
	}
	
	private function __clone() {
		
	}
	
	/** 
	* Insert data
	*  
	* @param array 
	* @return void
	*/
	public function insert($data){
		$sql = "INSERT INTO " . $this->table . " SET " . $this->pdoSet($data); 
		$stm = $this->_pdo->prepare($sql); 
		$stm->execute($data);
	}
	
	/** 
	* Prepare "where" clause string for "update" query 
	* 
	* @param array  
	* @return string
	*/
	private function pdoSet($data) { 
		$set = '';  
		foreach ($data as $field=>$value) {  
			$set.= "`" . str_replace("`","``",$field) . "`" . "=:$field, "; 
		} 	 
		return substr($set, 0, -2); 
	}
	
	/** 
	* Fetch all records from table as assoc array
	*   
	* @return array
	*/
	public function fetchAll(){
		return $this->_pdo->query('SELECT * FROM ' . $this->table)->fetchAll(PDO::FETCH_UNIQUE);
	}
	
	
}

