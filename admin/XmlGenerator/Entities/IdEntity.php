<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class IdEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class IdEntity extends Entity{

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("ID", Entity::DT_string, $value);
    }

    protected function setting() {
        $this->setMaxLength(50);
        $this->setRequired(self::RequeredYes);
    }
}