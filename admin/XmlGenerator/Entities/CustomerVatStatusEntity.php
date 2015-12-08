<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CustomerVatStatusEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CustomerVatStatusEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("VAT_STATUS", self::DT_int, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
        $this->setMaxLength(1);
    }
}
