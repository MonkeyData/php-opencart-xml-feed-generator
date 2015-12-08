<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class DateCreatedEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class DateCreatedEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("DATE_CREATED", self::DT_datetime, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
    }
}
