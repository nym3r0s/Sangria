<?php
namespace Sangria;

use \Exception as SangriaException;

/**
 *  Helper class that helps authenticate a user with an IMAP server.
 *  © Gokul Srinivas 01-April-2016
 */

if(!defined("__SANGRIA_ROOT__"))
{
    define("__SANGRIA_ROOT__",\dirname(\dirname(\dirname(\realpath(__FILE__)))));
    require_once(__SANGRIA_ROOT__."/config.php");
}

class LDAPAuth
{
	/**
	 * [auth Tries to authenticate a user with an LDAP server]
	 * @param  string $user_name [username]
	 * @param  string $user_pass [password]
	 * @return boolean           [true if authenticated, false if not]
	 */
	public static function auth($user_name, $user_pass)
	{
		try
		{
			$ldap_server_address = __SANGRIA_LDAP_SERVER_ADDR__;
			
			$ldapconn = \ldap_connect($ldap_server_address) 
			or $this->throwException("Could not connect to LDAP Server");

			\ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
			\ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

			$ldapbind = @ldap_bind($ldapconn,$user_name,$user_pass);

			if($ldapbind)
			{
				return true;       
			} 
			return false;
		}
		catch(SangriaException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	private function throwException($message="")
	{
		throw new SangriaException($message);		
	}
}