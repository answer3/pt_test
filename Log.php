<?php

/** 
* Log file class
*  
* @author alex(answer3ster@gmail.com) 
* @version 1.0 
* @since 2016-09-30 
*/

class Log{
	
	/** 
	* Write info to log file
	*   
	* @param string
	* @return @void
	*/
	public static function saveToLog($message){
		file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR.'error.log',date('Y-m-d H:i:s').' :: '.$message."\n",FILE_APPEND);
	}
}

