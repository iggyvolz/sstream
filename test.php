<?php

use iggyvolz\sstream\HtmlStringStream;
use iggyvolz\sstream\HtmlCode;
use ZEngine\Core;

require_once __DIR__ . "/vendor/autoload.php";
Core::init();
(new \ZEngine\Reflection\ReflectionClass(HtmlStringStream::class))->installExtensionHandlers();


echo (new HtmlStringStream()) << new HtmlCode("<p>") << "Hello world!  This is not a script: <script>alert('oops!');</script>" << new HtmlCode("</p>");