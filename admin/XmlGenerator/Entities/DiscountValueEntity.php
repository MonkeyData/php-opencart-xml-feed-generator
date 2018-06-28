<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class DiscountValueEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class DiscountValueEntity extends Entity {
    /**
     * DiscountValueEntity constructor.
     * @param float $value
     */
    public function __construct($value) {
        parent::__construct('DISCOUNT_VALUE', self::DT_float, $value);
    }

    protected function setting() {
        $this->setRequired(self::RequeredNo);
    }
}