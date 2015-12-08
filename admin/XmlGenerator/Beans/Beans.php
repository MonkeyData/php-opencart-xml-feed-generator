<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMissingInputException;
use ReflectionObject;
use ReflectionProperty;


/**
 * Class Beans
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Beans
 * @author MD Developers
 */
class Beans {

    /**
     * @var int|null
     */
    protected $id = null;

    /**
     * @var array
     */
    private $notRequired = array();

    /**
     * @param array|null $data
     */
    public function __construct($data = null) {
        if(!is_null($data)) {
            foreach($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return int|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Beans $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $param
     * @return mixed
     */
    public function __get($param) {
        return $this->$param;
    }

    /**
     * @throws MonkeyDataMissingInputException
     */
    public function validate() {
        $sourceReflection = new ReflectionObject($this);
        $sourceProperties = $sourceReflection->getProperties(ReflectionProperty::IS_PROTECTED);
        foreach ($sourceProperties as $sourceProperty) {
            $key = $sourceProperty->getName();
            if(is_null($this->$key) AND !in_array($key,$this->notRequired)) {
                throw new MonkeyDataMissingInputException($key);
            }
            $entityName = $this->prepareEntityName($key);
            $ent = new $entityName($this->$key);
            $ent->validateValue();
        }
    }

    /**
     * @param string $name
     * @return string
     */
    private function prepareEntityName($name) {
        $words = explode("_", $name);
        $out = "MonkeyData\\EshopXmlFeedGenerator\\XmlGenerator\\Entities\\";
        foreach($words as $word)  {
            $out .= ucfirst($word);
        }
        $out .= "Entity";
        return $out;
    }
}
