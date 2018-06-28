<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class DiscountNameEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class DiscountNameEntity extends Entity {
    /**
     * DiscountNameEntity constructor.
     * @param string $value
     */
    public function __construct($value) {
        parent::__construct('DISCOUNT_NAME', self::DT_string, $value);
    }

    protected function setting() {
        $this->setRequired(self::RequeredYes);
    }
}