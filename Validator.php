<?php

include_once 'ApiValidation.php';
include_once 'Request.php';

/** 
* POST data validator class
*  
* @author alex(answer3ster@gmail.com) 
* @version 1.0 
* @since 2016-09-30 
*/

class Validator{
	
	private $_rules	=	[
							'first_name'	=> ['filter' => FILTER_SANITIZE_STRING,'flag'=> FILTER_FLAG_STRIP_HIGH],
							'last_name'		=> ['filter' => FILTER_SANITIZE_STRING,'flag'=> FILTER_FLAG_STRIP_HIGH],
							'street'		=> ['filter' => FILTER_SANITIZE_STRING,'flag'=> FILTER_FLAG_STRIP_HIGH],
							'postal'		=> ['filter' => FILTER_SANITIZE_STRING,'flag'=> FILTER_FLAG_STRIP_HIGH],
							'city'			=> ['filter' => FILTER_SANITIZE_STRING,'flag'=> FILTER_FLAG_STRIP_HIGH],
							'country'		=> ['filter' => FILTER_SANITIZE_STRING,'flag'=> FILTER_FLAG_STRIP_HIGH]
						];
	
	public $filteredData = [];
	
	public $validationErrors = [];
	
	public $validationResult;
	
	/** 
	* Construct
	*   
	* @return void 
	*/
	public function __construct() {
		$this->filteredData = filter_input_array(INPUT_POST, $this->_rules);
	}
	
	/** 
	* Validation for local(non api) fields - First Name and Last Name
	* 
	* @return bool
	*/
	private function isValidLocalFields(){
		$result = true;
		if(!isset($this->filteredData['first_name']) or empty($this->filteredData['first_name'])){
			$this->validationErrors['first_name'][] = "The first name field is required";
			$result = false;
		}
		if(!isset($this->filteredData['last_name']) or empty($this->filteredData['last_name'])){
			$this->validationErrors['last_name'][] = "The last name field is required";
			$result = false;
		}
		return $result;
	}
	
	/** 
	* Validation for api and local fields
	*   
	* @return bool 
	*/
	public function isValid(){
		$isValidLocal = $this->isValidLocalFields();
		$apiValidator = new ApiValidation(new Request($this->filteredData));
		
		$isValidApi = $apiValidator->isValid();
		if(!$isValidApi){
			$this->validationErrors = array_merge($this->validationErrors,$apiValidator->validationErrors);
		}
		
		return $isValidLocal && $isValidApi;
	}
}

