# Sangria [![Build Status](https://travis-ci.org/GokulSrinivas/Sangria.svg?branch=master)](https://travis-ci.org/GokulSrinivas/Sangria) [![license](http://img.shields.io/badge/license-MIT-red.svg?style=flat)](https://github.com/GokulSrinivas/Sangria/blob/master/LICENSE.md)

A Set of lightweight PHP libraries to make your life easier.

**FAQ:** Why the name Sangria?

**Ans:** Because I like [this](https://www.youtube.com/watch?v=KoQrH6EMnas) song and I like to drink/eat [fruits](https://en.wikipedia.org/wiki/Sangria).

## Installation

* Require `gokulsrinivas/sangria` in your `composer.json`. 
* Do a `composer install`
* If you're not using this in a framework like laravel, be sure to `include "vendor/autoload.php"` in your file. `vendor` is the folder that is created after the composer install.
* `use Sangria\JSONResponse` / `IMAPAuth` / `LDAPAuth` / `HelperFunctions`
* See usage below.
* Write cleaner code.
* Feel Awesome.
* Build cool stuff.
* Happy coding!

## Usage

### `Sangria\JSONResponse`
-----------------------------------------

This class is helpful to API Developers who need to return JSON representations
of strings, objects, collections etc.

This class follows the following JSON structure.

```json
{
  "status_code": 200,
  "message": "OK"
}
```

* Include the class with `use Sangria\JSONResponse;`
* Definition `JSONResponse::response($status_code=400,$message=NULL,$strict_mode=false)`
* The `$status_code` can be HTTP status codes or your own custom status codes.
* If the `$status_code` is a HTTP status code and the message is `NULL`, a default
	  [reason phrase](https://www.w3.org/Protocols/rfc2616/rfc2616-sec6.html) is added. (If `$strict_mode` is `false` (default) )
* If the `$strict_mode` is set to `true`, the data given as `$message` is encoded.
	  So, `NULL` is encoded as `null`.
* The `$status_code` defaults to 400. 
* `Sangria\JSONResponse` can be safely used in Laravel as all eloquent models and collections can be passed as `$message`.

**Sample Code**
```php
<?php

use Sangria\JSONResponse;

$status_code = 200;
$message = new StdClass();
$message->prop1 = "asdf";
$message->prop2 = array("asdf");
$message->prop3 = array(array("asdf"));
$message->prop4 = true;

$response_string = JSONResponse::response($status_code,$message);
echo $response_string;
```
**Output**
```json
{
  "status_code": 200,
  "message": {
    "prop1": "asdf",
    "prop2": [
      "asdf"
    ],
    "prop3": [
      [
        "asdf"
      ]
    ],
    "prop4": true
  }
}
```

----------------------------------
### `Sangria\IMAPAuth`
----------------------------------
This class is useful for developers who just need to authenticate a username/password combo via IMAP.

* Include the class with `use Sangria\IMAPAuth;`
* Definition `IMAPAuth::auth($user_name,$user_pass,$imap_option="/imap/ssl/novalidate-cert",$imap_retries=0)`
* The `$imap_option` is a string beginning with `/` listed as **Optional flags for names** as given in the [page for imap on php.net](http://php.net/manual/en/function.imap-open.php).
* If the `$imap_retries` is the number of retries.

**Configuration**

* Please set the `__SANGRIA_IMAP_SERVER_ADDR__` and `__SANGRIA_IMAP_SERVER_PORT__` to the desired address and port in `config.php` in `vendor/gokulsrinivas/sangria` if installed via composer.

**Sample Code**
```php
<?php

use Sangria\IMAPAuth;

if(IMAPAuth::auth('username','********'))
{
	echo "Authenticated";
}
else
{
	echo "Authentication Failed";
}
```
**Output**
```
Authenticated
```

----------------------------------
### `Sangria\LDAPAuth`
----------------------------------
This class is useful for developers who just need to authenticate a username/password combo via LDAP.

* Include the class with `use Sangria\LDAPAuth;`
* Definition `LDAPAuth::auth($user_name,$user_pass)`

**Configuration**

* Please set the `__SANGRIA_LDAP_SERVER_ADDR__` to the desired address in `config.php` in `vendor/gokulsrinivas/sangria` if installed via composer.

**Sample Code**
```php
<?php

use Sangria\LDAPAuth;

if(LDAPAuth::auth('username','********'))
{
	echo "Authenticated";
}
else
{
	echo "Authentication Failed";
}
```
**Output**
```
Authenticated
```

---------------------------------------------
### `Sangria\HelperFunctions`
---------------------------------------------

This class is helpful for development and debugging. This includes `dd()`, `ddp()` and `isEmail()` functions to speed up your development.

#### * `dd()`

While debugging, you might need to `var_dump()` the variable and `die()`. This function helps you to do just that. 

**Source Code**
```php
<?php
use Sangria\HelperFunctions;

$a = 4*"2";
Helperfunctions::dd($a);
echo "done";
```
**Output**
```
int(8)
```
#### * `ddp()`

While debugging, you might need to `var_dump()` the variable and `die()`. If your objects are complex or if you want to use the dumped data in javascript, you might need it in JSON format. This function helps you to do just that.

**Source Code**
```php
<?php
use Sangria\HelperFunctions;

$a = new StdClass();

$a->name = "Hello";
$a->surname = "World";
$a->nicknames = ["Hi",["My","Name","Is"],"Sangria"];
$a->adult = true;
$a->balance = 2334.34;
$a->age = 19;

Helperfunctions::ddp($a);
echo "done";
```
**Output**
```
{
    "name": "Hello",
    "surname": "World",
    "nicknames": [
        "Hi",
        [
            "My",
            "Name",
            "Is"
        ],
        "Sangria"
    ],
    "adult": true,
    "balance": 2334.34,
    "age": 19
}
```

#### * `isEmail()`

This function is useful to check whether a given string is a valid email.

**Source Code**
```php
<?php
use Sangria\HelperFunctions;

$email_string = "hi    @hi.com";

if(Helperfunctions::isEmail($email_string))
{
	echo "Valid Email";
}
else
{
	echo "Invalid Email";
}
```
**Output**
```
Invalid Email
```

### Contribute

There can never be enough tests. Feel free to write more test cases!

If you want to add features, improve them, or report issues, feel free to send a pull request! Please include tests for new features.

### Contributors

[Gokul Srinivas](https://github.com/GokulSrinivas)

### License

[MIT](https://github.com/GokulSrinivas/Sangria/blob/master/LICENSE.md)