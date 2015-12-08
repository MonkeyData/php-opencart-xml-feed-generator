<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers;

use PDO;


/**
 * Class MonkeyDataDbHelper
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers
 * @author MD Developers
 */
class MonkeyDataDbHelper {

    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var mixed
     */
    protected static $instance = null;
    
    public function __construct($dbconfig) {
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        $this->connection = @new PDO("mysql:host=" . $dbconfig['host'] . ";dbname=" . $dbconfig['name'], $dbconfig['user'], $dbconfig['pass'], $options);
    }
    
    /**
     * execute SQL query
     * @param string $query SQL query
     * @return array
     */
    public function query($query){
         return $this->connection->query($query, PDO::FETCH_ASSOC);
    }
    
    /**
     *
     * @return MonkeyDataDbHelper
     */
    public static function getInstance($dbConfig) {
        if (static::$instance == null) {
            $name = get_called_class();
            static::$instance = new $name($dbConfig);
        }
        return static::$instance;
    }

}
