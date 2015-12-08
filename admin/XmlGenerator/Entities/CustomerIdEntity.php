<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class CustomerIdEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class CustomerIdEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("CUSTOMER_ID", self::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
        $this->setMaxLength(50);
    }
}
