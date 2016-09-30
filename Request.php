<?php

require_once 'Log.php';
require_once 'config.php';

/** 
* CURL request class
*  
* @author alex(answer3ster@gmail.com) 
* @version 1.0 
* @since 2016-09-30 
*/

class Request{
	const URL_TPL		= 'https://interview.performance-technologies.de/api/address?token=';
	
	private $_data;
	public $error		= false;
	public $response	= false;

	/** 
	* Construct
	*   
	* @param array
	* @return void 
	*/	
	public function __construct($data) {
		$this->_data = $data;
	}
	
	/** 
	* Create and return curl object(resource)
	*   
	* @return resource 
	*/
	private function getCurlObject(){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->getUrl());
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		
		return $curl;
	}
	
	/** 
	* Get url for curl request
	*   
	* @return string 
	*/
	private function getUrl(){
		return self::URL_TPL . API_TOKEN . '&' . $this->getParamString();
	}
	
	/** 
	* Get url param string for curl url
	*   
	* @return string 
	*/
	private function getParamString(){
		return http_build_query($this->_data);
	}
	
	/** 
	* Send Get request
	*   
	* @exceprtion Exception
	* @return array 
	*/
	public function doRequest(){
		$curl = $this->getCurlObject();
		$output = curl_exec($curl);
		
		if (curl_errno($curl)) {
			Log::saveToLog('Curl Error Number - '.curl_errno($curl));
			throw new Exception('Internal Error3. Please try again later');
		}
		curl_close($curl);
		if(!$output){
			Log::saveToLog('Response from remote server is Empty');
			throw new Exception('Internal Error2. Please try again later');
		}
		$decodedOutput = json_decode($output,true);
		if(!$decodedOutput){
			Log::saveToLog('Incorrect response. Response - '.  print_r($output,true));
			throw new Exception('Internal Error1. Please try again later');
		}
		
		return $decodedOutput;
	}
		
}

