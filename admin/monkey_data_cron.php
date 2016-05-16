<?php

error_reporting(0);

if (!is_null($_GET['debug'])) {
	error_reporting(E_ALL);
}

/*
 * custom loader
 */
spl_autoload_register(function($className) {
     
    $className = str_replace("MonkeyData\\EshopXmlFeedGenerator\\", "", $className);
    
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    
    include_once $className . ".php";
    }
);
require_once __DIR__ . '/../config.php';
define("DEBUG", TRUE);

$pattern = "/define\(\'VERSION\', \'(.*)\'\);/i";
$matches = array();
preg_match($pattern, file_get_contents(__DIR__."/../index.php"), $matches);

if (empty($matches[1])) {
    Error('ERROR OC VERSION IS MISSING', 'd');
}

defined('VERSION') || define('VERSION', $matches[1]);


require_once __DIR__ . '/MonkeyDataXmlModel.php';
require_once __DIR__ . '/MonkeyDataExampleXmlGenerator.php';

try{
    $xmlGenerator = new MonkeyDataExampleXmlGenerator();
    $xmlGenerator->run();
}catch(Exception $e){
    echo "<pre>";
    var_dump($e);
}
