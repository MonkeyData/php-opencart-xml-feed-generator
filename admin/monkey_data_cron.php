<?php

/*
 * custom loader
 */
spl_autoload_register(function($className) {
     
    $className = str_replace("MonkeyData\\EshopXmlFeedGenerator\\", "", $className);
    
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    
    include_once $className . ".php";
    }
);

require_once __DIR__ . '/MonkeyDataXmlModel.php';
require_once __DIR__ . '/MonkeyDataExampleXmlGenerator.php';

$xmlGenerator = new MonkeyDataExampleXmlGenerator();
$xmlGenerator->run();
