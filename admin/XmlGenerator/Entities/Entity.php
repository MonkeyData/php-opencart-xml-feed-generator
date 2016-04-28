<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;

use Exception;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers\ValidatorHelper;


/**
 * Class Entity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
abstract class Entity {

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var bool
     */
    private $required = false;

    /**
     * @var string
     */
    private $datatype = ValidatorHelper::DT_string;

    /**
     * @var int
     */
    private $maxlength = 255;

    /**
     * @var string
     */
    private $xmlname = "ERROR";

    /**
     *
     * @var array
     */
    private $items = array();
    
    const DT_int = "int";
    const DT_float = "float";
    const DT_number = "number";
    const DT_string = "string";
    const DT_boolean = "boolean";
    const DT_datetime = "datetime";
    const DT_list = "list";

    const RequeredYes = true;
    const RequeredNo = false;

    /**
     * @param string $xmlName
     * @param string $dataType
     * @param mixed $value
     */
    public function __construct($xmlName, $dataType, $value = null) {
        $this->setting();
        $this->setXmlName($xmlName);
        $this->setDataType($dataType);
        $this->setValue($value);
        $this->repairNumbers();
    }

    public function validateValue() {
        $validator = new ValidatorHelper($this->required, $this->datatype, $this->maxlength);
        $validator->validate($this->value);
    }

    abstract protected function setting();
    
    private function repairNumbers() {
        switch ($this->datatype) {
            case self::DT_int:
                $this->value = (int)$this->value;
                break;
            case self::DT_float:
                $this->value = (float)$this->value;
                break;
        }
    }

    /**
     * @param $item
     * @throws Exception
     */
    public function addItem($item) {
        if ($this->datatype != self::DT_list) {
            throw new Exception("Yout can't add another entity to {$this->datatype} entity.");
        }
        if (!($item instanceof Entity)) {
            throw new Exception("Unexpected Entity");
        }
        $this->items[] = $item;
    }

    /**
     * @return mixed|null
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString() {
        $return = "";
        if ($this->datatype != self::DT_list) {
            if ($this->datatype == self::DT_string){
                $return = "<{$this->xmlname}><![CDATA[{$this->value}]]></{$this->xmlname}>";
            } else {
                $return = "<{$this->xmlname}>{$this->value}</{$this->xmlname}>";
            }
        } elseif (!empty($this->items)) {
            $itemString = "";
            foreach ($this->items as $item){
                $itemString .= $item->__toString();
            }
            $return = "<{$this->xmlname}>{$itemString}</{$this->xmlname}>";
        }
        return $return;
    }

    /**
     * @return string
     */
    public function getStartTag() {
        return "<{$this->xmlname}>";
    }

    /**
     * @return string
     */
    public function getEndTag() {
        return "</{$this->xmlname}>";
    }

    /**
     * @param bool $required
     */
    protected function setRequired($required) {
        $this->required = $required;
    }

    /**
     * @param string $dataType
     */
    protected function setDataType($dataType) {
        $this->datatype = $dataType;
    }

    /**
     * @param int $max
     */
    protected function setMaxLength($max) {
        $this->maxlength = $max;
    }

    /**
     * @param string $name
     */
    protected function setXmlName($name) {
        $this->xmlname = $name;
    }
    
    private function setValue($value) {
        $this->value = strip_tags($value);
    }
}
