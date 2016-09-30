<?php

require_once 'DBConnector.php';

/** 
* Model class for users table
*  
* @author alex(answer3ster@gmail.com) 
* @version 1.0 
* @since 2016-09-30 
*/

class Model{
	
	private $table = 'users';
	private $db;
	
	/** 
	* Construct
	*   
	* @return void
	*/
	public function __construct() {
		$this->db = DBConnector::getInstance();
		$this->db->table = $this->table;
	}
	
	/** 
	* Insert data to table
	* 
	* @param array  
	* @return void
	*/
	public function insert($data){
		$this->db->insert($data);
	}
	
	/** 
	* Get all records from table
	*   
	* @return array
	*/
	public function getAll(){
		return $this->db->fetchAll();
	}
	
}

