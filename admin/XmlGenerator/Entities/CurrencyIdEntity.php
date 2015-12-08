<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CurrencyIdEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CurrencyIdEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CURRENCY_ID", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
        $this->setMaxLength(10);
    }
}
