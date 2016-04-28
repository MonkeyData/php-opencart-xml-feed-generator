<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers;

use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataEmptyValueException;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataMaxLengthException;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Exceptions\MonkeyDataTypeExpectedException;


/**
 * Class ValidatorHelper
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Helpers
 * @author MD Developers
 */
class ValidatorHelper {
    
    /**
     *
     * @var mixed 
     */
    private $value;
    
    /**
     *
     * @var boolean 
     */
    private $required;
    
    /**
     *
     * @var string 
     */
    private $datatype;
    
    /**
     *
     * @var int 
     */
    private $maxlength;
    
    const DT_int = "int";
    const DT_float = "float";
    const DT_number = "number";
    const DT_string = "string";
    const DT_boolean = "boolean";
    const DT_datetime = "datetime";
    
    /**
     * 
     * @param boolean $required
     * @param string $datatype - const of Class Validator
     * @param int $maxlength unsigned int
     */
    public function __construct($required,$datatype,$maxlength = null){
        $this->required = $required;
        $this->datatype = $datatype;
        $this->maxlength = $maxlength;
    }
    
    /**
     * validate inserted value by setting from constructor;
     * 
     * @param mixed $value
     */
    public function validate($value){
        $this->value = $value;
        $this->validationEmpty();
        $this->validateDataType();
    }

    /**
     * 
     * @param boolean $required
     * @param string $datatype - const of Class Validator
     * @param int $maxlength unsigned int
     */
    public function resetSetting($required,$datatype,$maxlength){
        $this->required = $required;
        $this->datatype = $datatype;
        $this->maxlength = $maxlength;
    }
    
    
    /**
     * @throws MonkeyDataEmptyValueException
     */
    protected function validationEmpty() {
        
        if($this->required AND is_null($this->value)){
            throw new MonkeyDataEmptyValueException();
        }
        
    }
    
    
    /**
     * @throws MonkeyDataTypeExpectedException
     */
    private function validateDataType() {
        if(is_null($this->value) OR empty($this->value)){
            return;
        }
        
        switch ($this->datatype) {
            case self::DT_string: {
                if (!is_string($this->value))
                    throw New MonkeyDataTypeExpectedException("STRING");
                $this->validateMaxLength();
                break;
            }
            case self::DT_number: {
                if (!is_numeric($this->value))
                    throw New MonkeyDataTypeExpectedException("NUMBER");
                break;
            }
            case self::DT_int: {
                if (!is_int($this->value))
                    throw New MonkeyDataTypeExpectedException("INTEGER");
                break;
            }
            case self::DT_float: {
                if (!is_float($this->value) AND !  is_int($this->value))
                    throw New MonkeyDataTypeExpectedException("FLOAT");
                break;
            }
            case self::DT_boolean: {
                if (!is_bool($this->value))
                    throw New MonkeyDataTypeExpectedException("BOOLEAN");
                break;
            }
            case self::DT_datetime: {
                if (!preg_match('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $this->value) && !$this->validateMD8601($this->value))
                    throw New MonkeyDataTypeExpectedException("DATETIME format (YYYY-MM-DD hh:mm:ss)");
                break;
            }
        }
    }

    /**
     * Validates MonkeyData version of ISO-8601 format
     * example of an valid date: 2016-04-24T03:33:52-0300
     * @param $date
     * @return bool
     */
    private function validateMD8601($date) {
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})[\-\+](\d{2})(\d{2})$/', $date, $parts) == true) {
            if (strtotime($date) === false) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @throws MonkeyDataMaxLengthException
     */
    private function validateMaxLength() {
        if (!is_null($this->maxlength)) {
            if (strlen($this->value) > $this->maxlength)
                throw New MonkeyDataMaxLengthException("Max length is " . $this->maxlength);
        }
    }
    
}
