<?php

/** 
* API validator class
*  
* @author alex(answer3ster@gmail.com) 
* @version 1.0 
* @since 2016-09-30 
*/

class ApiValidation
{	
	private $_request;
	public $validationErrors = [];
	
	
	/** 
	* Constructor
	*  
	* @param Request 
	* @return void 
	*/
	public function __construct(Request $request) {
		$this->_request = $request;
	}
	
	/** 
	* Api validation checker
	*   
	* @return bool 
	*/
	public function isValid(){
		$response = $this->_request->doRequest(); 
		if($response['success'] === 'false'){
			$this->validationErrors = $response['error'];
			return false;
		}
		return true;
	}
}

