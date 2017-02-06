<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection;

use \mysqli;
/**
 * Created by PhpStorm.
 * User: Samot
 * Date: 03.02.2017
 * Time: 15:39
 */
class MonkeydataMysqli implements IMonkeyDataConnection
{

    /**
     * @var mysqli
     */
    private $connection;

    public function __construct($dbconfig) {
//        $options = array(
//            PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
//            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
//        );
        // $this->connection = @new PDO("mysql:host=" . $dbconfig['host'] . ";dbname=" . $dbconfig['name'], $dbconfig['user'], $dbconfig['pass'], $options);

        $this->connection = new \mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['pass'], $dbconfig['name']);
        $this->connection->set_charset("utf8");
    }

    /**
     * execute SQL query
     * @param string $query SQL query
     * @return array
     */
    public function query($query){
        $result = $this->connection->query($query);
        return new MonkeydataMysqliStatement($result);
    }


}