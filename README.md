# CLI Session Class
This library provides an command line & object-oriented version of the php standard session management.
Inside the wrapper it uses the default php session_*-commands

If you have questions or problems with installation or usage [create an Issue](https://github.com/InsulinJunkieDe/CliSession/issues).

## Installation

In order to install this library via composer run the following command in the console:

```sh
composer require insulinjunkiede/clisession
```

or add the package manually to your composer.json file in the require section:

```json
"insulinjunkiede/clisession": "dev-master"
```

## Usage examples

```php
$session = new InsulinJunkieDe\CliSession\Session('.session', __DIR__);
/*
When creating a new session, the first parameter takes the file name and the 2nd
one the directory where is file should be written to.
Both an be omitted, but it won't work, since PHP is generating a new
session_id(and filename) each time you restart your CLI script.
So the first paramater is kind of mandatory, when you want to reuse the
session-content in the next CLI-call
*/
$session->setParam('key','value');
$session->getParam('key');
```

