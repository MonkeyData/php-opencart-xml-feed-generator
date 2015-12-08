<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;

use Exception;


/**
 * Class CustomerEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CustomerEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CUSTOMER", self::DT_list, $value);
    }
    
    protected function setting() {}

    /**
     * @param Entity $item
     * @throws Exception
     */
    public function addItem($item) {
        $class_name = strtolower(get_class($item));
        if (strpos($class_name, "customer") === false) {
            throw new Exception("Unexpected Entity: class is '$class_name'");
        } elseif ($item instanceof CustomerEntity) {
            throw new Exception("Unexpected Entity is CustomerEntity");
        }
        parent::addItem($item);
    }
}
