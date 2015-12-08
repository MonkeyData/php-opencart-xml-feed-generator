<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class IdOrderEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class IdOrderEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("ID_ORDER", self::DT_int, $value);
    }
    
    protected function setting() {
        $this->setMaxLength(20);
        $this->setRequired(self::RequeredYes);
    }
}
