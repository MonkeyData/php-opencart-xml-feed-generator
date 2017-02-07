<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection\IMonkeyDataConnection;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection\MonkeyDataMysqli;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection\MonkeyDataPDO;


/**
 * Class MonkeyDataDbHelper
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers
 * @author MD Developers
 */
class MonkeyDataDbHelper {

    /**
     * @var IMonkeyDataConnection
     */
    private $connection;

    /**
     * @var mixed
     */
    protected static $instance = null;
    
    public function __construct($dbconfig) {
        if(class_exists("PDO")) {
            $this->connection = new MonkeyDataPDO($dbconfig);
        }else{
            $this->connection = new MonkeyDataMysqli($dbconfig);
        }

    }
    
    /**
     * execute SQL query
     * @param string $query SQL query
     * @return array
     */
    public function query($query){
         return $this->connection->query($query);
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
