<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class ProductCountEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class ProductCountEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("PRODUCT_COUNT", self::DT_int, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
    }
}
