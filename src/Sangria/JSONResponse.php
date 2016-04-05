<?php
/**
 *	Helper class that returns the Data in JSON format.
 *	© Gokul Srinivas 01-April-2016
 */

namespace Sangria;

use \Exception as SangriaException;

if(!defined("__SANGRIA_ROOT__"))
{
    define("__SANGRIA_ROOT__",\dirname(\dirname(\dirname(\realpath(__FILE__)))));
    require_once(__SANGRIA_ROOT__."/config.php");
}

class JSONResponse
{
	/**
	 * [response JSON string that represents the data given]
	 * @param  [type] $status_code [HTTP status code or Custom Status Code]
	 * @param  [type] $data        [description]
	 * @return [string]            [description]
	 */
	public static function response($status_code=400, $data=NULL, $strict_mode=false)
	{
		/**
		 * [$HTTP_MESSAGES Default Message Phrases for all the HTTP Status Codes]
		 * @var [array]
		 */
		$HTTP_MESSAGES = [
		"100" => "Continue",
		"101" => "Switching Protocols",
		"200" => "OK",
		"201" => "Created",
		"202" => "Accepted",
		"203" => "Non-Authoritative Information",
		"204" => "No Content",
		"205" => "Reset Content",
		"206" => "Partial Content",
		"300" => "Multiple Choices",
		"301" => "Moved Permanently",
		"302" => "Found",
		"303" => "See Other",
		"304" => "Not Modified",
		"305" => "Use Proxy",
		"307" => "Temporary Redirect",
		"400" => "Bad Request",
		"401" => "Unauthorized",
		"402" => "Payment Required",
		"403" => "Forbidden",
		"404" => "Not Found",
		"405" => "Method Not Allowed",
		"406" => "Not Acceptable",
		"407" => "Proxy Authentication Required",
		"408" => "Request Time-out",
		"409" => "Conflict",
		"410" => "Gone",
		"411" => "Length Required",
		"412" => "Precondition Failed",
		"413" => "Request Entity Too Large",
		"414" => "Request-URI Too Large",
		"415" => "Unsupported Media Type",
		"416" => "Requested range not satisfiable",
		"417" => "Expectation Failed",
		"500" => "Internal Server Error",
		"501" => "Not Implemented",
		"502" => "Bad Gateway",
		"503" => "Service Unavailable",
		"504" => "Gateway Time-out",
		"505" => "HTTP Version not supported",
		];	

		// Initialize the result array
		$json_result = array("status_code" => "400","message" => $HTTP_MESSAGES["400"]);

		try
		{
			/**
			 * Initialize the Empty array and set defaults
			 * If Key is in HTTP_MESSAGES:
			 * it is a valid HTTP status code and message is set accordingly.
			 * Else, message is an empty string.
			 *
			 * Strict Mode can and will overwrite this message
			 */
			if(\array_key_exists($status_code, $HTTP_MESSAGES))
			{
				$json_result = array("status_code" => $status_code,"message" => $HTTP_MESSAGES[$status_code]);
			}
			else
			{
				$json_result = array("status_code" => $status_code,"message" => "");
			}

			/**
			 * [$strict_mode If true, the data is blindly encoded in the message. Else if data is NULL, HTTP status message is added]
			 * @var [boolean]
			 */
			if($strict_mode == false)
			{
				/**
				 * If the user has passed some data / data is not null
				 */
				if($data != NULL)
				{
					$json_result["message"] = $data;
				}
				/**
				 * Else the default is the HTTP Message
				 * Or empty string if the status_code is not present
				 */
			}
			else
			{
				$json_result["message"] = $data;				
			}

			/**
			 * return the encoded JSON String
			 */
			return \json_encode($json_result);

		}
		catch(SangriaException $e)
		{
			/**
			 * craft a json with message as Exception message and status_code 500
			 */
			$json_result = array("status_code" => "500","message" => $HTTP_MESSAGES["500"]);
			$json_result["message"] = $e->getMessage();
			/**
			 * return the encoded JSON String
			 */
			return \json_encode($json_result);
		}
	}
	
}
?>