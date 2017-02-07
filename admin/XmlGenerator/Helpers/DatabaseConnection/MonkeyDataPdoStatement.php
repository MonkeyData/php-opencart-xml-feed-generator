<?php
/**
 * Created by PhpStorm.
 * User: tomw
 * Date: 2/6/17
 * Time: 2:07 PM
 */

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\DatabaseConnection;


class MonkeyDataPdoStatement implements IMonkeyDataStatement {

    /**
     * @var \PDOStatement
     */
    private $statement;

    /**
     * MonkeydataPdoStatement constructor.
     */
    public function __construct($statement) {
        $this->statement = $statement;
    }

    public function fetchAll() {
        if(!$this->statement){
            return array();
        }
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchObject() {
        if(!$this->statement){
            return null;
        }
        return $this->statement->fetchObject();
    }

    public function fetch() {
        if(!$this->statement){
            return null;
        }
        return $this->statement->fetch();
    }




}

