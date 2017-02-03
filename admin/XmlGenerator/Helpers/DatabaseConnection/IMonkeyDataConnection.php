<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection;

/**
 * Created by PhpStorm.
 * User: Samot
 * Date: 03.02.2017
 * Time: 15:37
 */
interface IMonkeyDataConnection
{
    public function __construct($dbconfig);

    /**
     * execute SQL query
     * @param string $query SQL query
     * @return array
     */
    public function query($query);
}