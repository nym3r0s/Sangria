<?php

use Sangria\JSONResponse;

class JSONResponseTest extends PHPUnit_Framework_TestCase
{
	public function testHttpMessageCheck()
	{
		$status_code = 200;
		$message = "";

		$test_response_string = JSONResponse::response($status_code);
		$correct_response_string = '{"status_code":200,"message":"OK"}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testNonHttpMessageCheck()
	{
		$status_code = 3;
		$message = "";

		$test_response_string = JSONResponse::response($status_code);
		$correct_response_string = '{"status_code":3,"message":""}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testStrictModeCheck()
	{
		$status_code = 200;
		$message = NULL;

		$test_response_string = JSONResponse::response($status_code,$message,true);
		$correct_response_string = '{"status_code":200,"message":null}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testNoStrictModeCheck()
	{
		$status_code = 200;
		$message = NULL;

		$test_response_string = JSONResponse::response($status_code,$message,false);
		$correct_response_string = '{"status_code":200,"message":"OK"}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testArrayCheck()
	{
		$status_code = 200;
		$message = array("abc","def",1,23,true);

		$test_response_string = JSONResponse::response($status_code,$message);
		$correct_response_string = '{"status_code":200,"message":["abc","def",1,23,true]}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testNestedArrayCheck()
	{
		$status_code = 200;
		$message = array("abc",array("nest1","nest2"),"def",array("asdf",array("asdfasdf",array("test2"))));

		$test_response_string = JSONResponse::response($status_code,$message);
		$correct_response_string = '{"status_code":200,"message":["abc",["nest1","nest2"],"def",["asdf",["asdfasdf",["test2"]]]]}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testObjectCheck()
	{
		$status_code = 200;
		$message = new StdClass();
		$message->prop1 = "asdf";
		$message->prop2 = array("asdf");
		$message->prop3 = array(array("asdf"));
		$message->prop4 = true;

		$test_response_string = JSONResponse::response($status_code,$message);
		$correct_response_string = '{"status_code":200,"message":{"prop1":"asdf","prop2":["asdf"],"prop3":[["asdf"]],"prop4":true}}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testStringCheck()
	{
		$status_code = 200;
		$message = "Hello from Sangria.";

		$test_response_string = JSONResponse::response($status_code,$message);
		$correct_response_string = '{"status_code":200,"message":"Hello from Sangria."}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
	public function testBooleanCheck()
	{
		$status_code = 200;
		$message = true;

		$test_response_string = JSONResponse::response($status_code,$message);
		$correct_response_string = '{"status_code":200,"message":true}';
		
		$this->assertEquals($test_response_string, $correct_response_string);
	}
}
