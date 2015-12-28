<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class RuntimeEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class VersionEntity extends Entity{

    /**
     * @param mixed $value
     */
    public function __construct() {
        parent::__construct("VERSION", Entity::DT_string, "1.0.5");
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredNo);
    }
}
