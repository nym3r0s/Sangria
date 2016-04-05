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
		if($email_str && preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email_str))
		{
			return true;
		}
		/**
		 * Not an email address as defined by RFC 5322
		 */
		return false;
	}
}