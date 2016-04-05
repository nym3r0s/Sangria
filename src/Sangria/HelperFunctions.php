<?php
namespace Sangria;

use \Exception as SangriaException;

/**
 *  Helper class that helps authenticate a user with an IMAP server.
 *  © Gokul Srinivas 01-April-2016
 */
 
class HelperFunctions
{
	/**
	 * [dd dumps the variable and stops execution]
	 * @param  mixed $obj [the variable to be dumped]
	 * @return void      [returns nothing]
	 */
	public function dd($obj = NULL)
	{
		var_dump($obj);
		die();
	}
	/**
	 * [ddp prints the json_encoded form of the variable and stops execution]
	 * @param  mixed $obj [the variable to be dumped]
	 * @return void      [returns nothing]
	 */
	public function ddp($obj = NULL)
	{
		try
		{
			$json_str = json_encode($obj, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
			echo $json_str;
			die();
		}
		catch(SangriaException $e)
		{
			/**
			 * Default to dd if there is an exception while encoding to JSON
			 */
			var_dump($obj);
			die();	
		}
	}

	/**
	 * [isEmail Validates whether a string is an email as per RFC 5322]
	 * @param  string  $email_str [Email ID as a string]
	 * @return boolean            [true if the string is an email, false otherwise]
	 */
	public function isEmail($email_str = NULL)
	{
		/**
		 * Check if not null and matches regex
		 */
		if($email_str && filter_var($email_str, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		/**
		 * Not an email address as defined by RFC 5322
		 */
		return false;
	}
}