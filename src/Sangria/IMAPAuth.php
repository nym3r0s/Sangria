<?php
/**
 *  Helper class that helps authenticate a user with an IMAP server.
 *  © Gokul Srinivas 01-April-2016
 */

namespace Sangria;

use \Exception as SangriaException;

if(!defined("__SANGRIA_ROOT__"))
{
    define("__SANGRIA_ROOT__",\dirname(\dirname(\dirname(\realpath(__FILE__)))));
    require_once(__SANGRIA_ROOT__."/config.php");
}

class IMAPAuth
{
    /**
     * [tauth Tries to authenticate by telnet]
     * @param  string $user_name [User name]
     * @param  string $user_pass [Password]
     * @return boolean           [true if authenticated, false otherwise]
     */
    public static function tauth($user_name, $user_pass)
    {

        $imap_server_address=__SANGRIA_IMAP_SERVER_ADDR__;
        $imap_port=__SANGRIA_IMAP_SERVER_PORT__;

        try
        {
            $imap_stream = \fsockopen($imap_server_address,$imap_port);
            if ( !$imap_stream )
            {
                return false;
            }

            $server_info = \fgets ($imap_stream, 1024);
            $query = 'b221 ' .  'LOGIN "' . $user_name .  '" "'  .$user_pass . "\"\r\n";
            $read = \fputs ($imap_stream, $query);
            $response = \fgets ($imap_stream, 1024);

            $query = 'b222 ' . 'LOGOUT';
            $read = \fputs ($imap_stream, $query);
            \fclose($imap_stream);
            \strtok($response, " ");
            $result = \strtok(" ");

            if($result == "OK")
                return true;
            else
                return false;


        }
        catch(SangriaException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * [auth Authentication via]
     * @param  string  $user_name    [username]
     * @param  string  $user_pass    [password]
     * @param  string  $imap_option  [options as given in php.net]
     * @param  integer $imap_retries [number of retries]
     * @return boolean               [true if authenticated, false otherwise]
     */
    public static function auth($user_name,$user_pass,$imap_option = "/imap/ssl/novalidate-cert",$imap_retries = 0)
    {

        $imap_server_address = __SANGRIA_IMAP_SERVER_ADDR__;
        $imap_port = __SANGRIA_IMAP_SERVER_PORT__;

        try
        {
            $mbox = \imap_open("{".$imap_server_address.":".$imap_port.$imap_option."}", $user_name, $user_pass,0,$imap_retries);

            if($mbox)
            {
                \imap_close($mbox);
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(SangriaException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
}
