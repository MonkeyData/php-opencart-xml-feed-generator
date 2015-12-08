<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CustomerFirstnameEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CustomerFirstnameEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("FIRSTNAME", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
        $this->setMaxLength(100);
    }
}
