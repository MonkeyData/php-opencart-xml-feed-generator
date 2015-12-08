<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CustomerCityEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CustomerCityEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CITY", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
        $this->setMaxLength(100);
    }
}
