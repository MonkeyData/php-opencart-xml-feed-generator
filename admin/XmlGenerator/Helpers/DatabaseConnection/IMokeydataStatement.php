<?php
/**
 * Created by PhpStorm.
 * User: tomw
 * Date: 2/6/17
 * Time: 2:05 PM
 */

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection;


interface IMokeydataStatement {

    public function fetchAll();

    public function fetchObject();

    public function fetch();

}