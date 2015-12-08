<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class PaymentNameEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class PaymentNameEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("PAYMENT_NAME", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(100);
    }
}
