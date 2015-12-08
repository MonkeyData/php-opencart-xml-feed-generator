<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CurrencyEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CurrencyEntity  extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CURRENCY", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(5);
    }
}
