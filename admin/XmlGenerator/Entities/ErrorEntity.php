<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class ErrorEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class ErrorEntity extends Entity{

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("ERROR", Entity::DT_string, $value);
    }

    protected function setting() {
        $this->setMaxLength(255);
        $this->setRequired(self::RequeredYes);
    }
}
