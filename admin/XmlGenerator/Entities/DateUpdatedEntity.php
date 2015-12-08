<?php

namespace MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities;


/**
 * Class DateUpdatedEntity
 * @package MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Entities
 * @author MD Developers
 */
class DateUpdatedEntity extends Entity {

    /**
     * @param mixed $value
     */
    public function __construct($value = null) {
        parent::__construct("DATE_UPDATED", self::DT_datetime, $value);
    }
    
    protected function setting() {
        $this->setRequired(self::RequeredYes);
    }
}
