<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;

use Exception;


/**
 * Class OrderProductsEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class OrderProductsEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("ORDER_PRODUCTS", self::DT_list, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
    }

    /**
     * @param Entity $item
     * @throws Exception
     */
    public function addItem($item) {
        if (!($item instanceof ProductEntity)) {
            throw new Exception("Unexpected Entity");
        }
        parent::addItem($item);
    }
}
