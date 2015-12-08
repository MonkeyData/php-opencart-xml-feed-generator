<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class ProductPriceWithoutVatEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class ProductPriceWithoutVatEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("PRODUCT_PRICE_WITHOUT_VAT", self::DT_float, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(16);
    }
}
