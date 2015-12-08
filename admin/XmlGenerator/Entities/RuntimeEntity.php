<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class RuntimeEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class RuntimeEntity extends Entity{

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("RUNTIME", Entity::DT_string, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
    }
}
