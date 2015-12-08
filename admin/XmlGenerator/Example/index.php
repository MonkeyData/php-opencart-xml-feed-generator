<?php

require_once __DIR__ . '/../Config/conf.php';
require_once __DIR__ . "/MonkeyDataXmlModel.php";
require_once __DIR__ . '/MonkeyDataExampleXmlGenerator.php';


$xmlGenerator = new MonkeyDataExample\MonkeyDataExampleXmlGenerator();
$xmlGenerator->run();